<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('admin.payment.index');
    }

    public function receive()
    {
        return view('admin.payment.receive');
    }

    public function edit()
    {
        return view('admin.payment.edit');
    }
}
