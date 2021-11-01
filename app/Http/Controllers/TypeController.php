<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Contact;
use App\Models\Type;
use Response;


class TypeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $types = Type::paginate(20);
    return view('admin.types.index', compact('types'));
  }

  /**
   * Show the form for creating a new resource.1
   *
   * @return Response
   */
  public function create()
  {
    $model = new Type();
    return view('admin.types.create', compact('model'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

    $validateData = [
      'name_ar' => 'required',
      'name_en' => 'required',
      'photo' => 'required',

    ];
    $messages = [
      'name_ar.required' =>  'حدد نوع المتجر باللغه العربية ',
      'name_en.required' =>  'حدد نوع المتجر باللغه الانجليزية ',
      'photo.required' =>  'اختر صورة ',


    ];

    $valid = validator($request->all(), $validateData, $messages);

    if ($valid->fails())
      return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

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

    return response()->json(['success' => true, 'message' => 'تمت الإضافة بنجاح']);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $type = Type::findOrFail($id);
    return view('admin.types.edit', compact('type'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, Request $request)
  {
    $validateData = [
      'name_ar' => 'required',
      'name_en' => 'required',
    ];
    $messages = [
      'name_ar.required' =>  'حدد نوع المتجر باللغه العربية ',
      'name_en.required' =>  'حدد نوع المتجر باللغه الانجليزية ',


    ];

    $valid = validator($request->all(), $validateData, $messages);

    if ($valid->fails())
      return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

    $item = Type::find($id);
    $item->update($request->all());

    if ($request->hasFile('photo')) {
      $path = public_path();
      $destinationPath = $path . '/uploads/types/'; // upload path
      $photo = $request->file('photo');
      $extension = $photo->getClientOriginalExtension(); // getting image extension
      $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
      $photo->move($destinationPath, $name); // uploading file to given path
      $item->update(['photo' => 'uploads/types/' . $name]);
    }

    return response()->json(['success' => true, 'message' => 'تمت التعديل بنجاح']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $type = Type::findOrFail($id);
    //   $count = $category->restaurants()->count();
    //   if ($count > 0)
    //   {
    //       $data = [
    //           'status' => 0,
    //           'msg' => 'لا يمكن مسح التصنيف ، يوجد مطاعم مسجلة به'
    //       ];
    //       return Response::json($data, 200);
    //   }
    $type->delete();
    return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);
  }
}
