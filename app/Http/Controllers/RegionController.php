<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;

use Response;

class RegionController extends Controller
{
    //
    public function index()
    {
        $regions = Region::latest()->paginate(20);
        return view('admin.regions.index', compact('regions'));
    }

    public function create(Region $model)
    {
        $cities = City::all();
        return view('admin.regions.create', compact('cities'));
    }

    public function store(Request $request)
    {

        $validateData = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'city_id' => 'required'
        ];
        $messages = [
            'name_ar.required' =>  'ادخل اسم المنطقة باللغه العربية ',
            'name_en.required' =>  'ادخل اسم المنطقة باللغه الانجليزية ',
            'city_id.required' =>  ' اختر المحافظة التابع لها المنطقة ',
        ];

        $valid = validator($request->all(), $validateData, $messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

        if ($request->has('city_id')) {
            if ($request->city_id > 0) {
                Region::create($request->all());
            }
            else
        return response()->json(['success' => false, 'errors' => ['اختر محافظة']]);

        }

        return response()->json(['success' => true, 'message' => 'تمت الإضافة بنجاح']);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $region = Region::findOrFail($id);
        $cities = City::all();


        return view('admin.regions.edit', compact('region', 'cities'));
    }

    public function update(Request $request, $id)
    {

        $validateData = [
            'name_ar' => 'required',
            'name_en' => 'required',

            'city_id' => 'required'
        ];
        $messages = [
            'name_ar.required' =>  'ادخل اسم المنطقة باللغه العربية ',
            'name_en.required' =>  'ادخل اسم المنطقة باللغه الانجليزية ',
            'city_id.required' =>  ' اختر المحافظة التابع لها المنطقة ',
        ];


        $valid = validator($request->all(), $validateData, $messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);
            if ($request->has('city_id')) {
                if ($request->city_id > 0) {
                    Region::findOrFail($id)->update($request->all());
                }
                else
            return response()->json(['success' => false, 'errors' => ['اختر محافظة']]);
    
            }

      
        return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);
    }

    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();

        // $count = $region->restaurants()->count();
        return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);

        // if ($count > 0)
        // {
        //     $data = [
        //         'status' => 0,
        //         'msg' => 'لا يمكن مسح المنطقة ، يوجد مطاعم مسجلة بها'
        //     ];
        //     return Response::json($data, 200);
        // }
        // $region->delete();
        // $data = [
        //     'status' => 1,
        //     'msg' => 'تم الحذف بنجاح',
        //     'id' => $id
        // ];
        // return Response::json($data, 200);
    }
}
