<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

use App\Http\Requests;

use Response;

class CityController extends Controller
{
    //
    public function index()
    {
        $cities = City::paginate(20);
        return view('admin.cities.index',compact('cities'));
    }

    public function create(City $model)
    {
        return view('admin.cities.create');

    }

    public function store(Request $request)
    {
       
        $validateData= [
            'name_ar' => 'required',
            'name_en' => 'required',
        ];
        $messages = [
            'name_en.required' =>  'ادخل الاسم باللغة الانجليزية',
            'name_ar.required' =>  'ادخل الاسم باللغة العربية',

        ];
        $valid = validator($request->all(), $validateData,$messages);

              if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

        City::create($request->all());

        return response()->json(['success' => true, 'message' => 'تمت الاضافة بنجاح']);

    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('admin.cities.edit',compact('city'));
    }

    public function update(Request $request , $id)
    {
        
        $validateData= [
            'name_ar' => 'required',
            'name_en' => 'required',
        ];
        $messages = [
            'name_en.required' =>  'ادخل الاسم باللغة الانجليزية',
            'name_ar.required' =>  'ادخل الاسم باللغة العربية',

        ];
        $valid = validator($request->all(), $validateData,$messages);

              if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);
            
        $city=City::findOrFail($id);
        $city->update($request->all());

        return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);

    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);

        $city->delete();
        return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);

    }
}
