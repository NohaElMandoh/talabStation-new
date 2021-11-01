<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Merchant;
use App\Models\Photo;
use App\Models\Region;
use App\Models\Type;
use App\User;
use DB;
use Illuminate\Http\Request;
use Response;

class MerchantController extends Controller
{
    public function index(Request $request)
    {
        // $merchants = Merchant::where(function ($q) use ($request) {

        //     if ($request->has('name')) {
        //         $q->where(function ($q2) use ($request) {
        //             $q2->where('name', 'LIKE', '%' . $request->name . '%');
        //         });
        //     }

        //     if ($request->has('city_id')) {
        //         $q->whereHas('region',function ($q2) use($request){
        //             // search in mechant region "Region" Model
        //             $q2->whereCityId($request->city_id);
        //         });
        //     }


        //     if ($request->has('availability')) {
        //         $q->where('availability',$request->availability);
        //     }

        // })->with('region.city')->latest()->paginate(20);
        $merchants = Merchant::latest()->paginate(20);
        // $contractors =$user->whereHas('roles',function($q){
        //     $q->where('name','merchant_contractor');
        //     })->pluck('name','id')->toArray();
        $cities = City::pluck('name_ar', 'id')->toArray();
        
        $user = User::all();


        return view('admin.merchants.index', compact('merchants', 'cities', 'user'));
    }

    public function create(Merchant $model)
    {
        $cities = City::all();
        $types = Type::where('id','!=',1)->get();
        $categories = Category::all();
        return view('admin.merchants.create', compact('model', 'cities', 'types', 'categories'));
    }

    public function store(Request $request)
    {


        $validateData = [
            'name' => 'required',
            // 'region_id' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed',
            'type_id' => 'required',
            'email' => 'required|unique:merchants,email',
            'photo' => 'required',
            // 'availability' => 'required',
        ];
        $messages = [
            'name.required' =>  ' ادخل اسم التاجر ',
            'region_id.required' =>  'حدد المحافظه والمنطقة ',
            'phone.required' =>  'ادخل رقم تليفون التاجر ',
            'email.required' =>  'ادخل البريد الاليكترونى للتاجر ',
            'email.unique' =>  ' البريد الاليكترونى موجود بالفعل ',

            'password.required' =>  'ادخل كلمه السر   ',
            'password.confirmed' =>  'كلمه السر غير متطابقة ',
            'type_id.required' =>  'حدد نوع المحل',
            'photo.required' =>  'حدد صورة المحل',
            // 'availability.required' =>  'حدد حالة المحل',
        ];

        $valid = validator($request->all(), $validateData, $messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

        $userToken = str_random(60);
        $request->merge(array('api_token' => $userToken));
        $request->merge(array('password' => bcrypt($request->password)));

        $merchant = Merchant::create($request->all());

        if ($request->hasFile('personal_photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/merchants/'; // upload path
            $logo = $request->file('personal_photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $merchant->personal_photo = 'uploads/merchants/' . $name;
            $merchant->save();
        }

        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/merchants/'; // upload path
            $logo = $request->file('photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $merchant->update(['photo' => 'uploads/merchants/' . $name]);
        }

        if ($request->has('regions_list')) {
            $merchant->delivery_regions()->attach($request->regions_list);
        }

        if ($request->has('categories')) {
            $merchant->categories()->sync($request->categories);
        }

        return response()->json(['success' => true, 'message' => 'تمت الإضافة بنجاح']);

        // flash()->success('تم إضافة المتجر بنجاح');
        //// return redirect('admin/mechant');
        // return redirect()->back();
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
    
    public function edit($id)
    {
        $merchant = Merchant::findOrFail($id);
        $cities = City::all();
        $types = Type::all();
        $categories = Category::all();
        return view('admin.merchants.edit', compact('merchant', 'types', 'categories', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $validateData = [
            'name' => 'required',
            'region_id' => 'required',
            'phone' => 'required',
            'type_id' => 'required',
            'email' => 'required',
            'photo' => 'required',
            'availability' => 'required',
        ];
        $messages = [
            'name.required' =>  ' ادخل اسم التاجر ',
            'region_id.required' =>  'حدد المحافظه والمنطقة ',
            'phone.required' =>  'ادخل رقم تليفون التاجر ',
            'email.required' =>  'ادخل البريد الاليكترونى للتاجر ',
          
            'type_id.required' =>  'حدد نوع المحل',
            'photo.required' =>  'حدد صورة المحل',
            'availability.required' =>  'حدد حالة المحل',
        ];

        $valid = validator($request->all(), $validateData, $messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);



        $merchant = Merchant::findOrFail($id);
        $merchant->update($request->all());

        if ($request->hasFile('personal_photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/merchants/'; // upload path
            $logo = $request->file('personal_photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $merchant->personal_photo = 'uploads/merchants/' . $name;
            $merchant->save();
        }
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
            $merchant->categories()->sync($request->categories);
        }

      
        return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);
    }
    public function changePassword(Request $request)
    {

// return $request->all();
        $validateData = [
            'password' => 'required|confirmed',
        ];
        $messages = [
            'password.required' =>  'ادخل كلمه السر   ',
            'password.confirmed' =>  'كلمه السر غير متطابقة ',
            ];

        $valid = validator($request->all(), $validateData,$messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);


        // $request->merge(array('password' => bcrypt($request->password)));
        $new_password=bcrypt($request->password);

        $merchant = Merchant::where('id', $request->merchant_id)->first();
        // return $merchant;

        $merchant->update(['password'=>$new_password]);

        return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);
    }

    public function destroy($id)
    {
        // if (count($merchant->orders) > 0) {
        //     // $data = [
        //     //     'status' => 0,
        //     //     'msg' => 'لا يمكن حذف المطعم ، لان به طلبات مسجلة',
        //     //     'id' => $merchant->id
        //     // ];
        //     // return Response::json($data, 200);
        // return response()->json(['success' => true, 'message' => 'لا يمكن حذف المتجر ، لان به طلبات مسجلة']);

        // }
        $merchant = Merchant::findOrFail($id);
        $merchant->delete();
        // $data = [
        //     'status' => 1,
        //     'msg' => 'تم الحذف بنجاح',
        //     'id' => $merchant->id
        // ];
        // return Response::json($data, 200);
        return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);
    }


    public function activate($id)
    {
        $merchant = Merchant::findOrFail($id);
        $merchant->activated = 1;
        $merchant->save();
        flash()->success('تم التفعيل');
        return back();
    }

    public function deActivate($id)
    {
        $merchant = Merchant::findOrFail($id);
        $merchant->activated = 0;
        $merchant->save();
        flash()->success('تم الإيقاف');
        return back();
    }

    public function showItems($id)
    {
        $merchant = Merchant::findOrFail($id);

        return view('admin.merchants.items', compact('merchant'));
    }
}
