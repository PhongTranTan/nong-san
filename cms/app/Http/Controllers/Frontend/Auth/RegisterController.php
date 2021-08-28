<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $customer;

    /**
     * Create a new controller instance.
     * @param CustomerRepository $customer
     * @return void
     */
    public function __construct(
        CustomerRepository $customer
    )
    {
        $this->middleware('guest:' . GUARD_CUSTOMER);
        $this->redirectTo = route('page.home');
        $this->customer = $customer;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('themes.signup');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
            'name' => 'string',

            'email' => [
                'email',
                Rule::unique((new Customer())->getTable())
            ],
            'password' => 'string|min:6|confirmed',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $customer = $this->customer->create($data);
        return $customer;
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
}
