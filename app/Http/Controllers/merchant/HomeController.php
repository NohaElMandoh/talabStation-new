<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Merchant;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Region;
use App\Models\Type;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:merchant_web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = auth()->user()->notifications()->latest()->get();
        // $all_orders = [];
        $new_orders = [];
        $completed_orders = [];

        // $total_orders = Order::orderBy('created_at', 'DESC')->get();
        // foreach ($total_orders as $order) {
        //     foreach ($order->items as $o)
        //         //    return $o; //return item details
        //         if ($o->merchant_id == Auth::user()->id)
        //             array_push($all_orders, $o->orders);
        // }

        $all_orders=Order::where('merchant_id',  Auth::user()->id)-> orderBy('created_at', 'DESC')->get();


        //$rejected_orders

        $new_orders = Order::where('merchant_id',  Auth::user()->id)-> orderBy('created_at', 'DESC')->where('state', '=', 'pending')->get();
        // foreach ($all_orders_new as $order) {
        //     foreach ($order->items as $o)
        //         //    return $o; //return item details
        //         if ($o->merchant_id == Auth::user()->id)
        //             array_push($new_orders, $o->orders);
        // }

        $completed_orders= Order::where('merchant_id',  Auth::user()->id)->orderBy('created_at', 'DESC')->where('state', '=', 'delivered')->get();
        // foreach ($all_orders_completed as $order) {
        //     foreach ($order->items as $o)
        //         //    return $o; //return item details
        //         if ($o->merchant_id == Auth::user()->id)
        //             array_push($completed_orders, $o->orders);
        // }

        $rejected_orders= Order::where('merchant_id',  Auth::user()->id)->orderBy('created_at', 'DESC')->where('state', '=', 'rejected')->get();
        

        return view('merchant.home', compact('notifications', 'new_orders', 'completed_orders', 'all_orders', 'rejected_orders'));
    }
    public function editProfile()
    {
        // return $id;
        $cities = City::all();
        $regions = Region::all();
        $types = Type::where('id', '!=', 1)->get();
        $categories = Category::all();


        return view('merchant.profile.edit-profile', compact('cities', 'regions', 'types', 'categories'));
    }
    public function getRegions($city_id)
    {

        $regions = Region::where('city_id', $city_id)->get();
        return response()->json(['success' => true, 'regions' => $regions]);
    }
    public function getCategories($type_id)//get categories according to type
    {

        $categories = Category::where('type_id', $type_id)->get();
        return response()->json(['success' => true, 'categories' => $categories]);
    }
    
    public function updateProfile(Request $request)
    {

        $validateData = [
            'name' => 'required',
            'address' => 'required',
            'region_id' => 'required',
            'phone'=> 'required',
        ];
        $messages = [
            'name.required' =>  'ادخل اسم التاجر ',
            'address.required' =>  'حدد العنوان ',
            'region_id.required' =>  'تأكد من تحديد المحافظه والمنطقه ',
            'phone.required' =>  'ادخل تليفون ',
            
        ];
        $valid = validator($request->all(), $validateData,$messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

            $merchant = Merchant::where('id', $request->merchant_id)->first();
            $merchant->update($request->all());

            if ($request->hasFile('photo')) {
                $path = public_path();
                $destinationPath = $path . '/uploads/merchants/'; // upload path
                $logo = $request->file('photo');
                $extension = $logo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                $logo->move($destinationPath, $name); // uploading file to given path
                $merchant->update(['photo' => 'uploads/merchants/' . $name]);
            }

            if ($request->has('categories')) {

                $categories = $request->categories;
                $categories_explode = explode(',', $categories);
                $merchant->categories()->sync($categories_explode);
            } else
                $merchant->categories()->sync([]);
            return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);
        
    }
    public function changePassword(Request $request)
    {


        $validateData = [
            'password' => 'required|confirmed',
        ];
        $valid = validator($request->all(), $validateData);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);


        $request->merge(array('password' => bcrypt($request->password)));

        $merchant = Merchant::where('id', $request->merchant_id)->first();
        $merchant->update($request->all());


        return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);
    }
}
