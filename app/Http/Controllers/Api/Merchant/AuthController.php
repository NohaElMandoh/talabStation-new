<?php

namespace App\Http\Controllers\Api\Merchant;


use App\Models\Token;
use Hash;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\MerchantResetPassword;
use App\Mail\resetpassword;
use App\Models\Merchant;
use Config;

class AuthController extends Controller
{
    public function checkEmail(Request $request)
    {
        $validation = validator()->make($request->all(), [

            'email' => 'required|unique:merchants,email',

        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0, $validation->errors()->first(), $errorString);
        } else  return responseJson(1, 'استمر', 'استمر');
    }
    public function register(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:merchants,email',
            'password' => 'required|confirmed',
            'phone' => 'required|unique:merchants,phone',
            // 'delivery_cost' => 'required|numeric',
            // 'minimum_charger' => 'required|numeric',
            // 'whatsapp' => 'required',
            // 'availability' => 'required',
            'region_id' => 'required',
            'categories' => 'required|array',
            'photo' => 'image',
            'lat' => 'required',
            'lang' => 'required',
            'personal_photo' => 'image',
            'national_id_photo' => 'image',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            // return responseJson(0, $validation->errors()->first(), $errorString);
            return responseJson(0,  $errorString, null);
        }

        $userToken = str_random(60);
        $request->merge(array('api_token' => $userToken));
        $request->merge(array('password' => bcrypt($request->password)));
        $user = Merchant::create($request->all());

        if ($request->has('categories')) {
            $user->categories()->sync($request->categories);
        }

        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/merchants/'; // upload path
            $logo = $request->file('photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $user->update(['photo' => 'uploads/merchants/' . $name]);
        }

