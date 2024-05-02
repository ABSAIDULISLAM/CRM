<?php

namespace App\Http\Controllers\OfficeStuff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('office-stuff.home.index');
    }

    public function profile()
    {
        return view('admin.profile');
    }
}
