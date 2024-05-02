<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if ($user->role_as == 'admin') {
                    return redirect(RouteServiceProvider::ADMIN_HOME);
                } elseif($user->role_as == 'office_staff') {
                    return redirect(RouteServiceProvider::OFFICE_STAFF_HOME);
                } elseif ($user->role_as == 'marketing_staff') {
                    return redirect(RouteServiceProvider::MARKETING_STAFF_HOME);
                } else{
                    return redirect(RouteServiceProvider::USER_HOME);
                }
            }
        }

        return $next($request);
    }
}

