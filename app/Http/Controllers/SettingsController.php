<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //
    public function view()
    {
        
        if (Settings::all()->count() > 0)
        {
            $settings = Settings::find(1);
        }

        return view('admin.settings.view',compact('settings'));
    }

    public function update(Request $request)
    {
        $validateData= [
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'delivery_cost' => 'required',
            'shopping_cost' => 'required',
            'about_app'=> 'required',
            'terms'=> 'required',
            
        ];
        $messages = [
            'facebook.required' =>  'ادخل لينك facebook ',
            'twitter.required' =>  'ادخل لينك twitter ',
            'instagram.required' =>  'ادخل لينك instagram ',
            'delivery_cost.required' =>  'حدد تكلفه التوصيل',
            'shopping_cost.required' =>  'حدد تكلفه الشراء',
            'about_app.required' =>  'اكتب نبذه عن طلب ستيشن',
            'terms.required' =>  'اكتب احكام التطبيق',
        ];
      
        $valid = validator($request->all(), $validateData,$messages);

        if ($valid->fails())
            return response()->json(['success' => false, 'errors' => $valid->errors()->all()]);


        if (Settings::all()->count() > 0)
        {
          $s=  Settings::find(1);
           $s ->update($request->all());
        }else{
            Settings::create($request->all());
        }
        return response()->json(['success' => true, 'message' => 'تم التعديل بنجاح']);

    }
}
