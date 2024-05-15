<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvoiceSummary;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    public function index()
    {
       $data = Payment::with(['invoice', 'invoice.client'])->latest()->get();

        return view('admin.payment.index', compact('data'));
    }

    public function receive()
    {
        return view('admin.payment.receive');
    }

    public function edit()
    {
        return view('admin.payment.edit');
    }

    public function view($inv,$id)
    {
        $inv = Crypt::decrypt($inv);
        $id = Crypt::decrypt($id);
        $data = InvoiceSummary::where('inv_id', $inv)->with(['invdetails.product', 'client', 'creator'])->first();

        return view('admin.payment.view', compact(['data','id']));
    }
}
