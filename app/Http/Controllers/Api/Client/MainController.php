<?php

namespace App\Http\Controllers\Api\Client;

use App\Events\SomeEvent;
use App\Models\Client;
use App\Models\Guest;
use App\Models\Item;
use App\Models\Order;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ClientsSettings;
use App\Models\ItemOrder;
use App\Models\Merchant;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Runner;
use App\Models\RunnerReview;
use App\Models\SpacialItem;
use App\Models\Token;
use App\Models\User;

class MainController extends Controller
{
    public function additionalMerchant(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'merchant_name' => 'required',
            'merchant_address' => 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $new_merchant = $request->user()->additionalMerchant()->create([
            'merchant_name' => $request->merchant_name,
            'merchant_address' => $request->merchant_address,
            'phone' => $request->phone,
            'service_describe' => $request->service_describe

        ]);

        return responseJson(1, 'تم الاضافة', $new_merchant);
    }
    public function updateSettings(Request $request)
    {
        $validation = validator()->make($request->all(), [

            'notification' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $settings = ClientsSettings::create([
            'client_id' => $request->user()->id,
            'notification' => $request->notification
        ]);
        return responseJson(1, 'تم التعديل', 'تم التعديل');
    }
    public function addItemToCart(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'item_id' => 'required',
            'quantity' => 'required',
            'type' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        info('user add item to cart :' . json_encode($request->user()));
        info('cart items:' . json_encode($request->all()));

        if ($request->has('type')) {
            if ($request->has('item_id')) {
                if ($request['type'] == 'item') {
                    $item = Item::find($request->item_id);
                }
                if ($request['type'] == 'offer') {
                    $item = Offer::find($request->item_id);
                }
            } else return responseJson(0, 'رجاءا اختر المنتج', null);
        } else return responseJson(0, 'لم يتم تحديد نوع العنصر', null);

        if ($item) {
            $firstitem = Cart::where('client_id', $request->user()->id)->with('item.merchant')->first();
            if ($firstitem) {
                if ($item->merchant_id != $firstitem->item->merchant_id)
                    return responseJson(3, $firstitem->item->merchant->name, null);
                else {
                    $price = $item->price;

                    $readyItem = [
                        $item->id => [
                            'quantity' => $request->quantity,
                            'price' => $price,
                            'note' => $request->note,
                            'item_type' =>  get_class($item)
                        ]
                    ];
                    $request->user()->cart()->attach($readyItem);
                }
            } else {
                $price = $item->price;

                $readyItem = [
                    $item->id => [
                        'quantity' => $request->quantity,
                        'price' => $price,
                        'note' => $request->note,
                        'item_type' =>  get_class($item)
                    ]
                ];
                $request->user()->cart()->attach($readyItem);
            }
        } else {
            return responseJson(0, 'المنتج غير موجود', null);
        }

        return responseJson(1, 'تم الاضافة', $item);
    }
    public function addSpacialItemToCart(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'quantity' => 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        info('user add spacial item to cart :' . json_encode($request->user()));
        info('cart items:' . json_encode($request->all()));

        $request->merge(['price' => 0.00]);
        $request->merge(['merchant_id' => 1]); ///custom orders


        $item = $request->user()->spacialItem()->create($request->all());

        if ($item) {
            $price = $item->price;

            $readyItem = [
                $item->id => [
                    'quantity' => $item->quantity,
                    'price' => $price,
                    'note' => $item->note,
                    'item_type' =>  get_class($item)
                ]
            ];
            $request->user()->cart()->attach($readyItem);
        } else return responseJson(0, 'المنتج غير موجود', null);

        return responseJson(1, 'تم الاضافة', $item);
    }

    public function deleteItemFromCart(Request $request)
    {
        // $validation = validator()->make($request->all(), [
        //     'row_id' => 'required',
        // ]);

        // if ($validation->fails()) {
        //     $data = $validation->errors();
        //     return responseJson(0, $validation->errors()->first(), $data);
        // }

        // //        $request->user()->cart()->detach($request->item_id);
        // DB::table('carts')->where('id', $request->row_id)->delete();

        // return responseJson(1, 'تم الحذف');
        $validation = validator()->make($request->all(), [
            'row_id' => 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            // return responseJson(0, $validation->errors()->first(), $errorString);
            return responseJson(0, $errorString, null);
        }
        $item = Cart::where('client_id', $request->user()->id)
            ->where('id', $request->row_id)->first();

        if ($item) {
            DB::table('carts')
                ->where('client_id', $request->user()->id)
                ->where('id', $request->row_id)
                ->delete();
            return responseJson(1, 'تم حذف العنصر', null);
        } else  return responseJson(0, 'المنتج غير موجود', null);
    }

    public function deleteAllCartItems(Request $request)
    {
        $request->user()->cart()->detach();
        return responseJson(1, 'تم الحذف');
    }

    public function updateCartItem(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'row_id' => 'required',
            'quantity' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            // return responseJson(0, $validation->errors()->first(), $errorString);
            return responseJson(0, $errorString, null);
        }

        if ($request->quantity == 0) {
            DB::table('carts')
                ->where('client_id', $request->user()->id)
                ->where('id', $request->row_id)
                ->delete();
            return responseJson(1, 'تم حذف العنصر');
        }
        // DB::table('carts')
        //     ->where('client_id', $request->user()->id)
        //     ->where('id', $request->row_id)
        //     ->update([
        //         'quantity' => $request->quantity,
        //         'note' => $request->note,
        //     ]);

        $item = Cart::where('client_id', $request->user()->id)
            ->where('id', $request->row_id)->first();

        if ($item) {
            $item->update([
                'quantity' => $request->quantity,
                // 'note' => $request->note,
            ]);
            return responseJson(1, 'تم التحديث');
        } else  return responseJson(0, 'المنتج غير موجود');
    }

    public function deleteCartItem(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'row_id' => 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            // return responseJson(0, $validation->errors()->first(), $errorString);
            return responseJson(0, $errorString, null);
        }
        $item = Cart::where('client_id', $request->user()->id)
            ->where('id', $request->row_id)->first();

        if ($item) {
            DB::table('carts')
                ->where('client_id', $request->user()->id)
                ->where('id', $request->row_id)
                ->delete();
            return responseJson(1, 'تم حذف العنصر', null);
        } else  return responseJson(0, 'المنتج غير موجود', null);
    }

    public function cartItems(Request $request)
    {
        // $items = $request->user()->cart()->with('merchant')->get();
        $items = Cart::where('client_id', $request->user()->id)->with('item.merchant')->get();
        $allItems = [];
        $offer_items_price = 0.00;
        $discount = 0.00;

        foreach ($items as $item) {
            if ($item->item->type == 'offer') {
                $offer = Offer::where('id', $item->item_id)->first();
                foreach ($offer->items as $offer_item) {
                    $offer_items_price += $offer_item->price;
                }
                $discount = $offer_items_price - $item->item->price;
            } else $offer_items_price = 0.00;
            if ($item->item->type == 'item') {
                $discount = $item->item->discount;
            }
            if ($item->item->type == 'spacialItem') {
                $discount =  "0.00";
            }
            $data = [
                'row_id' => $item->id,
                'id' => $item->item->id,
                'name' => $item->item->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'photo_url' => $item->item->photo_url,
                'discount' => ($discount > 0) ? (string) $discount : "0.00",
                'offer_items_price' => (string) $offer_items_price,
                'type' => $item->item->type,
                'note' => $item->note,
                'delivery_cost' => settings()->delivery_cost,
                'shopping_cost' => settings()->shopping_cost,
            ];
            $obj = json_decode(json_encode($data));
            array_push($allItems, $obj);
        }

        // return responseJson(1, '', $items);
        return responseJson(1, '', $allItems);
    }
    public function deleteOrder(Request $request)
    {
        if ($request->has('order_id')) {
            $order = Order::find($request->order_id);
            if (!empty($order)) {
                $order->items()->detach();
                $order->delete();
                return responseJson(1, 'تم الحذف');
            } else  return responseJson(0, 'لا يمكن الحصول على بيانات الطلب');
        }
        return responseJson(0, 'لم يتم اختيار طلب');

        // $request->user()->orders()->where('id',$request->order_id);
        // return responseJson(1, 'تم الحذف');
    }
    public function newOrder(Request $request)
    {
        info('order details :' . json_encode($request->all()));
        info('user create order :' . json_encode($request->user()));


        $validation = validator()->make($request->all(), [
            'items' => 'required|array',
            'items.*.item_id' => 'required',
            'items.*.quantity' => 'required',
            'items.*.type' => 'required',
            'address' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            // return responseJson(0, $validation->errors()->first(), $errorString);
            return responseJson(0, $errorString, null);
        }

        // $merchant = Merchant::find($request->merchant_id);

        // // merchant closed
        // if ($merchant->availability == 'closed') {
        //     return responseJson(0, 'عذرا المطعم غير متاح في الوقت الحالي');
        // }

        // client
        // set defaults
        $order = $request->user()->orders()->create([
            'note' => $request->note,
            'state' => 'pending', // db default
            'address' => $request->address,
            'phone' => $request->phone,
            'home_phone' => $request->home_phone,
            'delivery_cost' => settings()->delivery_cost,
            'shopping_cost' => settings()->shopping_cost

        ]);

        $cost = 0;
        $delivery_cost = settings()->delivery_cost;
        $shopping_cost = settings()->shopping_cost;
        $merchants_ids = [];
        $merchant_id = 0;
        // info($request->items);
        foreach ($request->items as $i) {
            if ($i['type'] == 'item') {
                // ['item_id' => 1,'quantity' => 2,'note'=>'no tomato']
                $item = Item::find($i['item_id']);
            } else if ($i['type'] == 'offer') {

                $item = Offer::find($i['item_id']);
            } else if ($i['type'] == 'spacialItem') {

                $item = SpacialItem::find($i['item_id']);
            }
            // item validation // no logic
            if ($item) {
                $readyItem = [
                    $i['item_id'] => [
                        'quantity' => $i['quantity'],
                        'price' => $item->price,
                        'note' => (isset($i['note'])) ? $i['note'] : '',
                        'item_type' => get_class($item)
                    ]
                ];
                $order->items()->attach($readyItem);
                $price = $item->price - $item->discount;
                $cost += ($price * $i['quantity']);
                array_push($merchants_ids, $item->merchant_id);
                $merchant_id = $item->merchant_id;
            } else  return responseJson(0, 'المنتج غير موجود', null);
        }
        // return $merchant_id;
        // minimum charge
        // if ($cost >= $merchant->minimum_charger) {
        $total = $cost + $delivery_cost + $shopping_cost; // 200 SAR
        // $commission = settings()->commission * $cost; // 20 SAR  // 10 // 0.1  // $total; edited to remove delivery cost from percent.
        // $net = $total - settings()->commission;
        $update = $order->update([
            'cost' => $cost,
            // 'delivery_cost' => $delivery_cost,
            'total' => $total,
            'merchant_id'=>$merchant_id
            // 'commission' => $commission,
            // 'net' => $net,
        ]);
        $request->user()->cart()->detach();

        // $admin = User::where('email', 'admin@admin.com')->get();
        // $collection1=collect($admin);
        // $merged=$collection1->merge($request->user()->get());
        // return $merged->all();


        /* notification */
        // $admin->notifications()->create([
        //     'title' => 'لديك طلب جديد',
        //     'title_en' => 'You have New order',
        //     'content' => 'لديك طلب جديد من العميل ' . $request->user()->name,
        //     'content_en' => 'You have New order by client ' . $request->user()->name,
        //     'order_id' => $order->id,
        // ]);
        // return $order;

        $this->sendOrderNotification('create order ', $order, $request->user(), $merchants_ids);


        $tokens = $request->user()->tokens()->where('token', '!=', '')->pluck('token')->toArray();
        // return $tokens;
        $audience = ['include_player_ids' => $tokens];
        $contents = [
            'en' => $request->user()->name . 'Thank you for using Talab Station App....You have created new order ',
            'ar' => $request->user()->name . 'شكرا لاستخدامك تطبيق طلب ستاشن...لقد قمت بعمل طلب جديد ',
        ];
        // $send = notifyByOneSignal($audience, $contents, [
        //     'user_type' => 'client',
        //     'action' => 'new-order',
        //     'order_id' => $order->id,
        // ]);
        // $send = json_decode($send);
        /* notification */
        if (count($tokens)) {

            $title = 'طلب جديد';
            $body = ' شكرا لاستخدامك تطبيق طلب ستيشن... طلب جديد رقم' . $order->id;
            $data = [
                'title' => 'طلب جديد',
                'body' =>  ' شكرا لاستخدامك تطبيق طلب ستيشن... طلب جديد رقم' . $order->id,
                'imageUrl' => url('uploads/mock.jpg'),

                "click_action" =>".OrdersActivity",

            ];
            $send = notifyByFirebase($title, $body, $tokens, $data);
            info("firebase result client: " . $send);
            // info("firebase data: " . $data);

        }
        $merchant = Merchant::where('id', $merchant_id)->first();
       $merchant_tokens= $merchant->tokens()->pluck('token')->toArray();
        if (count($merchant_tokens)) {

            $title = 'طلب جديد';
            $body = ' لديك طلب جديد رقم' . $order->id;
            $data = [
                'title' => 'طلب جديد',
                'body' =>  'لديك طلب جديد رقم' . $order->id,
                'imageUrl' => url('uploads/mock.jpg')
            ];
            $send = notifyByFirebase($title, $body, $merchant_tokens, $data);
            info("firebase result merchant: " . $send);
            // info("firebase data: " . $data);

        }
        // $tokens = $request->user()->tokens()->where('token', '!=', '')->pluck('token')->toArray();

        $data = [
            'order' => $order->fresh() // $order->fresh()  ->load (lazy eager loading) ->with('items')
        ];
        return responseJson(1, 'تم الطلب بنجاح', $data);
        // } 

        // else {
        //     $order->items()->delete();
        //     $order->delete();
        //     return responseJson(0, 'الطلب لابد أن لا يكون أقل من ' . $merchant->minimum_charger . ' ريال');
        // }
    }
    public function newOrderByGuest(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'merchant_id' => 'required',
            'items.*.item_id' => 'required',
            'items.*.quantity' => 'required',
            'payment_method_id' => 'required',
            //            'delivery_time_id' => 'required',
            //            'need_delivery_at' => 'required|date_format:Y-m-d',// H:i:s

            'name' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
            'address' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $merchant = Merchant::findOrFail($request->merchant_id);

        if ($merchant->availability == 'closed') {
            return responseJson(0, 'عذرا المطعم غير متاح في الوقت الحالي');
        }

        $guest = Guest::create($request->only(['name', 'phone', 'address', 'city_id']));
        $order = $guest->orders()->create([
            'merchant_id' => $request->merchant_id,
            'note' => $request->note,
            'state' => 'pending',
            'address' => $request->address,
            'payment_method_id' => $request->payment_method_id,
        ]);

        $cost = 0;
        $delivery_cost = $merchant->delivery_cost;
        foreach ($request->items as $i) {
            $item = Item::findOrFail($i['item_id']);
            $readyItem = [
                $i['item_id'] => [
                    'quantity' => $i['quantity'],
                    'price' => $item->price,
                    'note' => (isset($i['note'])) ? $i['note'] : ''
                ]
            ];
            $order->items()->attach($readyItem);
            $cost += ($item->price * $i['quantity']);
        }
        if ($cost >= $merchant->minimum_charger) {
            $total = $cost + $delivery_cost;
            $commission = settings()->commission * $cost;  //$total; as client requested.
            $net = $total - settings()->commission;
            $update = $order->update([
                'cost' => $cost,
                'delivery_cost' => $delivery_cost,
                'total' => $total,
                'commission' => $commission,
                'net' => $net,
            ]);

            /* notification */
            $merchant->notifications()->create([
                'title' => 'لديك طلب جديد',
                'title_en' => 'You have New order',
                'content' => 'لديك طلب جديد من العميل ' . $guest->name,
                'content_en' => 'You have New order by client ' . $guest->name,
                'order_id' => $order->id,
            ]);

            $tokens = $merchant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            $audience = ['include_player_ids' => $tokens];
            $contents = [
                'en' => 'You have New order by client ' . $guest->name,
                'ar' => 'لديك طلب جديد من العميل ' . $guest->name,
            ];
            $send = notifyByOneSignal($audience, $contents, [
                'user_type' => 'merchant',
                'action' => 'new-order',
                'order_id' => $order->id,
            ]);
            $send = json_decode($send);
            /* notification */

            $data = [
                'order' => $order->load('items')
            ];
            return responseJson(1, 'تم الطلب بنجاح', $data);
        } else {
            $order->delete();
            return responseJson(0, 'الطلب لابد أن لا يكون أقل من ' . $merchant->minimum_charger . ' ريال');
        }
    }

    public function myOrders(Request $request)
    {
        // $orderat = [];
        // $orders = $request->user()->orders()->get();
        // foreach ($orders as $order){
        //     $items=ItemOrder::where('order_id', $order->id)->with('item')->get();

        //     if(count($items)){
        //     foreach($items as $item)

        //    array_push( $orderat , $item->item->merchant_id);
        //     // $orderatt = $item->item->pluck('merchant_id');

        //     }

        // }
        // $merchants_photos=Merchant::whereIn('id',$orderat)->get()->pluck('photo_url');

        // return $merchants_photos;

        // $orders = $request->user()->orders()->where(function ($order) use ($request) {
        // 'pending', 'accepted','price_set', 'rejected','completed ', 'delivered','notdelivered'
        if ($request->has('state') && $request->state == 'completed') {
            // $order->where('state', '!=', 'pending');
            $orders = $request->user()->orders()->where('state', 'completed')->orWhere('state', 'rejected')->withCount('items')->latest()->paginate(20);
        } elseif ($request->has('state') && $request->state == 'current') {
            $orders = $request->user()->orders()->where('state', '!=', 'completed')->Where('state', '!=', 'rejected')->withCount('items')->latest()->paginate(20);
        }
        // })->withCount('items')->latest()->paginate(20);
        else  $orders = $request->user()->orders()->withCount('items')->latest()->paginate(20);

        return responseJson(1, 'تم التحميل', $orders);
    }

    public function showOrder(Request $request)
    {

        $data = [];
        $all_data = [];
        $items = [];
        $spacialitems = [];


        $order_items = ItemOrder::where('order_id', $request->order_id)->with('item')->get()->pluck('item.merchant_id');
        $merchants = Merchant::whereIn('id', $order_items)->get();

        foreach ($merchants as $merchant) {

            $merchant_items = ItemOrder::where('order_id', $request->order_id)->with('item')->get();
            foreach ($merchant_items as $item) {
                // return $item;
                if ($item->item->merchant_id == $merchant->id)

                    array_push($items, $item);
                // if ($item->item->type == 'spacialItem')
                //     array_push($spacialitems, $item);
            }
            $data = [
                'merchant' => $merchant,
                'items' => $items,
                // 'spacial_Items'=>$spacialitems
            ];
            array_push($all_data, $data);
            $items = array();
            $spacialitems = array();
        }
        return responseJson(1, 'تم التحميل', $all_data);
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
        $order = $request->user()->orders()->find($request->order_id);

        if (!$order) {
            return responseJson(0, 'لا يمكن الحصول على البيانات');
        }
        if ($order->state == 'pending') {
            return responseJson(0, 'لا يمكن تأكيد استلام الطلب ،الطلب قيد التنفيذ');
        }
        $order = Order::where('id', $request->order_id)->first()->load('runners');
        $runners = $order->runners;
        $order_runner = null;
        foreach ($runners as $r) {
            if ($r->pivot->state == "accepted")
                $order_runner = $r;
        }

        if ($order->delivery_confirmed_by_client == 1) {
            return responseJson(1, 'تم تأكيد الاستلام مسبقا', [

                'runner' => $order_runner
            ]);
        }
        $order->update(['delivery_confirmed_by_client' => 1, 'state' => 'completed']);


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

        return responseJson(1, 'تم تأكيد الاستلام', [

            'runner' => $order_runner
        ]);
    }

    public function declineOrder(Request $request)
    {
        $order = $request->user()->orders()->find($request->order_id);
        if (!$order) {
            return responseJson(0, 'لا يمكن الحصول على البيانات');
        }
        if ($order->state == 'pending') {
            return responseJson(0, 'لا يمكن رفض استلام الطلب ، لم يتم قبول الطلب');
        }
        $runners = $order->runners;
        $order_runner = null;
        foreach ($runners as $r) {
            if ($r->pivot->state == "accepted")
                $order_runner = $r;
        }
        if ($order->delivery_confirmed_by_client == -1) {
            return responseJson(1, 'تم رفض استلام الطلب', [

                'runner' => $order_runner
            ]);
        }

        $order->update(["delivery_confirmed_by_client" => -1, 'state' => 'rejected']);
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

        return responseJson(1, 'تم رفض استلام الطلب', [

            'runner' => $order_runner
        ]);
    }
    //merchant rate
    public function review(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'rate' => 'required',
            // 'comment' => 'required',
            'merchant_id' => 'required|exists:merchants,id',

        ]);
        if ($validation->fails()) {
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }

        $merchant = Merchant::find($request->merchant_id);

        if (!$merchant) {
            return responseJson(0, 'لا يمكن الحصول على البيانات');
        }

        $request->merge(['client_id' => $request->user()->id]);

        // $clientOrdersCount = $request->user()->orders()
        //     ->where('merchant_id', $merchant->id)
        //     ->where('state', 'accepted')
        //     ->count();
        // if ($clientOrdersCount == 0) {
        //     return responseJson(0, 'لا يمكن التقييم الا بعد تنفيذ طلب من المطعم');
        // }
        // $checkOrder = $request->user()->orders()
        //     ->where('merchant_id', $merchant)
        //     ->where('state', 'accepted')
        //     ->count();
        // if ($checkOrder > 0) {
        //     return responseJson(0, 'لا يمكن التقييم الا بعد بيان حالة استلام الطلب');
        // }
        $merch_client = Review::where('merchant_id', $request->merchant_id)->where('client_id', $request->user()->id)->first();
        if (!$merch_client)
            $merchant->reviews()->create($request->all());
        else {
            $merch_client->update([
                'rate' => $request->rate,
                'comment' => $request->comment
            ]);
        }
        $review = Review::where('merchant_id', $request->merchant_id)->where('client_id', $request->user()->id)->first();

        return responseJson(1, 'تم التقييم بنجاح', [
            'review' => $review
        ]);
    }
    ////runner rate
    public function runnerReview(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'rate' => 'required',
            // 'note' => 'required',
            'runner_id' => 'required|exists:runners,id',
            'order_id' => 'required|exists:orders,id',
        ]);
        if ($validation->fails()) {
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }

        $runner = Runner::find($request->runner_id)->first();

        if (!$runner) {
            return responseJson(0, 'لا يمكن الحصول على البيانات');
        }

        $request->merge(['client_id' => $request->user()->id]);

        // $clientOrdersCount = $request->user()->orders()
        //     ->where('merchant_id', $merchant->id)
        //     ->where('state', 'accepted')
        //     ->count();
        // if ($clientOrdersCount == 0) {
        //     return responseJson(0, 'لا يمكن التقييم الا بعد تنفيذ طلب من المطعم');
        // }
        // $checkOrder = $request->user()->orders()
        //     ->where('merchant_id', $merchant)
        //     ->where('state', 'accepted')
        //     ->count();
        // if ($checkOrder > 0) {
        //     return responseJson(0, 'لا يمكن التقييم الا بعد بيان حالة استلام الطلب');
        // }

        $runner_client = RunnerReview::where('runner_id', $request->runner_id)->where('client_id', $request->user()->id)->where('order_id', $request->order_id)->first();
        if (!$runner_client)
            $runner->reviews()->create([
                'rate' => $request->rate,
                'note' => $request->note,
                'client_id' => $request->user()->id,
                'runner_id' => $request->runner_id,
                'order_id' => $request->order_id,

            ]);
        else {
            $runner_client->update([
                'rate' => $request->rate,
                'note' => $request->note
            ]);
        }
        $review = RunnerReview::where('runner_id', $request->runner_id)->where('client_id', $request->user()->id)->where('order_id', $request->order_id)->first();


        return responseJson(1, 'تم التقييم بنجاح', [
            'review' => $review,
            // 'runner'=>$order_runner
        ]);
    }
    public function merchantsToRate(Request $request)
    {

        $ids = [];
        $user = $request->user();
        if (!empty($user->orders))
            foreach ($user->orders as $order)
                foreach ($order->items as $i)
                    array_push($ids, $i->merchant_id);

        $merchants = Merchant::whereIn('id', $ids)->get();
        // return $user->orders()->with('items')->get();
        // return $ids;
        return responseJson(1, 'تم التحميل', $merchants);
    }
    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications()->latest()->paginate(20);
        return responseJson(1, 'تم التحميل', $notifications);
    }
    public function sendOrderNotification($mg1, $order, $client, $merchants_ids)
    {

        $text = Auth()->user()->name . " {$mg1}";

        $admin = User::where('email', 'admin@admin.com')->get();
        $collection1 = collect($admin);
        $client_notify = Client::where('id', $client->id)->get();
        $ids[] = $merchants_ids;
        $merchants = Merchant::whereIn('id', $ids)->get();


        $merged = $collection1->merge($client_notify)->merge($merchants);
        $merged_all = $merged->all();
        event(new SomeEvent($order, $text, $merged_all));

        // $tokens = $client->tokens()->where('token', '!=', '')->pluck('token')->toArray();
        // $audience = ['include_player_ids' => $tokens];
        // $contents = [
        //     'en' => 'You have created New order  ',
        //     'ar' => 'لقد قمت بعمل طلب جديد',
        // ];
        // // $send = notifyByOneSignal($audience , $contents , [
        // //     'user_type' => 'merchant',
        // //     'action' => 'new-order',
        // //     'order_id' => $order->id,
        // // ]);
        // // $send = json_decode($send);
        // // return $tokens;
        // if (count($tokens)) {

        //     $title = $mg1;
        //     $body = $mg1;
        //     $data = [
        //         'action' => 'Notification',
        //         'order' => 'Notification'
        //     ];
        //     $send = notifyByFirebase($title, $body, $tokens, $data);
        //     info("firebase result: " . $send);
        // }
    }
}
