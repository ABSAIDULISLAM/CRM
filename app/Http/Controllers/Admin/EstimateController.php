<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\InvoiceDetails;
use App\Models\InvoiceSummary;
use App\Models\Lead;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EstimateController extends Controller
{
    public function index()
    {
        $data = InvoiceSummary::where('status','estimate')->with(['invdetails','lead','creator'])->latest()->get();
        return view('admin.estimate.index', compact('data'));
    }

    public function create()
    {
        $leads = Lead::latest()->get();
        $products = Product::latest()->get();

        return view('admin.estimate.create', compact([
            'leads',
            'products',
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lead_id'=> ['required','exists:leads,id'],
            'inv_id' => ['required','unique:invoice_summaries,inv_id'],
            'estimate_date' => ['required','date'],
            'expiry_date' => ['required','date', 'after:estimate_date'],
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
       $invSummary->lead_id = $request->lead_id;
       $invSummary->inv_id = $request->inv_id;
       $invSummary->estimate_date = $request->estimate_date;
       $invSummary->expiry_date = $request->expiry_date;
       $invSummary->client_address = $request->client_address;
       $invSummary->billing_address = $request->billing_address;
       $invSummary->subTotal = $request->subTotal;
       $invSummary->discount = $request->discount;
       $invSummary->grand_total = $request->grand_total;
       $invSummary->other_info = $request->other_info;
       $invSummary->renewType = $request->renewType;
       $invSummary->service_fee = $request->service_fee;
       $invSummary->status = Status::Estimate;
       $invSummary->payment_status = Status::Unpaid;
       $invSummary->creator = auth()->user()->id;
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
            'id' =>$invSummary->id,
        ];

        return redirect()->route('Estimate.index')->with(['success','Estimate Created Successfully', 'data'=> $data]);
    }

    public function edit($id)
    {
        $leads = Lead::latest()->get();
        $products = Product::latest()->get();
        $id = Crypt::decrypt($id);
         $data = InvoiceSummary::where('id', $id)->with(['invdetails.product','lead','creator'])->first();
        return view('admin.estimate.edit',  compact([
            'leads',
            'products',
            'data',
        ]));
    }

    public function update(Request $request)
    {
        $request->validate([
            'lead_id'=> ['required','exists:leads,id'],
            'estimate_date' => ['required','date'],
            'expiry_date' => ['required','date', 'after:estimate_date'],
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
       $invSummary->lead_id = $request->lead_id;
       $invSummary->estimate_date = $request->estimate_date;
       $invSummary->expiry_date = $request->expiry_date;
       $invSummary->client_address = $request->client_address;
       $invSummary->billing_address = $request->billing_address;
       $invSummary->subTotal = $request->subTotal;
       $invSummary->discount = $request->discount;
       $invSummary->grand_total = $request->grand_total;
       $invSummary->other_info = $request->other_info;
       $invSummary->renewType = $request->renewType;
       $invSummary->service_fee = $request->service_fee;
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

        return redirect()->route('Estimate.index')->with('success','Estimate Updated Successfully');
    }

    public function view($id)
    {
        $id = Crypt::decrypt($id);
        $data = InvoiceSummary::where('id', $id)->with(['invdetails.product','lead','creator'])->first();
        return view('admin.estimate.view', compact('data'));
    }

    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        InvoiceSummary::find($id)->delete();

        return redirect()->route('Estimate.index')->with('success', 'Estimate Deleted Successful');
    }

    public function convertInvoice($id)
    {
        $id = Crypt::decrypt($id);
        $invsummery = InvoiceSummary::find($id);

        $lead = Lead::find($invsummery->lead_id);

        $client = new Client();
        $client->name = $lead->company_name;
        $client->email = $lead->email;
        $client->mobile = $lead->mobile;
        $client->status = Status::Active;
        $client->address = $lead->address;
        $client->creator = auth()->user()->id;
        $client->image = $lead->image;
        $client->save();

        if($lead->image && file_exists($lead->image)){
            unlink($lead->image);
        }
        $lead->delete();

        $invsummery->update([
            'lead_id' => null,
            'client_id' => $client->id,
            'status' => Status::Invoice->value,
        ]);
        return redirect()->route('Invoice.index')->with('success', 'Estimate Converted Into Invoice Successfully');
    }


    public function Search(Request $request)
    {
        $query = $request->input('query');

        $data = InvoiceSummary::where(function ($q) use ($query) {
            $q->whereHas('lead', function ($lead) use ($query) {
                $lead->where('name', 'like', "%$query%");
            })
                ->orWhere('inv_id', 'like', "%$query%")
                ->orWhere('estimate_date', 'like', "%$query%")
                ->orWhere('payment_status', 'like', "%$query%")
                ->orWhere('status', 'like', "%$query%")
                ->orWhere('renewType', 'like', "%$query%");
        })
            ->with(['invdetails','lead','creator'])
            ->paginate(10);

        $html = view('admin.Estimate.search', compact('data'))->render();

        return response()->json(['html' => $html]);
    }


}
