<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Earning;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {

            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            if ($request->user()->email_verified_at && !$request->user()->gmail_verified_points_received) {

                $request->user()->update(['gmail_verified_points_received' => true]);

                // Award 100 points
                $request->user()->earnings()->create([
                    'user_id' => $request->user()->id,
                    'amount' => 50,
                ]);

                if ($request->user()->referrer_id) {
                    $referrer = User::find($request->user()->referrer_id);
                    if ($referrer) {
                        $referrer->earnings()->create([
                            'user_id' => $referrer->id,
                            'amount' => 10,
                        ]);
                    }
                }
            }
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
