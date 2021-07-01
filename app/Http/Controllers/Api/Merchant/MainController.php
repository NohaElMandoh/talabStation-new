<?php

namespace App\Http\Controllers\Api\Merchant;

use App\Events\OfferEvent;
use App\Models\Client;
use App\Models\Item;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Runner;
use App\Models\Token;
use Carbon\Carbon;

class MainController extends Controller
{
    public function addRunner(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'runners' => 'required|array',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            // return responseJson(0, $validation->errors()->first(), $errorString);
            return responseJson(0,$errorString,null);

        }
        if ($request->has('runners')) {
            foreach ($request->runners as $runner) {

                $runner = Runner::find($runner);

                $runner->update(['merchant_id' => $request->user()->id]);
            }
            $runners = Runner::where('merchant_id', $request->user()->id)->paginate(10);
            return responseJson(1, 'تم التنفيذ',  $runners);
        } else return responseJson(0, 'لا يوجد داتا', 'لا يوجد داتا');
    }
    public function removeRunner(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'runner_id' => 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0,  $errorString,null);
        }
        $runner = Runner::find($request->runner_id);

        $runner->update(['merchant_id' => 0]);
        return responseJson(1, 'تم الحذف', 'تم الحذف');
    }
    public function assignRunner(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'runner_id' => 'required',
            'order_id' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0,  $errorString,null);
        }
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
                $order->runner()->sync([$runner->id => ['state' => 'pending']], true);
                return responseJson(1, 'تم ادراج الطلب للمندوب', $runner);
            } else
                return responseJson(1, 'الطلب غير موجود', 'الطلب غير موجود');
        } else
            return responseJson(1, 'المندوب غير موجود', 'المندوب غير موجود');
    }
    public function allRunners(Request $request)
    {
        $runners = Runner::where('merchant_id', '!=', $request->user()->id)->paginate(10);
        return responseJson(1, 'تم التحميل', $runners);
    }
    public function myRunners(Request $request)
    {
        $runners = Runner::where('merchant_id', $request->user()->id)->paginate(10);
        return responseJson(1, 'تم التحميل', $runners);
    }
    public function updateCategories(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'categories' => 'required|array',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0,$errorString,null);
        }

        $user =  $request->user();

        if ($request->has('categories')) {
            $user->categories()->sync($request->categories);
        }

        return responseJson(1, 'تم التسجيل بنجاح', $user->load('categories'));
    }
  
    public function myCategories(Request $request)
    {

        $category = $request->user()->categories()->get();

        return responseJson(1, 'تم التحميل', $category);
    }


    public function myItems(Request $request)
    {
        if ($request->has('category_id')) {
            $item =  $request->user()->items()->where('category_id', $request->category_id)->enabled()->latest()->paginate(20);
        } else
            $item = $request->user()->items()->enabled()->latest()->paginate(20);
        return responseJson(1, 'تم التحميل', $item->load('category','unit'));
    }

    public function newItem(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'category_id' => 'required',
            'photo' => 'required',
            'unit_id'=>'required'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0,  $errorString,null);
            // return responseJson(0,$validation->errors()->first(),$data);
        }

        $item = $request->user()->items()->create($request->all());
        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/items/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $item->update(['photo' => 'uploads/items/' . $name]);
        }

        return responseJson(1, 'تم الاضافة بنجاح', $item);
    }

    public function updateItem(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            // 'preparing_time' => 'required',
            'category_id' => 'required',
            'photo' => 'required',
            'unit_id'=>'required'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0,  $errorString,null);
            // return responseJson(0,$validation->errors()->first(),$data);
        }

        $item = $request->user()->items()->find($request->item_id);
        if (!$item) {
            return responseJson(0, 'لا يمكن الحصول على البيانات',null);
        }
        $item->update($request->all());
        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/items/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $item->update(['photo' => 'uploads/items/' . $name]);
        }

        return responseJson(1, 'تم التعديل بنجاح', $item);
    }

    public function deleteItem(Request $request)
    {
        $item = $request->user()->items()->find($request->item_id);
        if (!$item) {
            return responseJson(0, 'لا يمكن الحصول على البيانات',null);
        }
        // if (count($item->orders) > 0) {
        //     $item->update(['disabled' => 1]);
        //     return responseJson(1, 'تم الحذف بنجاح',$item);
        //     //            return responseJson(0,'لا يمكن مسح الصنف ، يوجد طلبات مرتبطة به');
        // }

        $item->delete();
        return responseJson(1, 'تم الحذف بنجاح',$item);
    }

    public function myOrders(Request $request)
    {
        // $orders = $request->user()->orders()->where(function ($order) use ($request) {
        //     if ($request->has('state') && $request->state == 'completed') {
        //         $order->where('state', '!=', 'pending');
        //     } elseif ($request->has('state') && $request->state == 'current') {
        //         $order->where('state', '=', 'accepted');
        //     } elseif ($request->has('state') && $request->state == 'pending') {
        //         $order->where('state', '=', 'pending');
        //     }
        // })->with('client', 'items', 'merchant')->latest()->paginate(20);
        // return responseJson(1, 'تم التحميل', $orders);

        if ($request->has('state') && $request->state == 'completed') {
            $orders = $request->user()->orders()->where('state', '!=', 'pending')->latest()->paginate(20);
        } elseif ($request->has('state') && $request->state == 'current') {
            $orders =       $request->user()->orders()->where('state', '=', 'accepted')->latest()->paginate(20);
        } elseif ($request->has('state') && $request->state == 'pending') {
            $orders =   $request->user()->orders()->where('state', '=', 'pending')->latest()->paginate(20);
        } else
            $orders =   $request->user()->orders()->latest()->paginate(20);

        // return responseJson(1, 'تم التحميل', $orders->load('items', 'merchant', 'client.region'));
        return responseJson(1, 'تم التحميل', OrderResource::collection($orders) );
    }

    public function showOrder(Request $request)
    {
        $order = Order::with('items', 'client', 'merchant')->find($request->order_id);
        return responseJson(1, 'تم التحميل', $order);
    }

    public function acceptOrder(Request $request)
    {

        $order = $request->user()->orders()->find($request->order_id);

        if (!$order) {
            return responseJson(0, 'لا يمكن الحصول على بيانات الطلب',null);
        }
        if ($order->state == 'accepted') {
            return responseJson(1, 'تم قبول الطلب', 'تم قبول الطلب');
        }
        $order->update(['state' => 'accepted']);
        // $client = $order->client;
        // $client->notifications()->create([
        //     'title' => 'تم قبول طلبك',
        //     'title_en' => 'Your order is accepted',
        //     'content' => 'تم قبول الطلب رقم ' . $request->order_id,
        //     'content_en' => 'Order no. ' . $request->order_id . ' is accepted',
        //     'order_id' => $request->order_id,
        // ]);

        // $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
        // $audience = ['include_player_ids' => $tokens];
        // $contents = [
        //     'en' => 'Order no. ' . $request->order_id . ' is accepted',
        //     'ar' => 'تم قبول الطلب رقم ' . $request->order_id,
        // ];
        // $send = notifyByOneSignal($audience, $contents, [
        //     'user_type' => 'client',
        //     'action' => 'accept-order',
        //     'order_id' => $request->order_id,
        //     'restaurant_id' => $request->user()->id,
        // ]);
        // $send = json_decode($send);
        return responseJson(1, 'تم قبول الطلب', 'تم قبول الطلب');
    }

    public function rejectOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);
        if (!$order) {
            return responseJson(0, 'لا يمكن الحصول على بيانات الطلب',null);
        }
        if ($order->state == 'rejected') {
            return responseJson(1, 'تم رفض الطلب');
        }
        $order->update(['state' => 'rejected']);
        $client = $order->client;
        // $client->notifications()->create([
        //     'title' => 'تم رفض طلبك',
        //     'title_en' => 'Your order is rejected',
        //     'content' => 'تم رفض الطلب رقم ' . $request->order_id,
        //     'content_en' => 'Order no. ' . $request->order_id . ' is rejected',
        //     'order_id' => $request->order_id,
        // ]);

        // $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
        // $audience = ['include_player_ids' => $tokens];
        // $contents = [
        //     'en' => 'Order no. ' . $request->order_id . ' is rejected',
        //     'ar' => 'تم رفض الطلب رقم ' . $request->order_id,
        // ];
        // $send = notifyByOneSignal($audience, $contents, [
        //     'user_type' => 'client',
        //     'action' => 'reject-order',
        //     'order_id' => $request->order_id,
        //     'restaurant_id' => $request->user()->id,
        // ]);
        // $send = json_decode($send);
        return responseJson(1, 'تم رفض الطلب', 'تم رفض الطلب');
    }

    public function confirmOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);
        if (!$order) {
            return responseJson(0, 'لا يمكن الحصول على بيانات الطلب',null);
        }
        if ($order->state != 'accepted') {
            return responseJson(0, 'لا يمكن تأكيد الطلب ، لم يتم قبول الطلب');
        }
        $order->update(['state' => 'delivered']);
        $client = $order->client;
        // $client->notifications()->create([
        //     'title' => 'تم تأكيد توصيل طلبك',
        //     'title_en' => 'Your order is delivered',
        //     'content' => 'تم تأكيد التوصيل للطلب رقم ' . $request->order_id,
        //     'content_en' => 'Order no. ' . $request->order_id . ' is delivered to you',
        //     'order_id' => $request->order_id,
        // ]);

        // $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
        // $audience = ['include_player_ids' => $tokens];
        // $contents = [
        //     'en' => 'Order no. ' . $request->order_id . ' is delivered to you',
        //     'ar' => 'تم تأكيد التوصيل للطلب رقم ' . $request->order_id,
        // ];
        // $send = notifyByOneSignal($audience, $contents, [
        //     'user_type' => 'client',
        //     'action' => 'confirm-order-delivery',
        //     'order_id' => $request->order_id,
        //     'restaurant_id' => $request->user()->id,
        // ]);
        // $send = json_decode($send);
        return responseJson(1, 'تم تأكيد الاستلام', 'تم تأكيد الاستلام');
    }

    public function myOffers(Request $request)
    {
        $offers = $request->user()->offers()->with('merchant', 'items')->latest()->paginate(20);
        return responseJson(1, '', $offers);
    }

    public function newoffer(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'starting_at' => 'required',
            'ending_at' => 'required',
            'photo' => 'required',
         'offer_title_id'=>'required',

        ]);


        if ($validation->fails()) {
            $data = $validation->errors();

            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0, $errorString,null);
            // return responseJson(0, $validation->errors()->first(), $data);
        }

        $requestArray = $request->all();
        if (!empty($requestArray['starting_at']))
            $requestArray['starting_at']    = strtotime($requestArray['starting_at']);

        $requestArray['starting_at'] =  date('Y-m-d', $requestArray['starting_at']);

        if (!empty($requestArray['ending_at']))
            $requestArray['ending_at']    = strtotime($requestArray['ending_at']);

        $requestArray['ending_at'] =  date('Y-m-d', $requestArray['ending_at']);


        // return $requestArray;

        $offer = $request->user()->offers()->create($requestArray);


        if ($request->has('items')) {
            $offer->items()->sync($request->items);
        }
        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/offers/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $offer->update(['photo' => '/uploads/offers/' . $name]);
        }

        $this->sendOfferNotification('add offer ', $offer);


        // $tokens =Token::where('token','!=','')->pluck('token')->toArray();
        // return $tokens;
        // $audience = ['include_player_ids' => $tokens];
        // $contents = [
        //     'en' => $offer->merchant->name.'add New order  ',
        //     'ar' => 'قام'.$offer->merchant->name.'باضافه عرض جديد',
        // ];
        // // $send = notifyByOneSignal($audience , $contents , [
        // //     'user_type' => 'merchant',
        // //     'action' => 'new-order',
        // //     'order_id' => $order->id,
        // // ]);
        // // $send = json_decode($send);
        // if (count($tokens)) {

        //         $title = $event->text;
        //         $body = $event->text;
        //         $data = [
        //             'action' => 'Notification',
        //             'order' => 'Notification'
        //         ];
        //         $send = notifyByFirebase($title, $body, $tokens, $data);
        //         dd("firebase result: " . $send);
        //     }
        /* notification */

        return responseJson(1, 'تم الاضافة بنجاح', $offer->load('items','offerTitle'));
    }
    public function sendOfferNotification($mg1, $offer)
    {

        $text = Auth()->user()->name . " {$mg1}";
        event(new OfferEvent($offer, $text));
        $tokens =Token::where('token','!=','')->pluck('token')->toArray();
        $audience = ['include_player_ids' => $tokens];
        $contents = [
            'en' => $offer->merchant->name.'add New order  ',
            'ar' => 'قام'.$offer->merchant->name.'باضافه عرض جديد',
        ];
        // $send = notifyByOneSignal($audience , $contents , [
        //     'user_type' => 'merchant',
        //     'action' => 'new-order',
        //     'order_id' => $order->id,
        // ]);
        // $send = json_decode($send);
        // return $tokens;
        if (count($tokens)) {

                $title = $mg1;
                $body = $mg1;
                $data = [
                    'action' => 'Notification',
                    'order' => 'Notification'
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
                info("firebase result: " . $send);
            }
    }
    public function updateOffer(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'starting_at' => 'required',
            'ending_at' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();

            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0, $errorString,null);
            // return responseJson(0, $validation->errors()->first(), $data);
        }

        $offer = $request->user()->offers()->find($request->offer_id);
        if (!$offer) {
            return responseJson(0, 'لا يمكن الحصول على البيانات');
        }


        $requestArray = $request->all();
        if (!empty($requestArray['starting_at']))
            $requestArray['starting_at']    = strtotime($requestArray['starting_at']);

        $requestArray['starting_at'] =  date('Y-m-d', $requestArray['starting_at']);

        if (!empty($requestArray['ending_at']))
            $requestArray['ending_at']    = strtotime($requestArray['ending_at']);

        $requestArray['ending_at'] =  date('Y-m-d', $requestArray['ending_at']);

        $offer->update($requestArray);

        if ($request->has('items')) {
            $offer->items()->sync($request->items);
        }

        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/offers/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $offer->update(['photo' => 'uploads/offers/' . $name]);
        }

        return responseJson(1, 'تم التعديل بنجاح', $offer);
    }

    public function deleteOffer(Request $request)
    {
        $offer = $request->user()->offers()->find($request->offer_id);
        if (!$offer) {
            return responseJson(0, 'لا يمكن الحصول على البيانات',null);
        }
        $offer->delete();
        return responseJson(1, 'تم الحذف بنجاح', 'تم الحذف بنجاح');
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->paginate(20);
        return responseJson(1, 'تم التحميل', $notifications);
    }

    public function changeState(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'state' => 'required|in:open,closed'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $request->user()->update(['availability' => $request->state]);

        return responseJson(1, '', $request->user());
    }

    public function commissions(Request $request)
    {
        $count = $request->user()->orders()->where('state', 'accepted')->where(function ($q) {
            $q->where('state', 'delivered');
        })->count();

        $total = $request->user()->orders()->where('state', 'accepted')->where(function ($q) {
            $q->where('state', 'delivered');
        })->sum('total');

        $commissions = $request->user()->orders()->where('state', 'accepted')->where(function ($q) {
            $q->where('state', 'delivered');
        })->sum('commission');

        $payments = $request->user()->transactions()->sum('amount');

        $net_commissions = $commissions - $payments;

        $commission = settings()->commission;

        return responseJson(1, '', compact('count', 'total', 'commissions', 'payments', 'net_commissions', 'commission'));
    }
}
