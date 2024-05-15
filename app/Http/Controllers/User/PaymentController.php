<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\InvoiceSummary;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    public function history()
    {
        return $data = Payment::with(['invoice', 'invoice.client'])->where('user_id', auth()->user()->id)->latest()->get();

        return view('user.payment.index', compact('data'));
    }

    public function view($inv,$id)
    {
        $inv = Crypt::decrypt($inv);
        $id = Crypt::decrypt($id);
        $data = InvoiceSummary::where('inv_id', $inv)->with(['invdetails.product', 'client', 'creator'])->first();

        return view('user.payment.view', compact(['data','id']));
    }
}
