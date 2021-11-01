<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Galary;
use Image;
use Response;


class GalaryController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $galaries = Galary::paginate(20);
    return view('admin.galaries.index',compact('galaries'));
  }

  /**
   * Show the form for creating a new resource.1
   *
   * @return Response
   */
  public function create()
  {
  
    return view('admin.galaries.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $validateData= [
        'name' => 'required',
        'position'=>'required',
        'display'=>'required',
    ];
    // $messages = [
    //     'name.required' =>  'ادخل اسم  ',
    //     'name.position' =>  'ادخل اسم  ',

    //     'name.display' =>  'ادخل اسم  ',

        
    // ];
  
    $valid = validator($request->all(), $validateData);

    if ($valid->fails())
        return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

     $image= Galary::create($request->all());
     if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $destinationPath = public_path() . '/uploads/galary';
        $extension = $photo->getClientOriginalExtension(); // getting image extension
        $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
        $photo->move($destinationPath, $name); // uploading file to given
        $image->photo =  'uploads/galary/' . $name;
        $image->save();
    }
      return response()->json(['success' => true, 'message' => 'تمت الاضافة بنجاح']);

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
      $image = Galary::findOrFail($id);
      return view('admin.galaries.edit',compact('image'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id , Request $request)
  {
     
      $validateData= [
        'name' => 'required',
    ];
    // $messages = [
    //     'name.required' =>  'ادخل اسم  ',
    //     'name.position' =>  'ادخل اسم  ',

    //     'name.display' =>  'ادخل اسم  ',

        
    // ];
  
    $valid = validator($request->all(), $validateData);

    if ($valid->fails())
        return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

     $image= Galary::findOrFail($id)->update($request->all());
     
    return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      $galary = Galary::findOrFail($id);
      return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);

    //   $count = $category->restaurants()->count();
    //   if ($count > 0)
    //   {
    //       $data = [
    //           'status' => 0,
    //           'msg' => 'لا يمكن مسح التصنيف ، يوجد مطاعم مسجلة به'
    //       ];
    //       return Response::json($data, 200);
    //   }
    //   $galary->delete();
    //   $data = [
    //       'status' => 1,
    //       'msg' => 'تم الحذف بنجاح',
    //       'id' => $id
    //   ];
    //   return Response::json($data, 200);
  }

  public function display($id)
    {
      $image = Galary::findOrFail($id);
      $image->display = 1;
      $image->save();
        return response()->json(['success' => true, 'message' => 'تمت الاضافه الى العرض']);


    }

    public function noDisplay($id)
    {
        $image = Galary::findOrFail($id);
        $image->display = 0;
        $image->save();
        return response()->json(['success' => true, 'message' => 'تم الحذف من العرض']);

    }

  
}

?>