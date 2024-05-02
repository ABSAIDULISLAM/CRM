<?php

namespace App\Http\Controllers\MarketingOfficer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('marketing-stuff.home.index');
    }

    public function profile()
    {
        return 'test ';
        return view('admin.profile');
    }
}