        if ($request->hasFile('personal_photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/merchants/personal/'; // upload path
            $logo = $request->file('personal_photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $user->update(['personal_photo' => 'uploads/merchants/personal/' . $name]);
        }
        if ($request->hasFile('national_id_photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/merchants/nationalID/'; // upload path
            $logo = $request->file('national_id_photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $user->update(['national_id_photo' => 'uploads/merchants/nationalID/' . $name]);
        }
        if ($user) {
            $code = rand(111111, 999999);
            $update = $user->update(['code' => $code]);
            if ($update) {
                info($user->email);

                // $this->sendMail($user->email, $code);
                // send email
                info(Config::get('mail'));
                Mail::send('emails.reset', ['code' => $code], function ($mail) use ($user) {
                    $mail->from('proofesser@gmail.com', 'تطبيق Talab Station');
                    $mail->bcc("nohamelmandoh@gmail.com");
                    $mail->to($user->email, $user->name)->subject('تأكيد كلمة المرور');
                });

                return responseJson(1, 'برجاء فحص بريدك الالكتروني');
            } else {
                return responseJson(0, 'حدث خطأ ، حاول مرة أخرى', null);
            }
        }
        if ($user) {
            $data = [
                'api_token' => $userToken,
                'data' => $user->load('region')
            ];
            return responseJson(1, 'تم التسجيل بنجاح', $data);
        } else {
            return responseJson(0, 'حدث خطأ ، حاول مرة أخرى');
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function profile(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'password' => 'confirmed',
            'photo' => 'image',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0, $validation->errors()->first(), $errorString);
            // return responseJson(0, $validation->errors()->first(), $data);
        }
        if ($request->has('name')) {
            $request->user()->update($request->only('name'));
        }
        if ($request->has('email')) {
            $request->user()->update($request->only('email'));
        }
        if ($request->has('password')) {
            $request->merge(array('password' => bcrypt($request->password)));
            $request->user()->update($request->only('password'));
        }

        if ($request->has('phone')) {
            $request->user()->update($request->only('phone'));
        }

        if ($request->has('region_id')) {
            if (is_numeric($request['region_id']))
                $request->user()->update($request->only('region_id'));
            else
                return responseJson(
                    0,
                    'حدث خطأ',
                    'رجاءا اختر منطقتك'
                );
        }

        if ($request->has('address')) {
            $request->user()->update($request->only('address'));
        }
        // if ($request->has('delivery_cost')) {
        //     $request->user()->update($request->only('delivery_cost'));
        // }
        // if ($request->has('minimum_charger')) {
        //     $request->user()->update($request->only('minimum_charger'));
        // }
        if ($request->has('lat')) {
            $request->user()->update($request->only('lat'));
        }
        if ($request->has('lang')) {
            $request->user()->update($request->only('lang'));
        }

        if ($request->has('categories')) {

            $request->user()->categories()->sync($request->categories);
        }
        if ($request->has('availability')) {
            $request->user()->update($request->only('availability'));
        }
        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/merchants/'; // upload path
            $logo = $request->file('photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $request->user()->update(['photo' => 'uploads/merchants/' . $name]);
        }

        if ($request->hasFile('national_id_photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/merchants/nationalID/'; // upload path
            $logo = $request->file('national_id_photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $request->user()->update(['national_id_photo' => 'uploads/merchants/nationalID/' . $name]);
        }


        $data = [
            'user' => $request->user()->load('region', 'categories')
        ];
        return responseJson(1, 'تم تحديث البيانات', $data);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0, $validation->errors()->first(), $errorString);
            // return responseJson(0, $validation->errors()->first(), $data);
        }

        $user = Merchant::where('email', $request->input('email'))->first();
        if (empty($user))
            //not exist 
            $user = Merchant::where('phone', $request->input('email'))->first();

        //    return  $user;

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                //                if (($user->total_commissions - $user->total_payments) > 400)
                //                {
                //                    return responseJson(0,'الحساب موقوف لتخطي العمولات التي لم تسدد الحد المطلوب');
                //                }
                if (($user->total_commissions - $user->total_payments) > 400) {
                    $data = [
                        'api_token' => $user->api_token,
                        'user' => $user->load('city'),
                    ];
                    return responseJson(
                        -1,
                        'تم ايقاف حسابك مؤقتا الى حين سداد العموله لوصولها للحد الاقصى ، يرجى مراجعة صفحة العمولة او مراجعة ادارة التطبيق شاكرين لكم استخدام تطبيق البياع',
                        $data
                    );
                }
                if ($user->activated == 0) {
                    return responseJson(0, 'الحساب موقوف .. تواصل مع الإدارة');
                }
                $data = [
                    'api_token' => $user->api_token,
                    'user' => $user->load('region', 'categories'),
                ];
                return responseJson(1, 'تم تسجيل الدخول', $data);
            } else {
                return responseJson(0, 'بيانات الدخول غير صحيحة');
            }
        } else {
            return responseJson(0, 'هذا الحساب غير موجود ');
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function reset(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'email' => 'required'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0,  $errorString, null);
            // return responseJson(0, $validation->errors()->first(), $data);
        }

        $user = Merchant::where('email', $request->email)->first();
        if ($user) {
            $code = rand(111111, 999999);
            $update = $user->update(['code' => $code]);
            if ($update) {
                info($user->email);

                // Mail::to($user->email)
                // ->bcc("nohamelmandoh@gmail.com")
                // ->send(new MerchantResetPassword($code));

                // $this->sendMail($user->email, $code);
                // send email
                info(Config::get('mail'));
                Mail::send('emails.reset', ['code' => $code], function ($mail) use ($user) {
                    $mail->from('proofesser@gmail.com', 'تطبيق البياع');
                    $mail->bcc("nohamelmandoh@gmail.com");
                    $mail->to($user->email, $user->name)->subject('إعادة تعيين كلمة المرور');
                });

                return responseJson(1, 'برجاء فحص بريدك الالكتروني');
            } else {
                return responseJson(0, 'حدث خطأ ، حاول مرة أخرى', null);
            }
        } else {
            return responseJson(0, 'لا يوجد أي حساب مرتبط بهذا البريد الالكتروني', null);
        }
    }
    public function sendMail($to_email, $code)
    {

        $user = new Merchant();
        $user->email = $to_email;
        // $user->notify(new MerchantResetPassword($code));
        info(Config::get('mail'));
        Mail::to($to_email)
            ->bcc("nohamelmandoh@gmail.com")
            ->send(new MerchantResetPassword($code));

        return back();

        // }

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function password(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'code' => 'required',
            'password' => 'confirmed'
        ]);


        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0, $errorString, null);
            // return responseJson(0, $validation->errors()->first(), $data);
        }

        $user = Merchant::where('code', $request->code)->where('code', '!=', 0)->first();

        if ($user) {
            $update = $user->update(['password' => bcrypt($request->password), 'code' => null]);
            if ($update) {
                return responseJson(1, 'تم تغيير كلمة المرور بنجاح');
            } else {
                return responseJson(0, 'حدث خطأ ، حاول مرة أخرى', null);
            }
        } else {
            return responseJson(0, 'هذا الكود غير صالح');
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function registerToken(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'type' => 'required|in:android,ios',
            'token' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0,  $errorString, null);
            // return responseJson(0, $validation->errors()->first(), $data);
        }

        Token::where('token', $request->token)->delete();

        $request->user()->tokens()->create($request->all());
        return responseJson(1, 'تم التسجيل بنجاح');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function removeToken(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'token' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0, $validation->errors()->first(), $errorString);
            // return responseJson(0, $validation->errors()->first(), $data);
        }

        Token::where('token', $request->token)->delete();
        return responseJson(1, 'تم الحذف بنجاح بنجاح');
    }
}
