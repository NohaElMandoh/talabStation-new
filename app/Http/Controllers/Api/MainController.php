<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\DeliveryMethod;
use App\Models\DeliveryTime;
use App\Models\Galary;
use App\Models\Item;
use App\Models\Merchant;
use App\Models\Offer;
use App\Models\OfferTitle;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Region;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Section;
use App\Models\Token;
use App\Models\Unit;
use App\Models\Type;

use DB;
use Illuminate\Http\Request;
use Log;

class MainController extends Controller
{
    public function items_category_merchant(Request $request)
    {
        $item = [];
        if ($request->has('merchant_id')) {
            if ($request->has('category_id')) {
                $item =  Item::where('category_id', $request->category_id)
                    ->where('merchant_id', $request->merchant_id)->latest()->paginate(20);
            } else
                $item = Item::where('merchant_id', $request->merchant_id)->latest()->paginate(20);
        }
        if (!empty($item))
            return responseJson(1, 'تم التحميل', $item->load('unit'));
        else
            return responseJson(1, 'تم التحميل', $item);
    }
    public function allItems(Request $request)
    {
        if ($request->has('category_id')) {
            $item =  Item::where('category_id', $request->category_id)->latest()->paginate(20);
        }
        if ($request->has('merchant_id')) {
            $item =  Item::where('merchant_id', $request->merchant_id)->latest()->paginate(20);
        } else
            $item = Item::latest()->paginate(20);
        return responseJson(1, 'تم التحميل', $item->load('category', 'unit', 'merchant'));
    }
    public function types(Request $request)
    {
        $types = Type::withCount('merchants')->paginate(20);
        return responseJson(1, 'تم التحميل', $types);
    }
    public function merchants_category(Request $request)
    {

        $data =   Merchant::whereHas('categories', function ($query) use ($request) {
            if ($request->has('category_id')) {
                return $query->where('category_id', $request->category_id);
            } else
                return $query;
        })->paginate(10);

        return responseJson(1, 'تم التحميل', $data->load('categories'));
    }
    public function merchants_type(Request $request)
    {

        if ($request->has('type_id'))
            $data =   Merchant::where('type_id', $request->type_id)->where('id', '!=', 1)->paginate(10);
        else
            $data =   Merchant::where('id', '!=', 1)->paginate(10);

        return responseJson(1, 'تم التحميل', $data->load('type'));
    }
    public function units(Request $request)
    {
        $units = Unit::all();
        // $cities = City::where(function($q) use($request){
        //     if ($request->has('name')){
        //         $q->where('name','LIKE','%'.$request->name.'%');
        //     }
        // })->paginate(10);
        return responseJson(1, 'تم التحميل', $units);
    }
    public function galary(Request $request)
    {
        if ($request->has('position')) {
            if ($request->position == 'slider')
                $data =   Galary::where('position', $request->position)->paginate(5);
            else if ($request->position == 'menu')
                $data =   Galary::where('position', $request->position)->paginate(1);
        } else $data =   Galary::paginate(5);
        return responseJson(1, 'تم التحميل', $data);
    }
    public function cities(Request $request)
    {
        $cities = City::all();
        // $cities = City::where(function($q) use($request){
        //     if ($request->has('name')){
        //         $q->where('name','LIKE','%'.$request->name.'%');
        //     }
        // })->paginate(10);
        return responseJson(1, 'تم التحميل', $cities->load('regions'));
    }
    public function newCity(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',


        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $item = City::create($request->all());

        return responseJson(1, 'تم الاضافة بنجاح', $item);
    }
    public function newType(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'photo' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $item = Type::create($request->all());

        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/types/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $item->update(['photo' => 'uploads/types/' . $name]);
        }


