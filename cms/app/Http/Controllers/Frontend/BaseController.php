<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class BaseController extends Controller
{
    protected $auth_customer;
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            $this->auth_customer = get_current_customer();
            if(!$this->auth_customer)
                $this->auth_customer = new Customer();
            return $next($request);
        });
    }
}
