<?php

namespace App\Http\Controllers\Api\Runner;

use App\Models\Client;
use App\Models\Guest;
use App\Models\Item;
use App\Models\Order;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClientsSettings;
use App\Models\Merchant;
use App\Models\Runner;

class MainController extends Controller
{

    public function myOrders(Request $request)
    {
        // $orders = $request->user()->orders()->where(function ($order) use ($request) {
        //     if ($request->has('state') && $request->state == 'assigned') {
        //         $order->where('state', '!=', 'pending');
        //     } elseif ($request->has('state') && $request->state == 'accepted') {
        //         $order->where('state', '=', 'pending');
        //     }
        // })->with('merchant')->latest()->paginate(20);
        if ($request->has('state') && $request->state == 'assigned') {
            $orders = $request->user()->orders()->where('state', 'assigned')->with('merchant')->latest()->paginate(20);
        } elseif ($request->has('state') && $request->state == 'accepted') {
            $orders =       $request->user()->orders()->where('state', '=', 'accepted')->with('merchant')->latest()->paginate(20);
        } else
            $orders = $request->user()->orders()->with('merchant')->latest()->paginate(20);
        return responseJson(1, 'تم التحميل', $orders);

        // return  $request->user()->orders()->get();
    }

    public function showOrder(Request $request)
    {
        $order = Order::with('merchant', 'items','runnerAccepted','runner')->find($request->order_id);
        return responseJson(1, 'تم التحميل', $order);
    }

    public function latestOrder(Request $request)
    {
        $order = $request->user()->orders()
            ->with('merchant', 'items')
            ->latest()
            ->first();
        if ($order) {
            return responseJson(1, 'تم التحميل', $order);
        }
        return responseJson(0, 'لا يوجد');
    }
    public function confirmOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!$order) {
            return responseJson(0, 'لا يمكن الحصول على البيانات');
        }
        if ($order->state != 'accepted') {
            return responseJson(0, 'لا يمكن تأكيد استلام الطلب ، لم يتم قبول الطلب');
        }
        if ($order->delivery_confirmed_by_client == 1) {
            return responseJson(1, 'تم تأكيد الاستلام');
        }
     
        $order->update(['delivery_confirmed_by_merchant' => 1]);
   
   
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

        return responseJson(1, 'تم تأكيد توصيل الطلب ','تم تأكيد توصيل الطلب ');
    }
    public function acceptDeliverOrder(Request $request)
    {
        $order =Order::find($request->order_id);
        if (!$order) {
            return responseJson(0, 'لا يمكن الحصول على البيانات');
        }
       
        $request->user()->orders()->updateExistingPivot($order->id, array('state' => 'accepted'));
        $request->user()->update(['state' => 'busy']);

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

        return responseJson(1, 'تم قبول توصيل الطلب ','تم قبول توصيل الطلب ');
    }

    public function declineOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!$order) {
            return responseJson(0, 'لا يمكن الحصول على البيانات');
        }
        if ($order->state != 'accepted') {
            return responseJson(0, 'لا يمكن رفض استلام الطلب ، لم يتم قبول الطلب');
        }
        if ($order->delivery_confirmed_by_client == -1) {
            return responseJson(1, ' تم رفض استلام الطلب من قبل العميل');
        }
        $order->update(['delivery_confirmed_by_client' => -1]);
        // $merchant = $order->merchant;
        // $merchant->notifications()->create([
        //     'title' => 'تم رفض توصيل طلبك من العميل',
        //     'title_en' => 'Your order delivery is declined by client',
        //     'content' => 'تم رفض التوصيل للطلب رقم ' . $request->order_id . ' للعميل',
        //     'content_en' => 'Delivery if order no. ' . $request->order_id . ' is declined by client',
        //     'order_id' => $request->order_id,
        // ]);

        // $tokens = $merchant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
        // $audience = ['include_player_ids' => $tokens];
        // $contents = [
        //     'en' => 'Delivery if order no. ' . $request->order_id . ' is declined by client',
        //     'ar' => 'تم رفض التوصيل للطلب رقم ' . $request->order_id . ' للعميل',
        // ];
        // $send = notifyByOneSignal($audience, $contents, [
        //     'user_type' => 'merchant',
        //     'action' => 'decline-order-delivery',
        //     'order_id' => $request->order_id,
        // ]);
        // $send = json_decode($send);

        return responseJson(1, 'تم رفض استلام الطلب');
    }

    
    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->paginate(20);
        return responseJson(1, 'تم التحميل', $notifications);
    }
}