        return responseJson(1, 'تم الاضافة بنجاح', $item);
    }
    public function newUnit(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $unit = Unit::create($request->all());

        return responseJson(1, 'تم الاضافة بنجاح', $unit);
    }

    public function regions(Request $request)
    {
        // $regions = Region::where(function($q) use($request){
        //     if ($request->has('name')){
        //         $q->where('name','LIKE','%'.$request->name.'%');
        //     }
        // })->where('city_id',$request->city_id)->paginate(10);
        $regions = Region::where('city_id', $request->city_id)->get();

        return responseJson(1, 'تم التحميل', $regions);
    }
    public function newRegion(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name_ar' => 'required',
            'name_en' => 'required',
            'delivery_cost' => 'required',
            'city_id' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $item = Region::create($request->all());

        return responseJson(1, 'تم الاضافة بنجاح', $item->load('city'));
    }
    public function citiesNotPaginated(Request $request)
    {
        $cities = City::where(function ($q) use ($request) {
            if ($request->has('name')) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            }
        })->get();
        return responseJson(1, 'تم التحميل', $cities);
    }

    public function regionsNotPaginated(Request $request)
    {
        $regions = Region::where(function ($q) use ($request) {
            if ($request->has('name')) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            }
        })->where('city_id', $request->city_id)->get();
        return responseJson(1, 'تم التحميل', $regions);
    }

    public function ajax_region(Request $request)
    {
        $regions = Region::where('city_id', $request->city_id)->get();
        return responseJson(1, 'تم التحميل', $regions);
    }

    public function categories()
    {
        $items = [];

        $categories = Category::withCount('merchants')->paginate(10);
    
        return responseJson(1, 'تم التحميل', $categories);
    }
    public function categories_merchant(Request $request)
    {
        $items_categories = [];
        if ($request->has('merchant_id')) {
            // $merchant = Merchant::where('id',$request->merchant_id)->first();

            $items_categories = Merchant::where('id', $request->merchant_id)->with([
                'categories' => function ($q) use ($request) {

                    $q->with(['items' => function ($q) use ($request) {
                        $q->where('merchant_id', $request->merchant_id);
                    }]);
                }
            ])->get();
            return responseJson(1, 'تم التحميل', $items_categories);
        } else
            return responseJson(0, 'لم يتم اختيار تاجر', []);

    }
    public function newCategory(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'photo' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $item = Category::create($request->all());
        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/categories/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $item->update(['photo' => 'uploads/categories/' . $name]);
        }

        return responseJson(1, 'تم الاضافة بنجاح', $item);
    }
    public function newOfferTitle(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'photo' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $offer = OfferTitle::create($request->all());
        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/offersTitle/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $offer->update(['photo' => 'uploads/offersTitle/' . $name]);
        }

        return responseJson(1, 'تم الاضافة بنجاح', $offer->load('type'));
    }
    public function items_category(Request $request)
    {

        // $items = item::where(function ($q) use ($request) {
        //     if ($request->has('category_id')) {
        //         $q->where('category_id', $request->category_id );
        //     }
        // })->get();

        if ($request->has('category_id')) {
            $items = item::where('category_id', $request->category_id)->orderBy('created_at', 'desc')->paginate(10);
        } else if ($request->has('merchant_id')) {
            $items = item::where('merchant_id', $request->merchant_id)->orderBy('created_at', 'desc')->paginate(10);
        } else
            $items = item::orderBy('created_at', 'desc')->paginate(10);

        return responseJson(1, 'تم التحميل', $items);
    }


    public function paymentMethods()
    {
        $methods = PaymentMethod::all();
        return responseJson(1, 'تم التحميل', $methods);
    }

    /**
     * @param Request $request
     * @return mixed
     * @todo filter by nearest using location sent from user
     *
     *
     */
    public function restaurants()
    {
        $restaurant_type = Type::where('name_en', 'Restaurant')->first();

        $restaurants = Merchant::where('type_id', $restaurant_type->id)->get();

        return responseJson(1, 'تم التحميل', $restaurants->load('region', 'categories', 'items'));
    }
    public function merchants(Request $request)
    {
        $merchants = Merchant::all();

        // $merchants = Merchant::where(function($q) use($request) {
        //     if ($request->has('keyword'))
        //     {
        //         $q->where(function($q2) use($request){
        //             $q2->where('name','LIKE','%'.$request->keyword.'%');
        //         });
        //     }

        //     if ($request->has('region_id'))
        //     {
        //         $q->where('region_id',$request->region_id);
        //     }

        //     if ($request->has('categories'))
        //     {
        //         $q->whereHas('categories',function($q2) use($request){
        //             $q2->whereIn('categories.id',$request->categories);
        //         });
        //     }

        //     if ($request->has('availability'))
        //     {
        //         $q->    where('availability',$request->availability);
        //     }


        // })->has('items')->with('region', 'categories')->activated()->get();

        // return responseJson(1,'تم التحميل',$merchants);
        return responseJson(1, 'تم التحميل', $merchants->load('region', 'categories', 'items'));
        /*
         *->orderByRating()
         * ->sortByDesc(function ($restaurant) {
            return $restaurant->reviews->sum('rate');
        })
         * */
    }

    public function merchant(Request $request)
    {
        $merchant = Merchant::with('region', 'categories')->findOrFail($request->merchant_id);

        return responseJson(1, 'تم التحميل', $merchant);
    }

    public function items(Request $request)
    {
        // $items = Item::where('merchant_id', $request->merchant_id)->enabled()->paginate(20);
        $items = Item::paginate(20);

        return responseJson(1, 'تم التحميل', $items);
    }

    public function offers(Request $request)
    {
        // $offers = Offer::where(function($offer) use($request){
        //     if($request->has('merchant_id'))
        //     {
        //         $offer->where('merchant_id',$request->merchant_id);
        //     }
        // })->has('merchant')->with('merchant')->latest()->paginate(20);
        // // $offers = Offer::all();
        $validation = validator()->make($request->all(), [
            'merchant_id' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0, $errorString, null);
            // return responseJson(0, $validation->errors()->first(), $data);
        }
        $merchant = Merchant::where('id', $request->merchant_id)->first();
        $offers = [];
        if ($merchant)
            $offers = $merchant->offers()->with('merchant', 'items')->latest()->paginate(20);
        return responseJson(1, '', $offers);
    }

    public function offer(Request $request)
    {
        $offer = Offer::with('merchant', 'items')->find($request->offer_id);
        if (!$offer) {
            return responseJson(0, 'no data');
        }
        return responseJson(1, '', $offer);
    }


    public function reviews(Request $request)
    {
        $restuarant = Merchant::find($request->merchant_id);
        if (!$restuarant) {
            return responseJson(0, 'no data');
        }
        $reviews = $restuarant->reviews()->paginate(10);
        return responseJson(1, '', $reviews);
    }

    public function list_merchantsReviews(Request $request)
    {
        $reviews = Merchant::paginate(10)->sortByDesc('rate')->values();
        return responseJson(1, '', $reviews);
    }
    public function list_merchantsoffers(Request $request)
    {
        $today = \Carbon\Carbon::today()->toDateString();
        $offers = [];
        $offersT = [];

        if ($request->has('merchant_id')) {
            $merchant = Merchant::where('id', $request->merchant_id)->first();
            if ($merchant) {
                // $offers = $merchant->offers()->whereDate('ending_at', '>=', $today)->orderBy('created_at', 'DESC')->get()

                //     ->sortByDesc('offer_title_id');
                //     // ->with('items','offerTitles')->get();
                // return responseJson(1, '', $offers);
                $offers_titles = $merchant->offers()->pluck('offer_title_id');
                $titles = OfferTitle::whereIn('id', $offers_titles)->get();
                foreach ($titles as $title) {
                    foreach( $title->offers as $off){
                        if($off->merchant_id == $request->merchant_id){
                        array_push($offersT,$off);
                        }
                    }
                    $data=['offerTitle'=>$title,
                    'offers'=>$offersT
                ];
                array_push($offers,$data);

                }
                return responseJson(1, '', $offers);

                // return $titles;
            } else  return responseJson(0, 'لم يتم العثور على بيانات التاجر', 'لم يتم العثور على بيانات التاجر');
        } else {
            $offers = [];
            $merchant_offers = Merchant::whereHas('offers')->orderBy('created_at', 'DESC')->get();
            foreach ($merchant_offers as $m) {
                if (!empty($m->last_offer))
                    array_push($offers, $m);
            }

            return responseJson(1, '', $offers);

            // return responseJson(1, '', $merchant_offers);
        }
    }
    public function list_TalabStationOffers(Request $request)
    {
        $today = \Carbon\Carbon::today()->toDateString();
        $offers = [];
        $allOffers = [];
        $offer_items_price = 0;
        // if ($request->has('merchant_id')) {
        $merchant = Merchant::where('id', 1)->first();
        if ($merchant) {
            $offers = $merchant->offers()->whereDate('ending_at', '>=', $today)->orderBy('created_at', 'DESC')->get();

            foreach ($offers as $offer) {
                foreach ($offer->items as $offer_item) {
                    $offer_items_price += $offer_item->price;
                }
                $data = [

                    'id' => $offer->id,
                    'name' => $offer->name,
                    'price' => $offer->price,
                    'description' => $offer->description,
                    'starting_at' =>  $offer->starting_date,
                    'ending_at' =>  $offer->ending_date,
                    'photo_url' => $offer->photo_url,
                    'offer_title' => $offer->offerTitle->name,
                    'offer_items_price' => (string) $offer_items_price,
                    'type' => 'offer'
                ];
                $obj = json_decode(json_encode($data));
                array_push($allOffers, $obj);
            }
            return responseJson(1, '', $allOffers);
        } else  return responseJson(0, 'لم يتم العثور على بيانات التاجر', 'لم يتم العثور على بيانات التاجر');
    }
    public function list_newMerchants(Request $request)
    {
        $newMerchants = Merchant::orderBy('created_at', 'DESC')->paginate(10);
        return responseJson(1, '', $newMerchants);
    }
    public function addMerchantToSelectedList(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'merchant_id' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $merchant = Merchant::where('id', $request->merchant_id)->first();

        if ($merchant)
            $merchant->update([
                'selected' => 1
            ]);
        return responseJson(1, 'تمت الاضافه الى القائمه', $merchant);
    }

    public function list_selectedMerchants(Request $request)
    {
        $newMerchants = Merchant::where('selected', 1)->get();
        return responseJson(1, '', $newMerchants);
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user()->notifications()->with('order')->latest()->paginate(20);
        return responseJson(1, '', $notifications);
    }

    public function testNotification(Request $request)
    {
        //        $audience = ['included_segments' => array('All')];
        //        if ($request->has('ids'))
        //        {
        //            $audience = ['include_player_ids' => (array)$request->ids];
        //        }
        //        $contents = ['en' => $request->title];
        //        Log::info('test notification');
        //        Log::info(json_encode($audience));
        //        $send = notifyByOneSignal($audience , $contents , $request->data);
        //        Log::info($send);

        /*
        firebase
        */
        $tokens = $request->ids;
        $title = $request->title;
        $body = $request->body;
        $data = Order::first();
        $send = notifyByFirebase($title, $body, $tokens, $data, true);
        info("firebase result: " . $send);

        return response()->json([
            'status' => 1,
            'msg' => 'تم الارسال بنجاح',
            'send' => json_decode($send)
        ]);
    }

    public function testPusher(Request $request)
    {
        $data = 'طلب جديد ';
        $data .= '#' . $request->order_id . ' ';
        $data .= 'من مطعم ';
        $data .= 'همذان';
        return pusher('dashboard_channel', 'new_order', $data);
    }

    public function contactUs(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'type' => 'required|in:complaint,suggestion,inquiry',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'content' => 'required'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        Contact::create($request->all());

        return responseJson(1, 'تم الارسال بنجاح');
    }

    public function settings()
    {
        return responseJson(1, '', settings());
    }
}
