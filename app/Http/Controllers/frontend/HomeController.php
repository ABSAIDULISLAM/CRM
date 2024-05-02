<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.index');
    }

    public function profile()
    {
        $data = User::where('id', auth()->user()->id)->first();
        return view('admin.profile', compact('data'));
    }


    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'mobile' => ['nullable', 'max:15', 'regex:/\+?(88)?0?1[3-9][0-9]{8}\b/', Rule::unique(User::class)->ignore($user->id)],
            'old_password' => ['nullable', 'min:8'],
            'password' => ['nullable'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png,webp'],
        ]);

        if ($request->filled('old_password') && !Hash::check($request->old_password, $user->password)) {
            return redirect()->route('profile')->with('error', 'The old password is incorrect.');
        }
        $user->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
        ]);

        // Update password only if the password field is filled
        if ($request->filled('password')) {
            $password = Hash::make($request->password); // Ensure password is hashed using Hash::make
            $user->update(['password' => $password]);
        }

        $old_image = User::find($user->id);
        if ($request->hasFile('image')) {
            if ($old_image->image && file_exists(public_path($old_image->image))) {
                unlink(public_path($old_image->image));
            }
            $image = Upload($request->file('image'), 'uploads/categories/', 400, 400);
            $user->update(['image' => $image]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

}
