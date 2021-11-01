<?php

namespace App\Http\Controllers\merchant\Auth;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class MerchantLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/merchant';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:merchant_web', ['except' => 'logout']);
    }
    public function guard()
    {
        return Auth::guard('merchant_web');
    }
    public function loginForm()
    {
        return view('merchant.auth.login-merchant');
    }
    public function login(Request $request)
    {

        $this->validate($request, [
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);


        $credentials = ['email' => $request->email, 'password' => $request->password];
        $user = Merchant::where('email', $request->email)->first();
        if (!empty($user)) {
            if (Auth::guard('merchant_web')->attempt($credentials, false)) {
                return redirect()->intended(route('merchant.dashboard'));
            }
        }
        return $this->sendFailedLoginResponse($request);
    }
    public function logout(Request $request)
    {
        Auth::guard('merchant_web')->logout();
        return  redirect(route('merchant.show.login'));
    }
}
