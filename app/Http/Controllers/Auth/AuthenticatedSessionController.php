<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */

    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Opps !!. Invalid Credentials');
        }

        $request->authenticate();
        $request->session()->regenerate();

        if ($user->role_as === 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME)->with('success', 'Welcome, ' . $user->name . '!');
        } elseif ($user->role_as === 'office_staff') {
            return redirect()->intended(RouteServiceProvider::OFFICE_STAFF_HOME)->with('success', 'Welcome, ' . $user->name . '!');
        } elseif ($user->role_as === 'marketing_staff') {
            return redirect()->intended(RouteServiceProvider::MARKETING_STAFF_HOME)->with('success', 'Welcome, ' . $user->name . '!');
        } else {
            return redirect()->intended(RouteServiceProvider::USER_HOME)->with('success', 'Welcome, ' . $user->name . '!');
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
