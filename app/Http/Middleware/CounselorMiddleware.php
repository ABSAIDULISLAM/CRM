<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CounselorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (auth()->user()->role_as == 'counselor') {
                return $next($request);
            } else {
                return redirect()->back()->with('error', 'Access denied. You are Not Counselor');
            }
        } else {
            return redirect()->back()->with('error', 'Please Login First.');
        }
    }
}
