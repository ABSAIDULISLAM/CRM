<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\InvoiceSummary;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('user')->latest()->get();
        return view('admin.client.index', compact('clients'));
    }
    public function create()
    {
        return view('admin.client.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'creator' => ['exists:users,id'],
            'name' => ['required', 'string', 'max:255', 'unique:users,mobile'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'mobile' => ['required', 'regex:/\+?(88)?0?1[3-9][0-9]{8}\b/', 'max:15'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'address' => ['required', 'max:256'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'role_as' => Status::User,
            'password' => Hash::make('password'),
            'status' => Status::Active,
        ]);

        $client = new Client();
        $client->user_id = $user->id;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->mobile = $request->mobile;
        $client->status = $request->status;
        $client->address = $request->address;
        $client->category_id = $request->category_id;
        $client->sub_category_id = $request->sub_category_id;
        $client->product_id = $request->product_id;
        $client->status = Status::Active->value;
        $client->creator = auth()->user()->id;
        if ($request->hasFile('image')) {
            $image = Upload($request->file('image'), 'uploads/lead-owners/', 400, 400);
            $client->image = $image;
        }
        $client->save();

        return redirect()->route('Client.index')->with('success', 'Lead Created Successful');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $client =Client::find($id);

        return view('admin.client.edit',compact('client'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'mobile' => ['required', 'regex:/\+?(88)?0?1[3-9][0-9]{8}\b/', 'max:15'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'address' => ['required', 'max:256'],
        ]);

        $client = Client::find($request->id);
        $client->name = $request->name;
        $client->email = $request->email;
        $client->mobile = $request->mobile;
        $client->status = $request->status;
        $client->address = $request->address;
        $client->status = $request->status;
        if ($request->hasFile('image')) {
            if ($client->image && file_exists($client->image)) {
                unlink($client->image);
            }
            $image = Upload($request->file('image'), 'uploads/lead-owners/', 400, 400);
            $client->image = $image;
        }
        $client->save();

        return redirect()->route('Client.index')->with('success', 'Client Updated Successful');
    }

    public function statusUpdate($id)
    {
        $id = Crypt::decrypt($id);
        $client = Client::find($id);

        if ($client->status == 'active') {
            $client->status = Status::Deactive;
        } elseif ($client->status == 'deactive') {
            $client->status = Status::Active;
        }
        $client->save();

        return redirect()->route('Client.index')->with('success', 'Client status updated successfully.');
    }

    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $data = Client::find($id);
        if ($data->image && file_exists($data->image)) {
            unlink($data->image);
        }
        $data->delete();

        return redirect()->route('Client.index')->with('success', 'Client Deleted Successful');
    }

    public function view($id)
    {
        $id = Crypt::decrypt($id);
        // $data = Client::with('user')->where('');

        $data = InvoiceSummary::where('client_id', $id)->with(['invdetails', 'client', 'creator'])->get();

        return view('admin.client.view', compact('data'));
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $clients = Client::where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                ->orWhere('mobile', 'like', "%$query%")
                ->orWhere('email', 'like', "%$query%")
                ->orWhere('created_at', 'like', "%$query%")
                ->orWhere('status', 'like', "%$query%");
            })
            ->with('user')
            ->paginate(10);

        $html = view('admin.Client.search', compact('clients'))->render();

        return response()->json(['html' => $html]);
    }


}
