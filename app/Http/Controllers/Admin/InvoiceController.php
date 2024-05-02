<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\InvoiceDetails;
use App\Models\InvoiceSummary;
use App\Models\Lead;
use App\Models\Ledger;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InvoiceController extends Controller
{
    public function index()
    {
        $data = InvoiceSummary::where('status', 'invoice')->with(['invdetails', 'client', 'creator'])->latest()->get();
        return view('admin.invoice.index', compact('data'));
    }

    public function create()
    {
        $clients = Client::latest()->get();
        $products = Product::latest()->get();

        return view('admin.invoice.create', compact([
            'clients',
            'products',
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => ['required', 'exists:clients,id'],
            'inv_id' => ['required', 'unique:invoice_summaries,inv_id'],
            'client_address' => ['required', 'max:1024'],
            'billing_address' => ['required', 'max:1024'],
            'subTotal' => ['required', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'grand_total' => ['required', 'numeric'],
            'other_info' => ['nullable', 'max:1024'],
            'renewType' => ['required'],
            'service_fee' => ['required','numeric','min:0','max:999999.99'],
            'product_id*' => ['required', 'exists:products,id'],
            'desc*' => ['nullable', 'max:256'],
            'price*' => ['required', 'numeric'],
            'qty*' => ['required'],
            'total*' => ['required'],
        ]);

        $invSummary = new InvoiceSummary();
        $invSummary->client_id = $request->client_id;
        $invSummary->inv_id = $request->inv_id;
        $invSummary->client_address = $request->client_address;
        $invSummary->billing_address = $request->billing_address;
        $invSummary->subTotal = $request->subTotal;
        $invSummary->discount = $request->discount;
        $invSummary->grand_total = $request->grand_total;
        $invSummary->other_info = $request->other_info;
        $invSummary->renewType = $request->renewType;
        $invSummary->service_fee = $request->service_fee;
        $invSummary->status = Status::Invoice;
        $invSummary->creator = auth()->user()->id;
        $invSummary->payment_status = Status::Unpaid;
        $invSummary->save();

        foreach ($request->qty as $key => $value) {
            InvoiceDetails::create([
                'invoice_summary_id' => $invSummary->id,
                'product_id' => $request->product_id[$key],
                'description' => $request->desc[$key],
                'price' => $request->price[$key],
                'qty' => $value,
                'total' => $request->total[$key],
            ]);
        }

        $data = [
            'id' => $invSummary->id,
        ];

        return redirect()->route('Invoice.index')->with(['success', 'Invoice Created Successfully', 'data' => $data]);
    }

    public function edit($id)
    {
        $clients = Client::latest()->get();
        $products = Product::latest()->get();
        $id = Crypt::decrypt($id);
        $data = InvoiceSummary::where('id', $id)->with(['invdetails.product', 'client', 'creator'])->first();

        return view('admin.invoice.edit',  compact([
            'clients',
            'products',
            'data',
        ]));
    }

    public function update(Request $request)
    {
        $request->validate([
            'client_id' => ['required', 'exists:clients,id'],
            'inv_id' => ['required', 'unique:invoice_summaries,inv_id'],
            'client_address' => ['required', 'max:1024'],
            'billing_address' => ['required', 'max:1024'],
            'subTotal' => ['required', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'grand_total' => ['required', 'numeric'],
            'other_info' => ['nullable', 'max:1024'],
            'renewType' => ['required'],
            'service_fee' => ['required'],
            'product_id*' => ['required', 'exists:products,id'],
            'desc*' => ['nullable', 'max:256'],
            'price*' => ['required', 'numeric'],
            'qty*' => ['required'],
            'total*' => ['required'],
        ]);

        $invSummary = InvoiceSummary::find($request->id);
        $invSummary->client_id = $request->client_id;
        $invSummary->inv_id = $request->inv_id;
        $invSummary->client_address = $request->client_address;
        $invSummary->billing_address = $request->billing_address;
        $invSummary->subTotal = $request->subTotal;
        $invSummary->discount = $request->discount;
        $invSummary->grand_total = $request->grand_total;
        $invSummary->other_info = $request->other_info;
        $invSummary->renewType = $request->renewType;
        $invSummary->service_fee = $request->service_fee;
        $invSummary->creator = auth()->user()->id;
        $invSummary->save();

        foreach ($request->qty as $key => $value) {
            InvoiceDetails::find($request->invdetailsId)->update([
                'invoice_summary_id' => $invSummary->id,
                'product_id' => $request->product_id[$key],
                'description' => $request->desc[$key],
                'price' => $request->price[$key],
                'qty' => $value,
                'total' => $request->total[$key],
            ]);
        }

        return redirect()->route('Invoice.index')->with('success', 'Invoice Updated Successfully');
    }

    public function view($id)
    {
        $id = Crypt::decrypt($id);
        $data = InvoiceSummary::where('id', $id)->with(['invdetails.product', 'client', 'creator'])->first();
        return view('admin.invoice.view', compact('data'));
    }

    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        InvoiceSummary::find($id)->delete();

        return redirect()->route('Invoice.index')->with('success', 'Invoice Deleted Successful');
    }

    public function payNow($id, $inv, $payable)
    {
        $id = Crypt::decrypt($id);
        $data = InvoiceSummary::find($id);

        return view('admin.invoice.payment', compact(['data', 'payable']));
    }

    public function paymentStore(Request $request)
    {
        // return $request->all();
        $request->validate([
            'created_by' => ['exists:users,id'],
            'payment_method' => ['required'],
            'description' => ['nullable'],
            'date' => ['required', 'date'],
            'paid_amount' => ['required', 'numeric'],
        ]);

        Ledger::create([
            'created_by' => auth()->user()->id,
            'inv_id' => $request->inv_id,
            'date' => $request->date,
            'payment_method' => $request->payment_method,
            'income' => $request->paid_amount,
            'description' => $request->description,
        ]);

        $data = InvoiceSummary::where('id', $request->id)->first();
        $totalPaid = Ledger::where('inv_id', $request->inv_id)->sum('income');
        $status = $totalPaid >= $data->grand_total ? Status::Paid : Status::Partial;

        $data->update(['payment_status' => $status]);

        Payment::create([
            'user_id' => $request->id,
            'inv_id' => $request->inv_id,
            'date' => $request->date,
            'paid_amount' => $request->paid_amount,
            'payment_status' => Status::Unpaid,
        ]);

        return redirect()->route('Invoice.index')->with('success', 'Invoice Payment Collected Successful');
    }

    public function renewalList()
    {
        $data = InvoiceSummary::where('status', 'invoice')
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('renewType', 'monthly')
                        ->whereDate('created_at', '<=', Carbon::now()->subDays(23))
                        ->whereDate('created_at', '>=', Carbon::now()->subDays(30));
                })
                ->orWhere(function ($query) {
                    $query->where('renewType', 'yearly')
                        ->whereDate('created_at', '<=', Carbon::now()->subMonths(11))
                        ->whereDate('created_at', '>=', Carbon::now()->subMonths(12));
                });
            })
            // ->whereIn('payment_status', ['unpaid', 'partial'])
            ->with(['invdetails', 'client', 'creator'])
            ->latest()
            ->get();

        return view('admin.invoice.renewal-list', compact('data'));
    }

    public function Search(Request $request)
    {
        $query = $request->input('query');

        $data = InvoiceSummary::where('status', 'invoice')
                    ->where(function ($q) use ($query) {
                        $q->whereHas('client', function ($clientQuery) use ($query) {
                            $clientQuery->where('name', 'like', "%$query%");
                        })
                        ->orWhere('inv_id', 'like', "%$query%")
                        ->orWhere('payment_status', 'like', "%$query%")
                        ->orWhere('payment_status', 'like', "%$query%");
                    })
                    ->with(['invdetails', 'client', 'creator'])
                    ->paginate(10);

        $html = view('admin.invoice.search', compact('data'))->render();

        return response()->json(['html' => $html]);
    }


}
