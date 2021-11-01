<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Item;
use App\Models\Merchant;
use App\Models\Offer;
use App\Models\OfferTitle;
use Response;


class OfferController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $offers = Offer::with('merchant')->latest()->get();
        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.1
     *
     * @return Response
     */
    public function create()
    {
        $model = Offer::latest()->paginate(10);
        $merchants = Merchant::all();
        $offerTitles = OfferTitle::all();

        return view('admin.offers.create', compact('model', 'merchants', 'offerTitles'));
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
            'price' => 'required|numeric',
            'starting_at' => 'required',
            'ending_at' => 'required',
            'photo' => 'required',
            'offer_title_id' => 'required',
            'items' => 'required',
            'description'=> 'required',


        ];
        $messages = [
            'name.required' =>  'ادخل اسم العرض ',
            'items.required' =>  'حدد أصناف العرض ',
            'description.required' =>  'ادخل وصف العرض ',

            
        ];
      
        $valid = validator($request->all(), $validateData,$messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

        $offer = Offer::create($request->all());

        if ($request->hasFile('photo')) {

            $path = public_path();
            $destinationPath = $path . '/uploads/offers/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $offer->update(['photo' => '/uploads/offers/' . $name]);
        }

        $data = json_decode($request['items']);
        $items_ids = [];
        foreach ($data as $item) {
            array_push($items_ids, $item->item_id);
        }
        $offer->items()->sync($items_ids);

        // flash()->success('تم إضافة العرض بنجاح');
        // return redirect('admin/offer');
        return response()->json(['success' => true, 'message' => 'تمت الإضافه بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $offer = Offer::with('merchant', 'items')->findOrFail($id);

        return view('admin.offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $merchants = Merchant::all();
        $offerTitles = OfferTitle::all();
        $merch_items = Item::where('merchant_id', $offer->merchant_id)->get();
        $offerItems = $offer->items()->get();
        return view('admin.offers.edit', compact('offer', 'merchants', 'offerTitles', 'offerItems','merch_items'));
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
            'name' => 'required',
            'price' => 'required|numeric',
            'starting_at' => 'required',
            'ending_at' => 'required',
            'offer_title_id' => 'required',
            'items' => 'required',
            'description'=> 'required',

        ];
        $messages = [
            'name.required' =>  'ادخل اسم العرض ',
            'items.required' =>  'حدد أصناف العرض ',
            'description.required' =>  'ادخل وصف العرض ',
        ];
      
        $valid = validator($request->all(), $validateData,$messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

        $offer = Offer::findOrFail($id);
        $offer->update($request->all());

        if ($request->hasFile('photo')) {

            $path = public_path();
            $destinationPath = $path . '/uploads/offers/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $offer->update(['photo' => '/uploads/offers/' . $name]);
        }

        $data = json_decode($request['items']);
        $items_ids = [];
        foreach ($data as $item) {
            array_push($items_ids, $item->item_id);
        }
        $offer->items()->sync($items_ids);

        // flash()->success('تم تعديل بيانات العرض بنجاح');
        // return redirect('admin/offer/' . $id . '/edit');
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
        $offer = Offer::findOrFail($id);
        $offer->delete();
        // $data = [
        //     'status' => 1,
        //     'msg' => 'تم الحذف بنجاح',
        //     'id' => $id
        // ];
        // return Response::json($data, 200);
        return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);

    }

    public function items_merchant($merchant_id)
    {
        if (!empty($merchant_id)) {
            $items = Item::where('merchant_id', $merchant_id)->get();
            //    dd($comment);
            return response()->json(['success' => true, 'items' => $items]);
        }
        return response()->json(['success' => false, 'errors' => [0 => 'Not Found Data']]);
    }

    public function notify($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->notify = 1;
        $offer->save();
        // flash()->success('تم التفعيل');
        // return back();
        return response()->json(['success' => true, 'message' => 'تمت الاضافه للاشعارات']);


    }

    public function noNotify($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->notify = 0;
        $offer->save();
        return response()->json(['success' => true, 'message' => 'تم الحذف من الاشعارات']);

    }

}
