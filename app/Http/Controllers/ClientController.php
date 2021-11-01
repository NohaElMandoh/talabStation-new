<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\City;
use App\Models\Client;
use App\Models\Region;
use Response;


class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $clients = Client::with('region')->latest()->paginate(20);
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.1
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::all();
        $regions = Region::all();
        return view('admin.clients.create', compact('cities', 'regions'));
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
            'password' => 'confirmed',
        ];
        // $messages = [
        //     'name.required' =>  'ادخل الاسم باللغة الانجليزية',
        //     'password.confirmed' =>  'ادخل الاسم باللغة العربية',

        // ];
        $valid = validator($request->all(), $validateData);

              if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);


        $client = Client::create($request->all());
        if ($request->has('password')) {
            $password= bcrypt($request->password);
            $client->update(['password' => $password]);

        }
        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/clients/'; // upload path
            $logo = $request->file('photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $client->update(['photo' => 'uploads/clients/' . $name]);
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
        $client = Client::find($id);
        $cities = City::all();
        $regions = Region::all();
        return view('admin.clients.edit', compact('client', 'cities', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $client = Client::findOrFail($id);
        $client->update($request->all());
        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/clients/'; // upload path
            $logo = $request->file('photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $client->update(['photo' => 'uploads/clients/' . $name]);
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
        $client = Client::findOrFail($id);
        $client->delete();
        return response()->json(['success' => true, 'message' => 'تم الحذف بنجاح']);

    }
}
