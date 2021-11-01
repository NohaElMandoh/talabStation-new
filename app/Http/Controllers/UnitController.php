<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Response;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::latest()->paginate(20);

        return view('admin.units.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $validateData = [
            'name_ar' => 'required',
            'name_en' => 'required',
          ];
          $messages = [
            'name_ar.required' =>  'ادخل اسم الوحدة باللغه العربية ',
            'name_en.required' =>  'ادخل اسم الوحدة باللغه الانجليزية ',
          ];
      
          $valid = validator($request->all(), $validateData, $messages);
      
          if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);
      

        Unit::create($request->all());

        return response()->json(['success' => true, 'message' => 'تمت الإضافة بنجاح']);

    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.units.edit',compact('unit'));
    }

    public function update(Request $request , $id)
    {
       
        $validateData = [
            'name_ar' => 'required',
            'name_en' => 'required',
          ];
          $messages = [
            'name_ar.required' =>  'ادخل اسم الوحدة باللغه العربية ',
            'name_en.required' =>  'ادخل اسم الوحدة باللغه الانجليزية ',
          ];
      
          $valid = validator($request->all(), $validateData, $messages);
      
          if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);
      
        Unit::findOrFail($id)->update($request->all());

        return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);

    }

    public function destroy($id)
    {
        
        $unit = Unit::findOrFail($id);

        $unit->delete();
        return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);


    } 
}
