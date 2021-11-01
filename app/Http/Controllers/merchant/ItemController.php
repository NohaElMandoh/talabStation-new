<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Merchant;
use App\Models\Restaurant;
use App\Models\Section;
use App\Models\Unit;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;

class ItemController extends Controller
{
    //
    public function index()
    {
        $items = Auth::user()->items()->paginate(20);
        return view('merchant.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Auth::user()->categories;
        $units = Unit::all();
        return view('merchant.items.create', compact('categories', 'units'));
    }

    public function store(Request $request, Merchant $merchant)
    {
        // return $request->all();
        // $validateData = [
        //     'name' => 'required',
        //     'price' => 'required|numeric',
        //     'category_id' => 'required',
        //     'unit_id' => 'required',
        //     'photo' => 'required',
        //     'description' => 'required',
        // ];
        // $messages = [
        //     'name.required' =>  'إسم المنتج مطلوب ',
        //     'price.required' =>  'حدد سعر المنتج  ',
        //     'category_id.required' =>  'حدد تصنيف المنتج ',
        //     'unit_id.required' =>  'حدد وحدة المنتج ',
        //     'photo.required' =>  'اختر صورة المنتج ',
        //     'description.required' =>  'اكتب وصف للمنتج ',


        // ];
        // $valid = validator($request->all(), $validateData, $messages);

        // if ($valid->fails())
        //     return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);


        if ($request->has('merchant_id')) {
            $merchant = Merchant::findOrFail($request->merchant_id);
            $item = $merchant->items()->create($request->all());;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $destinationPath = public_path() . '/uploads/items';
                $extension = $photo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                $photo->move($destinationPath, $name); // uploading file to given
                $item->photo =  'uploads/items/' . $name;
                $item->save();
            }
            // ----------add item photos
            //start validate and insert project images or files
            if (!empty($request['images'])) {
return $request['images'];
                // $valid = validator(
                //     $request->all(),
                //     ['images.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf,txt,docx,mp4,3gp,mp3|max:2048',],
                //     [
                //         'images.*.required' => 'Please upload an image',
                //         'images.*.mimes'    => 'Only jpeg,png,bmp,pdf,docx,txt,mp4,3gp,mp3 files are allowed',
                //         'images.*.max'      => 'Sorry! Maximum allowed size for an image is 20MB',
                //     ]
                // );
                // if ($valid->fails())
                //     return redirect()->back()->withErrors($valid)->withInput();
                $resultFiles = [];
                foreach ($request['images'] as $image) {

                    // $photo = $request->file('photo');
                    $destinationPath = public_path() . '/uploads/items';
                    $extension = $image->getClientOriginalExtension(); // getting image extension
                    $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
                    $image->move($destinationPath, $name); // uploading file to given
                    // $item->photo =  'uploads/items/' . $name;
                    // $item->save();
                    $data[] = [
                        'photo' =>  'uploads/items/' . $name,
                    ];
                    $resultFiles += $data;
                }
            }
            return $resultFiles;
            //start add files to project
            if (!empty($resultFiles)) {
                foreach ($resultFiles as $r) {
                    // $ext = explode('.', $r['name']);
                    $item->images()->create([
                        'item_id' => $item->id,
                        'photo' => $r['photo'],
                    ]);
                }
            }

            // ----------------
        }

        return response()->json(['success' => true, 'message' => 'تمت الاضافة بنجاح']);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('merchant.items.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Auth::user()->categories;
        $units = Unit::all();
        return view('merchant.items.edit', compact('item', 'categories', 'units'));
    }

    public function update(Request $request, $item_id)
    {

        $validateData = [

            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'unit_id' => 'required',
            'photo' => 'required',
            'description' => 'required',
        ];
        $messages = [
            'name.required' =>  'إسم المنتج مطلوب ',
            'price.required' =>  'حدد سعر المنتج  ',
            'category_id.required' =>  'حدد تصنيف المنتج ',
            'unit_id.required' =>  'حدد وحدة المنتج ',
            'photo.required' =>  'اختر صورة المنتج ',
            'description.required' =>  'اكتب وصف للمنتج ',


        ];
        $valid = validator($request->all(), $validateData, $messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);


        $item = Item::findOrFail($item_id);
        $item->update($request->all());
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $destinationPath = public_path() . '/uploads/items';
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given
            $item->photo =  'uploads/items/' . $name;
            $item->save();
        }

        return response()->json(['success' => true, 'message' => 'تمت التعديل بنجاح']);
    }

    public function destroy($item_id)
    {
        // to do
        // delete addons and options
        $item = Item::findOrFail($item_id);
        $item->delete();
        return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);
    }
}
