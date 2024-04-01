<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Enums\Status;
use App\Events\UserRegistered;
use App\Models\Earning;
use App\Models\Network;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;




class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request)
    {

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/\+?(88)?0?1[3456789][0-9]{8}\b/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'number' => ['required', 'number', 'max:11', 'min:11', 'unique:users,number'],
            'password' => ['required', 'min:8', 'confirmed', Password::defaults()],
        ]);

        $user = new User();
        $rand = rand(100000, 10000000);
        $userId = User::orderBy('id', 'desc')->value('user_id');
        $user_id = $userId ? $userId + 1 : 100001;

        $user->save();

        event(new Registered($user));

        Auth::login($user);

        // $userdata = [
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ];

        // Mail::send('backend.admin.emails.welcome', ['user' => $userdata], function ($message) use ($userdata) {
        //     $message->to($userdata['email']);
        //     $message->subject('Welcome Mail from Touch and Earn');
        // });

        return redirect(RouteServiceProvider::HOME);
    }

}
