<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // $visitorKey = 'visitor_' . $request->ip();

        // if (!Session::has($visitorKey)) {
        //     Session::put($visitorKey, true);

        //     Visitor::create([
        //         'ip_address' => $request->ip(),
        //         'visited_at' => now(),
        //     ]);
        // }

        return $next($request);
    }
}
