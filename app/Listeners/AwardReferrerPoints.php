<?php

// namespace App\Listeners;

// use App\Events\UserRegistered;
// use App\Models\Earning;
// use Illuminate\Contracts\Queue\ShouldQueue;

// class AwardReferralPoints implements ShouldQueue
// {
//     public function handle(UserRegistered $event)
//     {
//         $referrer = $event->user->referrer;

//         if ($referrer) {
//             // Award 100 points to the referrer
//             Earning::create([
//                 'user_id' => $referrer->id,
//                 'amount' => 100,
//             ]);
//         }
//     }
// }