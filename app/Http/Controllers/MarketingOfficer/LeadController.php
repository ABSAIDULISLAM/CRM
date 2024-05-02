<?php

namespace App\Http\Controllers\MarketingOfficer;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ContactLead;
use App\Models\Lead;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::where('creator', auth()->user()->id)->with(['user', 'contactlead', 'product'])->latest()->get();

        return view('marketing-stuff.lead.index', compact('leads'));
    }


    public function create()
    {
        $product = Product::latest()->get();
        return view('marketing-stuff.lead.create', compact(['product']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'creator' => ['exists:users,id'],
            'product_id' => ['required', 'exists:products,id'],
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['required', 'max:1024'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'mobile' => ['required', 'regex:/\+?(88)?0?1[3-9][0-9]{8}\b/', 'numeric', 'digits:11'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'address' => ['required', 'max:256'],
            'priority' => ['required'],
            'status' => ['required'],
            'next_contact_date' => ['nullable', 'date'],
            'note' => ['nullable', 'max:1024'],
        ]);

        $lead = new Lead();
        $lead->company_name = $request->company_name;
        $lead->company_address = $request->company_address;
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->mobile = $request->mobile;
        $lead->priority = $request->priority;
        $lead->status = $request->status;
        $lead->address = $request->address;
        $lead->product_id = $request->product_id;
        $lead->creator = auth()->user()->id;
        if ($request->hasFile('image')) {
            $image = Upload($request->file('image'), 'uploads/lead-owners/', 400, 400);
            $lead->image = $image;
        }
        $lead->save();

        ContactLead::create([
            'lead_id' => $lead->id,
            'next_contact_date' => $request->next_contact_date,
            'note' => $request->note,
            'priority' => $request->priority,
        ]);

        return redirect()->route('Marketing.lead.index')->with('success', 'Lead Created Successful');
    }

    public function ContactRecordstore(Request $request)
    {
        $validated = $request->validate([
            'id' => ['exists:leads,id'],
            'note' => ['required', 'max:1024'],
        ]);

        ContactLead::create([
            'lead_id' => $request->id,
            'note' => $request->note,
        ]);

        return redirect()->route('Marketing.lead.index')->with('success', 'Lead Contact Record Successful');
    }

    public function Contactdatestore(Request $request)
    {
        // return $request->all();
        $validated = $request->validate([
            'id' => ['exists:leads,id'],
            'next_contact_date' => ['nullable', 'date'],
            'note' => ['nullable'],
        ]);

        ContactLead::create([
            'lead_id' => $request->id,
            'next_contact_date' => $request->next_contact_date,
            'note' => $request->note,
            'priority' => $request->priority,
        ]);

        return redirect()->route('Marketing.lead.index')->with('success', 'Lead Contact Record Saved Successful');
    }

    public function convertClient($id)
    {
        $id = Crypt::decrypt($id);
        $lead = Lead::find($id);

        $client = new Client();
        $client->name = $lead->company_name;
        $client->email = $lead->email;
        $client->mobile = $lead->mobile;
        $client->status = Status::Active;
        $client->address = $lead->address;
        $client->creator = auth()->user()->id;
        $client->image = $lead->image;
        $client->save();

        User::create([
            'name' => $lead->company_name,
            'email' => $lead->email,
            'mobile' => $lead->mobile,
            'role_as' => Status::User,
            'password' =>Hash::make('password'),
            'status' => Status::Active,
        ]);

        if ($lead->image && file_exists($lead->image)) {
            unlink($lead->image);
        }

        $lead->delete();

        return redirect()->route('Client.index')->with('success', 'Client created successfully.');
    }


    public function edit($id)
    {
        $product = Product::latest()->get();

        $id = Crypt::decrypt($id);
        $lead = Lead::with('contactlead')->find($id);
        return view('marketing-stuff.lead.edit', compact([
            'lead',
            'product',
        ]));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'company_address' => ['required', 'max:1024'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
            'mobile' => ['required', 'regex:/\+?(88)?0?1[3-9][0-9]{8}\b/', 'max:15'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'address' => ['required', 'max:256'],
            'priority' => ['required'],
            'status' => ['required'],
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $lead = Lead::find($request->id);
        $lead->company_name = $request->company_name;
        $lead->company_address = $request->company_address;
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->mobile = $request->mobile;
        $lead->priority = $request->priority;
        $lead->status = $request->status;
        $lead->address = $request->address;
        $lead->product_id = $request->product_id;
        if ($request->hasFile('image')) {
            if ($lead->image && file_exists($lead->image)) {
                unlink($lead->image);
            }
            $image = Upload($request->file('image'), 'uploads/lead-owners/', 400, 400);
            $lead->image = $image;
        }
        $lead->save();

        return redirect()->route('Marketing.lead.index')->with('success', 'Lead Upated successfully.');
    }

    public function statusUpdate($id)
    {
        $id = Crypt::decrypt($id);
        $lead = Lead::find($id);

        if ($lead->status == 'active') {
            $lead->status = Status::Closed;
        } elseif ($lead->status == 'closed') {
            $lead->status = Status::Active;
        }

        $lead->save();

        return redirect()->route('Marketing.lead.index')->with('success', 'Lead status updated successfully.');
    }

    public function view($id)
    {
        $id = Crypt::decrypt($id);
        $data = Lead::find($id);
        $lastInfo = ContactLead::where('lead_id', $id)->latest()->get();
        return view('marketing-stuff.lead.view', compact(['data', 'lastInfo']));
    }

    public function delete($id, $name)
    {
        $id = Crypt::decrypt($id);
        $data = Lead::find($id);
        if ($data->image && file_exists($data->image)) {
            unlink($data->image);
        }
        $data->delete();

        return redirect()->route('Marketing.lead.index')->with('success', 'lead Deleted Successful');
    }


    public function Search(Request $request)
    {
        $query = $request->input('query');

        $leads = Lead::where(function ($q) use ($query) {
            $q->whereHas('product', function ($productQuery) use ($query) {
                $productQuery->where('name', 'like', "%$query%");
            })
                ->orWhere('company_name', 'like', "%$query%")
                ->orWhere('name', 'like', "%$query%")
                ->orWhere('mobile', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->orWhere('priority', 'like', "%$query%");
        })
            ->with(['user', 'contactlead', 'product'])
            ->paginate(10);

        $html = view('marketing-stuff.Lead.search', compact('leads'))->render();

        return response()->json(['html' => $html]);
    }

}
