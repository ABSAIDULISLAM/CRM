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
        return $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'number' => ['required', 'number', 'max:11', 'min:11', 'unique:users,number', 'regex:/\+?(88)?0?1[3456789][0-9]{8}\b/'],
            'password' => ['required', 'min:8', 'confirmed', Password::defaults()],
        ]);

        $user = new User();
        $rand = rand(100000, 10000000);
        $userId = User::orderBy('id', 'desc')->value('user_id');
        $user_id = $userId ? $userId + 1 : 100001;

        $user->save();

        event(new Registered($user));

        Auth::login($user);

        if ($user->role_as === 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME)->with('success', 'Welcome, ' . $user->name . '!');
        } elseif($user->role_as === 'office_staff') {
            return redirect()->intended(RouteServiceProvider::OFFICE_STAFF_HOME)->with('success', 'Welcome, ' . $user->name . '!');
        } elseif ($user->role_as === 'marketing_staff') {
            return redirect()->intended(RouteServiceProvider::MARKETING_STAFF_HOME)->with('success', 'Welcome, ' . $user->name . '!');
        } else {
            return redirect()->intended(RouteServiceProvider::USER_HOME)->with('success', 'Welcome, ' . $user->name . '!');
        }
    }

}
