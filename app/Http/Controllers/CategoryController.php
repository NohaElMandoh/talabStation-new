<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use Response;


class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.1
     *
     * @return Response
     */
    public function create()
    {

        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validateData= [
            'name' => 'required'
        ];
        $messages = [
            'name.required' =>  'ادخل اسم التصنيف ',
            
        ];
      
        $valid = validator($request->all(), $validateData,$messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

        $category = Category::create($request->all());
        //   flash()->success('تم إضافة القسم بنجاح');
        //   return redirect('admin/category');
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $destinationPath = public_path() . '/uploads/categories';
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given
            $category->photo =  'uploads/categories/' . $name;
            $category->save();
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
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {

        $validateData= [
            'name' => 'required'
        ];
        $messages = [
            'name.required' =>  'ادخل اسم التصنيف ',
            
        ];
      
        $valid = validator($request->all(), $validateData,$messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $destinationPath = public_path() . '/uploads/categories';
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given
            $category->photo =  'uploads/categories/' . $name;
            $category->save();
        }
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
        $category = Category::findOrFail($id);
        $count = $category->merchants()->count();
        return $count;
        if ($count > 0) {
            return response()->json(['success' => false, 'message' => 'لا يمكن الحذف']);
        } else {
            $category->delete();
            return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);
        }
        //   $count = $category->restaurants()->count();
        //   if ($count > 0)
        //   {
        //       $data = [
        //           'status' => 0,
        //           'msg' => 'لا يمكن مسح التصنيف ، يوجد مطاعم مسجلة به'
        //       ];
        //       return Response::json($data, 200);
        //   }
        //   $category->delete();
        //   $data = [
        //       'status' => 1,
        //       'msg' => 'تم الحذف بنجاح',
        //       'id' => $id
        //   ];
        //   return Response::json($data, 200);
    }
}
