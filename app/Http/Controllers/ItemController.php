<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Merchant;
use App\Models\Restaurant;
use App\Models\Section;
use App\Models\Unit;
use Illuminate\Http\Request;

use Response;

class ItemController extends Controller
{
    //
    public function index(Restaurant $restaurant)
    {
        $items = $restaurant->items()->paginate(20);
        return view('admin.items.index', compact('items', 'restaurant'));
    }

    public function create($id)
    {
        $categories = Category::all();
        $units = Unit::all();
        $merchant = Merchant::find($id);
        return view('admin.items.create', compact('categories', 'units', 'merchant'));
    }

    public function store(Request $request, Merchant $merchant)
    {
         $validateData= [
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'unit_id' => 'required',
            'photo'=> 'required',
        ];
        $messages = [
            'name.required' =>  ' ادخل اسم الصنف ',
            'price.required' =>  'حدد سعر الصنف ',
            'category_id.required' =>  'حدد تصنيف المنتج ',
            'unit_id.required' =>  'حدد وحدة المنتج ',
            'photo.required' =>  'اختر صورة للمنتج ',
        ];
      
        $valid = validator($request->all(), $validateData);
    
        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

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
        }

        return response()->json(['success' => true, 'message' => 'تمت الاضافة بنجاح']);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $merchant = Merchant::findOrFail($id);
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.items.edit', compact('item', 'merchant', 'categories', 'units'));
    }

    public function update(Request $request, $item_id)
    {
       
        $validateData= [
            'name' => 'required',
            'price' => 'required|numeric',
           
        ];
        $messages = [
            'name.required' =>  ' ادخل اسم الصنف ',
            'price.required' =>  'حدد سعر الصنف ',
        
        ];
      
        $valid = validator($request->all(), $validateData);
    
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
        // $data = [
        //     'status' => 1,
        //     'msg' => 'تم الحذف بنجاح',
        //     'id' => $item->id
        // ];
        // return Response::json($data, 200);
        return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);
    }

    public function duplicate(Request $request, $restaurant, $item)
    {
        $addons = $item->addons;
        $newItem = $item->replicate();
        $newItem->save();
        foreach ($addons as $addon) {
            $newAddon = $addon->replicate();
            $newAddon->item_id = $newItem->id;
            $newAddon->save();

            $options = $addon->options;

            foreach ($options as $option) {
                $newOption = $option->replicate();
                $newOption->addon_id = $newAddon->id;
                $newOption->save();
            }
        }

        flash()->success('تم نسخ بيانات الصنف بنجاح.');
        return back();
    }
}
