<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;
use App\Repositories\CustomerRepository;

class LoginController extends Controller
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
    protected $redirectTo = '/';
    protected $customer;

    /**
     * Create a new controller instance.
     *@param CustomerRepository $customer
     * @return void
     */
    public function __construct(CustomerRepository $customer)
    {
        $this->middleware('guest:' . GUARD_CUSTOMER)->except('logout');
        $this->redirectTo = route('page.home');
        $this->customer = $customer;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('themes.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(GUARD_CUSTOMER);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'lgemail' => 'required|string',
            'lgpass' => 'required|string',

        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
//        return $request->only('lgemail', 'lgpass');
        return [
            $this->username() => $request->input('lgemail'),
            'password' => $request->input('lgpass'),
        ];
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

//        $request->session()->invalidate();

        return redirect('login');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    protected function sendLoginResponse(Request $request)
//    {
////        $request->session()->regenerate();
//
//        $this->clearLoginAttempts($request);
//
//        return $this->authenticated($request, $this->guard()->user())
//
//            ?: redirect()->intended($this->redirectPath());
//
//    }
}
