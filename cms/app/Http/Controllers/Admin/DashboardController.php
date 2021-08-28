<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\Breadcrumb;

class DashboardController extends Controller
{
    public function index()
    {
        Breadcrumb::title(trans('admin_dashboard.dashboard'));

        return view('admin.dashboard.index');
    }
}
