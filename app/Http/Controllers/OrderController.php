<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Runner;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\ItemOrder;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $order = Order::where(function($q) use($request){
        //     if ($request->has('order_id'))
        //     {
        //         $q->where('id',$request->order_id);
        //     }

        //     if ($request->has('merchant_id'))
        //     {
        //         $q->where('merchant_id',$request->merchant_id);
        //     }

        //     if ($request->has('state'))
        //     {
        //         $q->where('state',$request->state);
        //     }

        //     if ($request->has('from') && $request->has('to'))
        //     {
        //         $q->whereDate('created_at' , '>=' , $request->from);
        //         $q->whereDate('created_at' , '<=' , $request->to);
        //     }

        // })->with('merchant')->latest()->paginate(20);
        $runners = [];
        $runners = Runner::where('state', 'free')->get();

        $order = Order::orderBy('created_at', 'DESC')->get()->load('merchant');
        return view('admin.orders.index', compact('order', 'runners'));
    }
    public function assignRunner(Request $request, $id)
    {
        $order_id = $id;
        $runners = Runner::where('state', 'free')->get();
        return view('admin.orders.asignRunner', compact('runners', 'order_id'));
    }

    public function addRunner(Request $request)
    {

        $validateData = [
            'runner_id' => 'required',
            'order_id' => 'required',
        ];
        $messages = [
            // 'name.required' =>  'ادخل اسم العرض ',

        ];

        $valid = validator($request->all(), $validateData, $messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

        // return $request->get('order_id');

        $runner = Runner::find($request->runner_id);
        $order = Order::find($request->order_id);

        // if ($runner)  $runner->orders()->create();
        if ($runner) {
            if ($order) {
                // $item = Item::find($request->item_id);
                $readyItem = [
                    $runner->id => [
                        'state' => 'pending',
                    ]
                ];
                // $order->runner()->attach($readyItem);
                $order->runners()->sync([$runner->id => ['state' => 'pending']], true);
                flash()->success('تم ادراج الطلب للمندوب');
                $order_id = $request->order_id;

                $runners = Runner::all();
                // return view('admin.orders.asignRunner', compact('order_id', 'runner', 'order', 'runners'));

                // return redirect(route('admin.assignRunner'))->with($request->order_id);
                // return response()->json(['success' => true, 'message' => 'تم ادراج الطلب للمندوب', 'result' => $order]);
                // return Response::json($order, 200);
                // return redirect()->back()->with('order_id', 'runner', 'order', 'runners');
                return redirect()->back()->with('order_id', $order_id)->with('runner', $runner)->with('order', $order)->with('runners', $runners);
            } else
                flash()->success('الطلب غير موجود');
        } else
            flash()->success('المندوب غير موجود');
    }
    ///make runner accept delivery order from dashboard
    public function acceptDeliverOrder(Request $request)
    {

        $order = Order::find($request->order_id);
        if (!$order) {
            return responseJson(0, 'لا يمكن الحصول على البيانات');
        }
        $runner = Runner::where('id', $request->runner_id)->first();
        // return $runner;
        $runner->orders()->updateExistingPivot($order->id, array('state' => 'accepted'));

        $runner->update(['state' => 'busy']);
        $runner->save();

        $order->update(['state' => 'accepted']);
        $order->save();

        flash()->success('تمت الموافقه على توصيل الطلب من قبل المندوب');
        return redirect()->back();
        // $order->update(['state' => 'delivered']);
        // $merchant = $order->merchant;
        // $merchant->notifications()->create([
        //     'title' => 'تم تأكيد توصيل طلبك من العميل',
        //     'title_en' => 'Your order is delivered to client',
        //     'content' => 'تم تأكيد التوصيل للطلب رقم ' . $request->order_id . ' للعميل',
        //     'content_en' => 'Order no. ' . $request->order_id . ' is delivered to client',
        //     'order_id' => $request->order_id,
        // ]);

        // $tokens = $merchant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
        // $audience = ['include_player_ids' => $tokens];
        // $contents = [
        //     'en' => 'Order no. ' . $request->order_id . ' is delivered to client',
        //     'ar' => 'تم تأكيد التوصيل للطلب رقم ' . $request->order_id . ' للعميل',
        // ];
        // $send = notifyByOneSignal($audience, $contents, [
        //     'user_type' => 'merchant',
        //     'action' => 'confirm-order-delivery',
        //     'order_id' => $request->order_id,
        // ]);
        // $send = json_decode($send);

        // return responseJson(1, 'تم قبول توصيل الطلب ', 'تم قبول توصيل الطلب ');
    }

    public function show($id)
    {
        $order = Order::with('merchant', 'items', 'client')->findOrFail($id);


        $items = ItemOrder::where('order_id', $id)->with('item')->get();
        // foreach ($items as $item) {
        //     // return $item;
        //     if ($item->item->merchant_id == $merchant->id)

        //         array_push($items, $item);
        //     // if ($item->item->type == 'spacialItem')
        //     //     array_push($spacialitems, $item);
        // }
        // $data = [
        //     'merchant' => $merchant,
        //     'items' => $items,
        //     // 'spacial_Items'=>$spacialitems
        // ];
        // array_push($all_data, $data);
        // $items = array();
        // $spacialitems = array();

        // return $items;
        return view('admin.orders.show', compact('order', 'items'));
    }

    public function print_invoice($id)
    {
        $order = Order::with('address', 'merchant', 'items', 'reviews', 'qualities', 'user', 'options')->findOrFail($id);
        return view('layouts.print', compact('order'));
    }

    public function change()
    {
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $items = ItemOrder::where('order_id', $id)->with('item')->get();

        return view('admin.orders.edit', compact('order', 'items'));
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        // return response()->json(['success' => true]);
        $order = Order::findOrFail($id);
        // $requestArray = $request->all();
        // if (!empty($requestArray['selected']))
        //     $requestArray['selected']    = implode(',', $requestArray['selected']);
        // return $request['selected'];//[object Object],[object Object]    ,gettype ($request['selected']) ==>string

        // return gettype ($request['selected']);
        // return json_encode($request['selected']);
        //         $selected = [];
        $data = json_decode($request['selected']);

        // return gettype ($data);
        //         $selected = collect($request['selected']);
        // return $request['selected'];
        foreach ($data as $item) {
            // return $item->id;
            $item_update = ItemOrder::where('id', $item->id)->first();
            $item_update->quantity = $item->quantity;
            $item_update->price = $item->price;
            $item_update->save();
        }
        return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);

        // flash()->success('تم تعديل الحالة  بنجاح');
        // return redirect()->back();
        // $items = ItemOrder::where('order_id', $id)->with('item')->get();
        // return $items;


        // -----------------
        // $update = $order->update($request->all());

        // $user = $order->user;

        // if ($update) {
        //     if ($request->state == 'accepted') {
        //         $notificationData = [
        //             'title' => 'تم تأكيد طلبك رقم ' . $order->id,
        //             'title_en' => 'Your Order #' . $order->id . ' has been  accepted !',
        //             'order_id' => $order->id
        //         ];
        //         $user->notifications()->create($notificationData);

        //         $audience = ['include_player_ids' => $user->tokens()->pluck('token')->toArray()];
        //         $contents = [
        //             'en' => 'Your Order #' . $order->id . ' has been  accepted !',
        //             'ar' => 'تم تأكيد طلبك رقم ' . $order->id,
        //         ];
        //         $data = ['order_id' => $order->id];
        //         notifyByOneSignal($audience, $contents, $data);
        //     } elseif ($request->state == 'rejected') {
        //         $notificationData = [
        //             'title' => 'تم رفض طلبك رقم ' . $order->id,
        //             'title_en' => 'Your Order #' . $order->id . ' has been  rejected !',
        //             'order_id' => $order->id
        //         ];
        //         $user->notifications()->create($notificationData);

        //         $audience = ['include_player_ids' => $user->tokens()->pluck('token')->toArray()];
        //         $contents = [
        //             'en' => 'Your Order #' . $order->id . ' has been  rejected !',
        //             'ar' => 'تم رفض طلبك رقم ' . $order->id,
        //         ];
        //         $data = ['order_id' => $order->id];
        //         notifyByOneSignal($audience, $contents, $data);
        //     } elseif ($request->state == 'canceled') {
        //         $notificationData = [
        //             'title' => 'تم إلغاء طلبك رقم ' . $order->id,
        //             'title_en' => 'Your Order #' . $order->id . ' has been canceled !',
        //             'order_id' => $order->id
        //         ];
        //         $user->notifications()->create($notificationData);

        //         $audience = ['include_player_ids' => $user->tokens()->pluck('token')->toArray()];
        //         $contents = [
        //             'en' => 'Your Order #' . $order->id . ' has been canceled !',
        //             'ar' => 'تم إلغاء طلبك رقم ' . $order->id,
        //         ];
        //         $data = ['order_id' => $order->id];
        //         notifyByOneSignal($audience, $contents, $data);
        //     }
        //     flash()->success('تم تعديل الحالة  بنجاح');
        //     return redirect('admin/order/' . $id);
        // }
        // return redirect('admin/order/' . $id);
    }
}
