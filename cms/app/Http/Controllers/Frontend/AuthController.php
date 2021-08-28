<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\ConfirmCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ForgotPasswordRequest;
use App\Http\Requests\Frontend\ResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Frontend\ForgotPasswordMail;
use App\Mail\Frontend\RegistryMail;
use App\Models\Customer;
use Carbon\Carbon;
use DB;

class AuthController extends Controller
{
    public function __construct()
    {
//        if(!session_start())
//            session_start();
    }

    public function getLogin(){
        // return view('themes.login');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $customer = Customer::where('email', $input['email'])->first();

        if (!$customer || !password_verify($input['password'], $customer->password))
            return back()->withInput()->with('error', 'Login information is incorrect')->with(SHOW_LOGIN_FORM);

        if (!$customer->active)
            return back()->withInput()->with('error', 'Account has not been activated or is locked')->with(SHOW_LOGIN_FORM);

        Auth::guard(GUARD_CUSTOMER)->login($customer, !empty($input['remember']));

        $customer->last_logon = Carbon::now();
        $customer->save();
        $_SESSION['customer_id'] = $customer->id;
        return redirect( $input['redirect_to'] ?? route('account.frontend.profile.get'));
    }

    public function registry(Request $request)
    {
        $input = $request->all();
        if(Customer::where('email', $input['email'])->exists()){
            return back()->withInput()->with('error', 'Email already exists in the system')->with(SHOW_REGISTER_FORM);
        }

        $customer = Customer::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'active' => 1,
            'active_code' => uniqid()
        ]);

        Mail::to($customer->email)->send(new RegistryMail($customer, $input['password']));
        Auth::guard(GUARD_CUSTOMER)->login($customer);

        $_SESSION['customer_id'] = $customer->id;
        return redirect()->route('page.home');
    }

    public function showForgotPassword()
    {
        return view('frontend.auth.forgot');
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $input = $request->all();
        $token = str_random(40);
        $customer = Customer::where('email', $input['email'])->first();

        if($customer->active == CUSTOMER_INACTIVE) {
            $request->session()->flash('error', 'The account is in-active');
            return redirect()->back();
        }

        $password_reset = DB::table('customer_password_resets')->where('email', $customer->email)->first();

        if ($password_reset) {
            DB::table('customer_password_resets')->where('email', $customer->email)->update([
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

        } else {
            DB::table('customer_password_resets')->insert([
                'email' => $customer->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        Mail::to($customer->email)->send(new ForgotPasswordMail($customer, $token));
        $request->session()->flash('success', 'An email is sent to you !');
        return redirect()->back();
    }

    public function showResetPassword(Request $request, $token)
    {
        $now = Carbon::now();
        $password_reset = DB::table('customer_password_resets')->where('token', $token)->first();

        if (!$password_reset) {
            $request->session()->flash('error', 'The token is in-valid !');
            return redirect()->route('frontend.forgot.show');
        }

        if ($now->diffInHours($password_reset->created_at) >= 1) {
            DB::table('customer_password_resets')->where('token', $token)->delete();
            $request->session()->flash('error', 'The token is expired !');
            return redirect()->route('frontend.forgot.show');
        }

        $customer = Customer::where('email', $password_reset->email)->first();

        return view('frontend.auth.reset', compact('customer'));
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $input = $request->all();
        $customer = Customer::where('email', $input['email'])->first();
        $result = $customer->update([
            'password' => $input['password']
        ]);
        DB::table('customer_password_resets')->where('email', $input['email'])->delete();
        Auth::guard('customer')->login($customer);
        return redirect()->route('page.home');
    }

    public function logout()
    {
        Auth::guard(GUARD_CUSTOMER)->logout();
        if(isset($_SESSION['customer_id']))
            unset($_SESSION['customer_id']);
        return redirect()->route('page.home');
    }

    public function getLoginSocial(Request $request, $provider = PROVIDER_NAVER)
    {
        $access_token = $request->get('access_token');
        if($provider == PROVIDER_NAVER && !$access_token){
            return view('vendor.process.naver_login');
        }

        $input["{$provider}_id"] = 0;
        switch ($provider)
        {
            case PROVIDER_NAVER: {
                $profile = getProfileFromAccessToken($access_token);
                $profile = \GuzzleHttp\json_decode($profile);
                if($profile->resultcode == '00'){
                    $profile = $profile->response;
                    $input["{$provider}_id"] = $profile->id;
                    $input['name'] = $profile->name ?? '';
                    $input['avatar'] = $profile->profile_image ?? '';
                    $input['email'] = $profile->email ?? '';
                    if(($profile->birthday ?? null))
                        $input['birthday'] = Carbon::createFromFormat('d-m',$profile->birthday);
                }
            } break;

            case PROVIDER_KAKAO: {
                $profile = getProfileFromAccessToken($access_token, 'https://kapi.kakao.com/v1/user/me');
                $profile = \GuzzleHttp\json_decode($profile);
                if(($profile->id ?? null)){
                    $input["{$provider}_id"] = $profile->id;
                    $input['email'] = $profile->kaccount_email ?? '';

                    $profile = $profile->properties;
                    $input['name'] = $profile->nickname ?? '';
                    $input['avatar'] = $profile->profile_image ?? '';
                }
            } break;

            case PROVIDER_FACEBOOK: {
                $profile = file_get_contents("https://graph.facebook.com/me?fields=id,email,name,birthday&access_token=$access_token");
                $profile = \GuzzleHttp\json_decode($profile);
                if(($profile->id ?? null)){
                    $input["{$provider}_id"] = $profile->id;
                    $input['email'] = $profile->email ?? '';
                    $input['name'] = $profile->name ?? '';
                    $input['avatar'] = "https://graph.facebook.com/{$profile->id}/picture?type=large";
                }
            } break;

            default: {
                return back()->with('error','Login error')->with(SHOW_LOGIN_FORM);
            }
        }
        if($input["{$provider}_id"]){
            $customer = Customer::where("{$provider}_id", $input["{$provider}_id"]);
            if(isset($input['email']) && $input['email'])
                $customer = $customer->orWhere('email', $input['email']);

            $customer = $customer->first();

            if(!$customer){
                $input['active'] = 1;
                $customer = Customer::create($input);
            }

            if (!$customer->active)
                return back()->withInput()->with('error', 'Account has not been activated or is locked')->with(SHOW_LOGIN_FORM);

            $customer->last_logon = Carbon::now();
            $customer->save();

            Auth::guard(GUARD_CUSTOMER)->login($customer);

            $_SESSION['customer_id'] = $customer->id;
            return redirect( $input['redirect_to'] ?? route('account.frontend.profile.get'));
        }
        return back()->withInput()->with('error', 'The account is not linked, please try again later')->with(SHOW_LOGIN_FORM);
    }

    public function getResetPassword()
    {
        return view('themes.reset');
    }

    public function postResetPassword(Request $request)
    {
        $email = $request->get('email');

        if($customer = Customer::where('email', $email)->first()){

            $customer->confirm_code = randStrGen(6);

            $customer->save();

            Mail::to($email)->queue(new ConfirmCode($customer));

            return view('themes.verification', compact('email'));

        }
        return back()->with('error', 'Email is not exist in system');
    }

    public function postConfirmCode(Request $request)
    {
        $confirm_code = $request->get('confirm_code');

        if($customer = Customer::where('confirm_code', $confirm_code)->first()){

            return view('themes.reset-password', compact('confirm_code'));

        }
        return back()->with('error', 'Confirm code is invalid');

    }

    public function postChangePassword(Request $request)
    {
        $confirm_code = $request->get('confirm_code');

        if($customer = Customer::where('confirm_code', $confirm_code)->first()){

            $customer->password = $request->get('password');

            $customer->save();

            return redirect()->route('frontend.login')->with('success','Successfully password changing');

        }

        return back()->with('error', 'Confirm code is invalid');

    }
}
