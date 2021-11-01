<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Runner;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\ItemOrder;
use Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {


        // $orders = [];

        $orders = Order::orderBy('created_at', 'DESC')->where('merchant_id',Auth::user()->id)->where(function($query){

            $query->where('state','=','pending');
        })->get();
//get orders which contain items belongs to this merchant
        // ->where('state','=','pending')->orWhere('state','=','accepted')->get();
        // foreach ($all_orders as $order) {
        //     foreach ($order->items as $o)
        //         //    return $o; //return item details
        //         // if ($o->merchant_id == Auth::user()->id)
        //             array_push($orders, $o->orders);
                  

        // }

        
        return view('merchant.orders.index', compact('orders'));
    }
    public function filter(Request $request)
    {

        $this->validate($request, [
            'ending_at' => 'required',
            'starting_at' => 'required'
        ]);


        $orders = [];
        if ($request->has('ending_at') || $request->has('starting_at')) {
            $from_date = $request->starting_at;
            $to_date = $request->ending_at;
            $all_orders = Order::whereBetween('created_at', [$from_date, $to_date])->where('state','=','pending')->orWhere('state','=','accepted')->orderBy('created_at', 'DESC')->get();
        } else
            $all_orders = Order::orderBy('created_at', 'DESC')->where('state','=','pending')->orWhere('state','=','accepted')->get();
        foreach ($all_orders as $order) {
            foreach ($order->items as $o)
                //    return $o; //return item details
                if ($o->merchant_id == Auth::user()->id)
                    array_push($orders, $o->orders);
        }
        return view('merchant.orders.index', compact('orders'));
    }
    public function filterCompletedOrders(Request $request)
    {

        $this->validate($request, [
            'ending_at' => 'required',
            'starting_at' => 'required'
        ]);


        $orders = [];
        if ($request->has('ending_at') || $request->has('starting_at')) {
            $from_date = $request->starting_at;
            $to_date = $request->ending_at;
            $orders = Order::whereBetween('created_at', [$from_date, $to_date])-> where('merchant_id',Auth::user()->id)->where('state','=','delivered')->orderBy('created_at', 'DESC')->get();
        } else
            $orders = Order::orderBy('created_at', 'DESC')-> where('merchant_id',Auth::user()->id)->where('state','=','delivered')->orderBy('created_at', 'DESC')->get();
        // foreach ($all_orders as $order) {
        //     foreach ($order->items as $o)
        //         //    return $o; //return item details
        //         if ($o->merchant_id == Auth::user()->id)
        //             array_push($orders, $o->orders);
        // }
        return view('merchant.orders.index', compact('orders'));
    }

    public function completeOrders(Request $request)
    {
        $orders = Order::orderBy('created_at', 'DESC')->where('merchant_id',Auth::user()->id)->where(function($query){

            $query->where('state','=','delivered');
        })->get();

        // $orders = [];

        // $all_orders = Order::orderBy('created_at', 'DESC')->where('state','=','completed')->orWhere('state','=','delivered')->get();
        // foreach ($all_orders as $order) {
        //     foreach ($order->items as $o)
        //         //    return $o; //return item details
        //         if ($o->merchant_id == Auth::user()->id)
        //             array_push($orders, $o->orders);
        // }
        return view('merchant.orders.completedOrders', compact('orders'));
    }
    public function filterAcceptedOrders(Request $request)
    {

        $this->validate($request, [
            'ending_at' => 'required',
            'starting_at' => 'required'
        ]);


        // $orders = [];
        if ($request->has('ending_at') || $request->has('starting_at')) {
            $from_date = $request->starting_at;
            $to_date = $request->ending_at;
            $orders = Order::whereBetween('created_at', [$from_date, $to_date])-> where('merchant_id',Auth::user()->id)->where('state','=','accepted')->orderBy('created_at', 'DESC')->get();
        } else
            $orders = Order::orderBy('created_at', 'DESC')-> where('merchant_id',Auth::user()->id)->where('state','=','accepted')->orderBy('created_at', 'DESC')->get();
        // foreach ($all_orders as $order) {
        //     foreach ($order->items as $o)
        //         //    return $o; //return item details
        //         if ($o->merchant_id == Auth::user()->id)
        //             array_push($orders, $o->orders);
        // }

       
        return view('merchant.orders.index', compact('orders'));
    }
    public function acceptedOrders(Request $request)
    {
        $orders = Order::orderBy('created_at', 'DESC')->where('merchant_id',Auth::user()->id)->where(function($query){

            $query->where('state','=','accepted');
        })->get();

        // $orders = [];

        // $all_orders = Order::orderBy('created_at', 'DESC')->where('state','=','completed')->orWhere('state','=','delivered')->get();
        // foreach ($all_orders as $order) {
        //     foreach ($order->items as $o)
        //         //    return $o; //return item details
        //         if ($o->merchant_id == Auth::user()->id)
        //             array_push($orders, $o->orders);
        // }
        // return $orders;
        return view('merchant.orders.acceptedOrders', compact('orders'));
    }
    
    public function rejectedOrders(Request $request)
    {
        $orders = Order::orderBy('created_at', 'DESC')->where('merchant_id',Auth::user()->id)->where(function($query){

            $query->where('state','=','rejected');
        })->get();
        return view('merchant.orders.rejectedOrders', compact('orders'));
    }
    public function filterRejectedOrders(Request $request)
    {

        $this->validate($request, [
            'ending_at' => 'required',
            'starting_at' => 'required'
        ]);


        // $orders = [];
        if ($request->has('ending_at') || $request->has('starting_at')) {
            $from_date = $request->starting_at;
            $to_date = $request->ending_at;
            $orders = Order::whereBetween('created_at', [$from_date, $to_date])-> where('merchant_id',Auth::user()->id)->where('state','=','rejected')->orderBy('created_at', 'DESC')->get();
        } else
            $orders = Order::orderBy('created_at', 'DESC')-> where('merchant_id',Auth::user()->id)->where('state','=','rejected')->orderBy('created_at', 'DESC')->get();
     
        return view('merchant.orders.rejectedOrders', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::with('merchant', 'items', 'client')->findOrFail($id);


        $all_items = ItemOrder::where('order_id', $id)->with('item')->get();
        $items = [];
        // ---
        // $all_orders = Order::orderBy('created_at', 'DESC')->get();
        // foreach ($all_orders as $order) {
        foreach ($all_items as $item) {
            //    return $item->item; //return item details


            if ($item->item->merchant_id == Auth::user()->id)
                array_push($items, $item);
        }
        // return $items;

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
        return view('merchant.orders.show', compact('order', 'items'));
    }
    public function printInvoice($id)
    {
        $order = Order::with('merchant', 'items', 'client')->findOrFail($id);


        $all_items = ItemOrder::where('order_id', $id)->with('item')->get();
        $items = [];
        // ---
        // $all_orders = Order::orderBy('created_at', 'DESC')->get();
        // foreach ($all_orders as $order) {
        foreach ($all_items as $item) {
            //    return $item->item; //return item details


            if ($item->item->merchant_id == Auth::user()->id)
                array_push($items, $item);
        }
        // return $items;

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
        return view('merchant.orders.printOrder', compact('order', 'items'));
    }

    

    public function acceptItem($id)
    {
        $item = ItemOrder::findOrFail($id);
        $item->merchant_state = 'accepted';
        $item->save();
        return response()->json(['success' => true, 'message' => 'تم قبول الطلب']);
    }
    public function acceptOrder($id)
    {
        $item = Order::findOrFail($id);
        $item->state = 'accepted';
        $item->save();
        return response()->json(['success' => true, 'message' => 'تم قبول الطلب']);
    }
    public function deliveredOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->state = 'delivered';
        $order->delivery_confirmed_by_runner=1;
        $order->save();
        return response()->json(['success' => true, 'message' => 'تم تسليم الطلب']);
    }
    public function rejectOrder(Request $request)
    {
        $validateData= [
            'merchant_reject_reason' => 'required'
        ];
        $messages = [
            'merchant_reject_reason.required' =>  'اذكر سبب الرفض ',
            
        ];
      
        $valid = validator($request->all(), $validateData,$messages);

        if ($valid->fails())
        return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

        $order = Order::findOrFail($request->id);
        $order->state = 'rejected';
        $order->delivery_confirmed_by_runner=1;
        $order-> merchant_reject_reason=$request->merchant_reject_reason;
        $order->save();
        return response()->json(['success' => true, 'message' => 'تم رفض /إنهاء الطلب']);
    }
    
    
    
    public function rejecteItem($id)
    {
        $item = ItemOrder::findOrFail($id);
        $item->merchant_state = 'rejected'; 
        $item->save();
        return response()->json(['success' => true, 'message' => 'تم رفض الطلب']);
    }
    
    public function deliverItem($id)
    {
        $item = ItemOrder::findOrFail($id);
        $item->merchant_state = 'deliverd-to-runner'; 
        $item->save();
        return response()->json(['success' => true, 'message' => 'تم تسليم الطلب']);
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
