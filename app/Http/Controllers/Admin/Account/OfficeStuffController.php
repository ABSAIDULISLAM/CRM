<?php

namespace App\Http\Controllers\Admin\Account;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\OfficeStuff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class OfficeStuffController extends Controller
{
    public function index()
    {
        $officestuff = OfficeStuff::with('user')->latest()->get();
        return view('admin.account.office.index', compact('officestuff'));
    }
    public function create()
    {
        return view('admin.account.office.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string','max:256'],
            'user_name' => ['required', 'string','max:256'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'mobile' => ['required', 'regex:/\+?(88)?0?1[3-9][0-9]{8}\b/', 'max:15'],
            'lead_owner_id' => ['nullable', 'string', 'unique:lead_owners,lead_owner_id'],
            'password' => ['required', 'min:8', Password::defaults()],
            'address' => ['required', 'max:256'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->role_as = Status::OfficeStaff->value;
        $user->password = Hash::make($request->password);
        if ($request->hasFile('image')) {
            $image = Upload($request->file('image'), 'uploads/lead-owners/', 400, 400);
            $user->image = $image;
        }
        $user->save();

        OfficeStuff::create([
            'user_id' => $user->id,
            'user_name' => $request->user_name,
            'office_stuff_id' => $request->office_stuff_id,
            'address' => $request->address,
        ]);
        return redirect()->route('Account.office.index')->with('success', 'Office Stuff Created Successful');

    }

    // public function status($id)
    // {
    //     $id = Crypt::decrypt($id);
    //     $lead = LeadOwner::find($id);

    //     if ($lead->status == 'active') {
    //         $lead->status = Status::Deactive;
    //     } elseif ($lead->status == 'deactive') {
    //         $lead->status = Status::Active;
    //     }
    //     $lead->save();

    //     return redirect()->route('Lead-owner.index')->with('success', 'Lead-owner status updated successfully.');
    // }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $leadowner = OfficeStuff::with('user')->find($id);
        return view('admin.account.office.edit',compact('leadowner'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:256'],
            'user_name' => ['required', 'string', 'max:256'],
            'email' => ['required','string','lowercase','email','max:255',Rule::unique('users')->ignore($request->userid)],
            'mobile' => ['required', 'regex:/\+?(88)?0?1[3-9][0-9]{8}\b/', 'max:15'],
            'address' => ['required', 'max:256'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
        ]);

        $user = User::find($request->userid);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->status = $request->status;
        if ($request->hasFile('image')) {
            if ($user->image && file_exists($user->image)) {
                unlink($user->image);
            }
            $image = Upload($request->file('image'), 'uploads/lead-owners/', 400, 400);
            $user->image = $image;
        }
        $user->save();

        OfficeStuff::find($request->id)->update([
            'user_id' => $user->id,
            'user_name' => $request->user_name,
            'address' => $request->address,
        ]);

        return redirect()->route('Account.office.index')->with('success', 'lead-owner Updated Successful');
    }

    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $data = OfficeStuff::find($id);
        if ($data->image && file_exists($data->image)) {
            unlink($data->image);
        }
        $data->delete();

        return redirect()->route('Account.office.index')->with('success', 'lead-owner Deleted Successful');
    }

    public function view($id)
    {
        return 'back';
        $id = Crypt::decrypt($id);
        $leads = Lead::where('creator', $id)->get();
        $data = LeadOwner::with('user')->find($id);
        return view('admin.lead-owner.view', compact(['data', 'leads']));
    }
}
