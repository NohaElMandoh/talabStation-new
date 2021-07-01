<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Client;
use App\Models\Token;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Validation\Rule;
use Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function checkEmail(Request $request)
    {
        $validation = validator()->make($request->all(), [

            'email' => 'required|unique:clients,email',

        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            $errorString = implode(",", $validation->messages()->all());
            $user = Client::where('email', $request->email)->first();
            return responseJson(0,  $errorString, $user);
        } else  return responseJson(1, 'استمر', null);
        // if ($request->has('email')) {
        //     $user = Client::where('email',$request->email)->first();
        //     if ($user)
        //         return responseJson(1, 'الايميل موجود... استمر', 'الايميل موجود ...استمر');
        //     else  return responseJson(0, 'الايميل غير موجود', 'الايميل غير موجود');
        // } else return responseJson(0, "رجاء ادخل ايميل", "رجاء ادخل ايميل");
    }
    public function checkPhone(Request $request)
    {

        // $validation = validator()->make($request->all(), [

        //     'phone' => 'required|unique:clients,phone',

        // ]);
        // if ($validation->fails()) {
        //     $data = $validation->errors();
        //     $errorString = implode(",", $validation->messages()->all());
        //     $user = Client::where('phone', $request->phone)->first();
        //     return responseJson(1, 'استمر', null)
        //    ;
        // } else  return responseJson(0,  $errorString, $user);
        if ($request->has('phone')) {
            $user = Client::where('phone', $request->phone)->first();
            if ($user)
                return responseJson(1, 'الرقم موجود ...استمر', $user);
            else  return responseJson(0, 'الرقم غير موجود', null);
        } else return responseJson(0, "رجاء ادخل تليفون", null);
    }
    public function registerClient(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'phone' => 'required|unique:clients,phone',
            'region_id' => 'required',
            'address' => 'required',
            'email' => 'required|unique:clients,email',
            'password' => 'required|confirmed'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();

            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0, $errorString, null);
            // return responseJson(0,$validation->errors()->first(),$data);
        }

      
        $userToken = Str::random(60);
        $request->merge(array('api_token' => $userToken));
        $request->merge(array('password' => bcrypt($request->password)));
        $user = Client::create($request->all());
        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/clients/'; // upload path
            $logo = $request->file('photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $user->update(['photo' => 'uploads/clients/' . $name]);
        }
        if ($user) {
            $code = rand(111111, 999999);
            $update = $user->update(['code' => $code]);
            if ($update) {
                info($user->email);
                // send email

                Mail::send('emails.reset', ['code' => $code], function ($mail) use ($user) {
                    $mail->from('talab.station@gmail.com', 'تطبيق Talab Station');
                    $mail->bcc("nohamelmandoh@gmail.com");
                    $mail->to($user->email, $user->name)->subject('تأكيد كلمة المرور');
                });

                return responseJson(1, 'برجاء فحص بريدك الالكتروني');
            } else {
                return responseJson(0, 'حدث خطأ ، حاول مرة أخرى', null);
            }
        }
        // if ($user) {
        //     $data = [
        //         'api_token' => $userToken,
        //         'user' => $user->load('region')
        //     ];

        //     return responseJson(1, 'تم التسجيل بنجاح', $data);
        // } else {
        //     return responseJson(0, 'حدث خطأ ، حاول مرة أخرى');
        // }
    }
    public function registerSocial(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:clients,email',
            'provider' => 'required', //facebook,gmail,...etc
            'provider_id' => 'required', //SocialUserId
            'provider_token' => 'required', // 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();

            $errorString = implode(",", $validation->messages()->all());
            if ($validation->errors()->first() == "The email has already been taken.") {
                $client = Client::where('email', $request->email)->where('verified', 1)->first();
                if ($client) {
                    $data = [
                        'exist' => true,
                        'user' => $client->load('region'),
                        'api_token' => $client->api_token,
                        'msg' => "The email has already been taken."
                    ];

                    return responseJson(0, $errorString, $data);
                } else {
                    $client = Client::where('email', $request->email)->first();

                    $code = rand(111111, 999999);
                    $update = $client->update(['code' => $code]);
                    if ($update) {
                        info($client->email);
                        // send email

                        Mail::send('emails.reset', ['code' => $code], function ($mail) use ($client) {
                            $mail->from('talab.station@gmail.com', 'تطبيق Talab Station');
                            $mail->bcc("talab.station@gmail.com");
                            $mail->to($client->email, $client->name)->subject('تأكيد كلمة المرور');
                        });

                        $data = [
                            'exist' => false,
                            'user' => $client->load('region'),
                            'api_token' => $client->api_token,
                            'msg' => "برجاء فحص بريدك الاليكترونى"
                        ];

                        return responseJson(0, $errorString, $data);
                    } else {
                        $data = [
                            'exist' => false,
                            'user' => $client->load('region'),
                            'api_token' => $client->api_token,
                            'msg' => "حدث wخطأ ، حاول مرة أخرى",

                        ];

                        return responseJson(0, $errorString, $data);
                    }
                }
            } else return responseJson(0, $errorString, null);

            // return responseJson(0,$validation->errors()->first(),$data);
        }

        $userToken = str_random(60);
        $request->merge(array('api_token' => $userToken));
        // $request->merge(array('password' => bcrypt($request->password)));
        $user = Client::create($request->all());
        if ($request->has('photo_url')) {

            $user->update(['photo' => $request->photo_url]);
        }
        if ($user) {
            $code = rand(111111, 999999);
            $update = $user->update(['code' => $code]);
            if ($update) {
                info($user->email);
                // send email

                Mail::send('emails.reset', ['code' => $code], function ($mail) use ($user) {
                    $mail->from('talab.station@gmail.com', 'تطبيق Talab Station');
                    $mail->bcc("talab.station@gmail.com");
                    $mail->to($user->email, $user->name)->subject('تأكيد كلمة المرور');
                });

                return responseJson(1, 'برجاء فحص بريدك الالكتروني');
            } else {
                return responseJson(0, 'حدث خطأ ، حاول مرة أخرى', null);
            }
        }
        // if ($user) {
        //     $data = [
        //         // 'api_token' => $userToken,
        //         'user' => $user
        //     ];

        //     return responseJson(1, 'تم التسجيل بنجاح', $data);
        // } else {
        //     return responseJson(0, 'حدث خطأ ، حاول مرة أخرى');
        // }
    }
    public function registerPhone(Request $request)
    {
        $validation = validator()->make($request->all(), [

            'phone' => 'required|unique:clients,phone',

        ]);

        // if ($validation->fails()) {
        // $data = $validation->errors();

        // $errorString = implode(",", $validation->messages()->all());
        //  return responseJson(0, $errorString, null);
        // return responseJson(0,$validation->errors()->first(),$data);
        // }

        if ($request->has('phone')) {
            $user = Client::where('phone', $request->phone)->first();
            if ($user) {
                $data = [
                    'api_token' => $user->api_token,
                    'user' => $user->load('region')
                ];
                return responseJson(0, 'الرقم موجود ', $data);
            }
        }

        $userToken = str_random(60);
        $request->merge(array('api_token' => $userToken, 'verified' => 1));
        // $request->merge(array('password' => bcrypt($request->password)));
        $user = Client::create($request->all());

        // if ($user) {
        //     $code = rand(111111, 999999);
        //     $update = $user->update(['code' => $code]);
        //     if ($update) {
        //         info($user->email);
        //         // send email

        //         Mail::send('emails.reset', ['code' => $code], function ($mail) use ($user) {
        //             $mail->from('talab.station@gmail.com', 'تطبيق Talab Station');
        //             $mail->bcc("talab.station@gmail.com");
        //             $mail->to($user->email, $user->name)->subject('تأكيد كلمة المرور');
        //         });

        //         return responseJson(1, 'برجاء فحص بريدك الالكتروني');
        //     } else {
        //         return responseJson(0, 'حدث خطأ ، حاول مرة أخرى', null);
        //     }
        // }
        $user = Client::where('phone', $request->phone)->first();
        if ($user) {
            $data = [
                'api_token' => $userToken,
                'user' => $user->load('region')
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
            // Rule::unique('users')->ignore($request->user()->id),
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        if ($request->has('name')) {
            $request->user()->update($request->only('name'));
        }
        if ($request->has('email')) {
            $user = Client::where('email', $request->email)->first();
            if (!empty($user)){
            if($user->id !=$request->user()->id)
                return responseJson(0, 'البريد الاليكترونى موجود ', $user);
            }
            else
            $request->user()->update($request->only('email'));
        }
        if ($request->has('password')) {
            $request->merge(array('password' => bcrypt($request->password)));
            $request->user()->update($request->only('password'));
        }

        if ($request->has('phone')) {

            $user = Client::where('phone', $request->phone)->first();
            if(!empty($user)){
            if ($user->id !=$request->user()->id)
                return responseJson(0, 'الرقم موجود ', $user);
            }
            else
                $request->user()->update($request->only('phone'));

        }

        if ($request->has('region_id')) {
            $request->user()->update($request->only('region_id'));
        }

        if ($request->has('address')) {
            $request->user()->update($request->only('address'));
        }
        if ($request->has('lat')) {
            $request->user()->update($request->only('lat'));
        }
        if ($request->has('lang')) {
            $request->user()->update($request->only('lang'));
        }
        if ($request->has('home_phone')) {
            $request->user()->update($request->only('home_phone'));
        }
        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/clients/'; // upload path
            $logo = $request->file('photo');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $request->user()->update(['photo' => 'uploads/clients/' . $name]);
        }

        $data = [
            'user' => $request->user()->load('region')
        ];
        return responseJson(1, 'تم تحديث البيانات', $data);
    }
    public function verifyEmail(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'email' => 'required',
            'code' => 'required'
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $user = Client::where('email', $request->input('email'))->first();
        if ($user) {
            if ($user->code == $request->code) {
                $user->update([
                    'verified' => 1
                ]);
                $data = [
                    'api_token' => $user->api_token,
                    'user' => $user->load('region'),
                ];
                return responseJson(1, 'تم التحقق من الايميل', $data);
            } else {
                return responseJson(0, 'كود تحقق خاطئ');
            }
        } else {
            return responseJson(0, 'بيانات الدخول غير صحيحة');
        }
    }

    public function resendCodeToEmail(Request $request)
    {
        $validation = validator()->make($request->all(), [

            'email' => 'required',

        ]);

        if ($validation->fails()) {
            $data = $validation->errors();

            $errorString = implode(",", $validation->messages()->all());
            return responseJson(0, $validation->errors()->first(), $errorString);
            // return responseJson(0,$validation->errors()->first(),$data);
        }

        $user = Client::where('email', $request->input('email'))->first();
        if ($user) {
            $code = rand(111111, 999999);
            $update = $user->update(['code' => $code]);
            if ($update) {
                info($user->email);
                // send email

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
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $user = Client::where('email', $request->input('email'))->first();
        if ($user) {
            if ($user->verified == 1) {
                if (Hash::check($request->password, $user->password)) {
                    $data = [
                        'api_token' => $user->api_token,
                        'user' => $user->load('region'),
                    ];
                    return responseJson(1, 'تم تسجيل الدخول', $data);
                } else {
                    return responseJson(0, 'بيانات الدخول غير صحيحة');
                }
            } else  return responseJson(0, ' لم يتم التحقق من الايميل');
        } else {
            return responseJson(0, 'بيانات الدخول غير صحيحة');
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
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $user = Client::where('email', $request->email)->first();
        if ($user) {
            $code = rand(111111, 999999);
            $update = $user->update(['code' => $code]);
            if ($update) {
                info($user->email);
                // send email

                Mail::send('emails.reset', ['code' => $code], function ($mail) use ($user) {
                    $mail->from('proofesser@gmail.com', 'تطبيق Talab Station');
                    $mail->bcc("nohamelmandoh@gmail.com");
                    $mail->to($user->email, $user->name)->subject('إعاده تعين كلمة المرور');
                });

                return responseJson(1, 'برجاء فحص بريدك الالكتروني');
            } else {
                return responseJson(0, 'حدث خطأ ، حاول مرة أخرى', null);
            }
        } else {
            return responseJson(0, 'لا يوجد أي حساب مرتبط بهذا البريد الالكتروني');
        }
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
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $user = Client::where('code', $request->code)->where('code', '!=', 0)->first();

        if ($user) {
            $update = $user->update(['password' => bcrypt($request->password), 'code' => null]);
            if ($update) {
                return responseJson(1, 'تم تغيير كلمة المرور بنجاح');
            } else {
                return responseJson(0, 'حدث خطأ ، حاول مرة أخرى');
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
            // return responseJson(0, $validation->errors()->first(), $errorString);
            return responseJson(0, $errorString, null);
        }

        Token::where('token', $request->token)->delete();
        // return  $request->user();
        $request->user()->tokens()->create($request->all());
        return responseJson(1, 'تم التسجيل بنجاح', 'تم التسجيل بنجاح');
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
            // return responseJson(0, $validation->errors()->first(), $errorString);
            return responseJson(0, $errorString, null);
        }

        Token::where('token', $request->token)->delete();
        return responseJson(1, 'تم الحذف بنجاح ', 'تم الحذف بنجاح');
    }
}
