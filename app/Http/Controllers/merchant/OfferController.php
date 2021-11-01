<?php

namespace App\Http\Controllers\merchant;

use App\Events\OfferEvent;
use App\Events\SomeEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Item;
use App\Models\Merchant;
use App\Models\Offer;
use App\Models\OfferTitle;
use App\User;
use Auth;
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

        $offers = Auth::user()->offers()->latest()->paginate(10);
        return view('merchant.offers.index', compact('offers'));
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

        return view('merchant.offers.create', compact('model', 'merchants', 'offerTitles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validateData = [
            'name' => 'required',
            'price' => 'required|numeric',
            'starting_at' => 'required|after_or_equal:today', // Accept today date',
            'ending_at' => 'required|after_or_equal:starting_at|after_or_equal:today',
            'photo' => 'required',
            'offer_title_id' => 'required',
            'items'=> 'required',
            'description'=> 'required',
        ];
        $messages = [
            'name.required' =>  'ادخل عنوان العرض ',
            'price.required' =>  'حدد سعر العرض ',
            'starting_at.required' =>  'حدد تاريخ بداية العرض ',
            'ending_at.required' =>  'حدد تاريخ نهاية العرض ',
            'starting_at.after_or_equal' =>  ' تاريخ بداية العرض يجب ان يبدا اليوم او بعده',
            'ending_at.after_or_equal' =>  ' تاريخ نهاية العرض يجب ان يكون اليوم او بعده كما يجب ان يبدأ بعد تاريخ البداية ',
            // 'ending_at.after_or_equal:starting_at' =>  'تاريخ نهاية العرض يجب ان يكون بعد تاريخ بداية العرض',
            'photo.required' =>  'حدد صورة  العرض ',
            'offer_title_id.required' =>  'حدد  تصنيف العرض ',
            'items.required' =>  'حدد أصناف العرض ',
            'description.required' =>  'ادخل وصف العرض ',


        ];
        $valid = validator($request->all(), $validateData, $messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);
        if ($request->has('items')) {
            if ($request->befor_offer < $request->price) {
                return response()->json(['success' => false, 'errors' => ["سعر العرض اكبر من إجمالى  المنتجات ... تأكد من البيانات "]]);
            }
        }
        $offer = Auth::user()->offers()->create([
            'name' => $request->name,
            'price' => $request->price,
            'starting_at' =>  $request->starting_at,
            'ending_at' =>  $request->ending_at,
            'description' => $request->description,
            'offer_title_id' => $request->offer_title_id,
        ]);

        if ($request->hasFile('photo')) {

            $path = public_path();
            $destinationPath = $path . '/uploads/offers/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $offer->update(['photo' => '/uploads/offers/' . $name]);
        }
        if ($request->has('items')) {
            $data = json_decode($request['items']);

            $items_ids = [];
            foreach ($data as $item) {
                array_push($items_ids, $item->item_id);
            }
            $offer->items()->sync($items_ids);
        }

        $this->sendOfferNotification('create offer ', $offer);

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

        return view('merchant.offers.show', compact('offer'));
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
        
        return view('merchant.offers.edit', compact('offer', 'merchants', 'offerTitles', 'offerItems', 'merch_items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
// return $request->all();
        $validateData = [
            'name' => 'required',
            'price' => 'required|numeric',
            'starting_at' => 'required', // Accept today date',
            'ending_at' => 'required|after_or_equal:starting_at',
            'offer_title_id' => 'required',
            'items' => 'required',
            'description'=> 'required',
        ];

        $messages = [
            'name.required' =>  'ادخل عنوان العرض ',
            'price.required' =>  'حدد سعر العرض ',
            'starting_at.required' =>  'حدد تاريخ بداية العرض ',
            'ending_at.required' =>  'حدد تاريخ نهاية العرض ',
            // 'starting_at.after_or_equal' =>  ' تاريخ بداية العرض يجب ان يبدا اليوم او بعده',
            'ending_at.after_or_equal' =>  ' تاريخ نهاية العرض يجب ان يكون اليوم او بعده كما يجب ان يبدأ بعد تاريخ البداية ',
            'offer_title_id.required' =>  'حدد  تصنيف العرض ',
            'items.required' =>  'حدد أصناف العرض ',
            'description.required' =>  'ادخل وصف العرض ',
        ];
        $valid = validator($request->all(), $validateData, $messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);

        if ($request->has('items')) {
            if ($request->befor_offer < $request->price) {
                return response()->json(['success' => false, 'errors' => ["سعر العرض اكبر من السعر قبل العرض تأكد من البيانات "]]);
            }
        }

        $offer = Offer::findOrFail($id);
        $request->merge(array('merchant_id' => $request->user()->id));

        $offer->update($request->all());

        if ($request->hasFile('photo')) {

            $path = public_path();
            $destinationPath = $path . '/uploads/offers/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $offer->update(['photo' => 'uploads/offers/' . $name]);
        }
        if($request->has('items')){
            $data = json_decode($request['items']);
            $items_ids = [];
            foreach ($data as $item) {
                array_push($items_ids, $item->item_id);
            }
            $offer->items()->sync($items_ids);
    
        }

      
        $this->sendOfferNotification('update offer ', $offer);

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
    public function sendOfferNotification($mg1, $offer)
    {
        $text = Auth()->user()->name . " {$mg1}";
        event(new OfferEvent($offer, $text));
    }
}
