<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\CustomerRepository;
use App\Repositories\EventCategoryRepository;
use App\Repositories\EventRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Config;
use Illuminate\Support\Facades\Auth;

use Validator;

use App\Models\Customer;

use Illuminate\Support\Facades\Redirect;


class  CustomerController extends BaseController
{
    protected $customer;
    protected $event_category;
    protected $event;

    public function __construct(CustomerRepository $customer, EventCategoryRepository $event_category, EventRepository $event)
    {
        parent::__construct();
        $this->customer = $customer;
        $this->event_category = $event_category;
        $this->event = $event;
    }

    public function getProfile()
    {
        return view('frontend.customer.profile');
    }

    public function postProfile(Request $request)
    {
        $input = $request->all();
        $customer = $this->auth_customer;

        if (empty($input['email'])) {
            return back()->with('error', 'Email is required');
        }

        if ($this->customer->datatable()->where('email', $input['email'])->where('id', '!=', $customer->id)->exists()) {
            return back()->with('error', 'Email already exists in the system');
        }

        if (!empty($input['new_password']) && (password_verify($input['password'], $customer->password) || !$customer->password)) {
            $input['password'] = $input['new_password'];
        } else {
            if($customer->password && !empty($input['new_password']) && !(password_verify($input['password'], $customer->password) ))
                return back()->with('error', 'Current password is invalid');

            unset($input['password']);
        }

        $this->customer->update($input, $customer->id);
        return back()->with('success', 'Successfully updated!');
    }

    public function LoginCustomer(Request $request){

        $input = $request->all();
//
//        //dd($input);
//
//        $customer = Customer::where('email', $input['lgemail'])->first();
//
//        //dd($customer);
//
//        //dd(password_verify($input['lgpass'], $customer->password));
//
//        if ($customer == "" || password_verify($input['lgpass'], $customer->password)) {
//
//            return back()->withInput()->with('error', 'Login information is incorrect')->with(SHOW_LOGIN_FORM);
//
//        }
//
//        if ($customer->active == 0){
//
//            return back()->withInput()->with('error', 'Account has not been activated or is locked')->with(SHOW_LOGIN_FORM);
//
//        }
//
//        $customer->last_logon = Carbon::now();
//
//        $customer->save();

        if (Auth::guard('customer')->attempt(['email' => $input['lgemail'], 'password' => $input['lgpass']])) {

            $details = Auth::guard(GUARD_CUSTOMER)->user();

            $user = $details['original'];

            return redirect()->route('page.home')->with(''

            );
        }

        return back()->withInput()->with('error', 'Account has not been activated or is locked')->with(SHOW_LOGIN_FORM);
    }

    public function RegistryCustomer(Request $request){

        $input = $request->all(); //dd($input);

            if(Customer::where('email', $input['email'])->exists()){

                return back()->withInput()->with('error', 'Email already exists in the system')->with(SHOW_REGISTER_FORM);

            }

            $customer = $this->customer->create($input);


            Auth::guard(GUARD_CUSTOMER)->login($customer);

            $customer->last_logon = Carbon::now();

            $customer->save();




        return redirect()->route('page.home');

    }

    public function logoutCustomer()
    {
        Auth::guard(GUARD_CUSTOMER)->logout();
        return Redirect::to('login');
    }

    public function resetPass(Request $request)
    {
        $input = $request->all();

        $email_customer = $input['resetemail'];



        //dd($email_customer);

        return Redirect::to('verification');
    }
}
