<?php

namespace App\Services\admin;

use App\Jobs\SendWelcomeEmail;
use App\Mail\WelcomeMail;
use App\Models\Counselor;
use App\Models\Subadmin;
use App\Models\TeamLeader;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;


/**
 * Class AamarPayService.
 */
class SubadminCreate
{
    public static function subadminSave($data){

        $memberId = Rand(100000, 1000000);
        $verifiedTime = now()->format('Y-m-d H:i:s');

        $user = new User();
        $user->name = $data['name'];
        $user->email  = $data['email'];
        $user->number = $data['number'];
        if (request()->input('subadmintype_id') == 1 ) { //1 == counselor
            $user->role_as = 'counselor';
            $user->subadmintype_id = 'counselor';
        }elseif (request()->input('subadmintype_id') == 2){ //2== team leader
            $user->role_as = 'teamleader';
            $user->subadmintype_id = 'teamleader';
        }elseif (request()->input('subadmintype_id') == 3){ //3== photo editor teacher
            $user->role_as = 'photo_editing';
            $user->subadmintype_id = 'photo_editing';
        }elseif (request()->input('subadmintype_id') == 4){ //4== video editor teacher
            $user->role_as = 'video_editing';
            $user->subadmintype_id = 'video_editing';
        }elseif (request()->input('subadmintype_id') == 5){ //5== lead_gen teacher
            $user->role_as = 'lead_gen';
            $user->subadmintype_id = 'lead_gen';
        }elseif (request()->input('subadmintype_id') == 6){ //6== digital_marketing teacher
            $user->role_as = 'digital_marketing';
            $user->subadmintype_id = 'digital_marketing';
        }elseif (request()->input('subadmintype_id') == 7){ //6== SEO Exper teacher
            $user->role_as = 'seo_expert';
            $user->subadmintype_id = 'seo_expert';
        }
        $user->password = Hash::make($data['password']);
        $user->status = 'active';
        $user->email_verified_at = $verifiedTime;

        $user->student_id = $memberId;
        $user->gender = $data['gender'];
        $user->whats_app = $data['whats_app'];
        $user->country = $data['country'];
        $user->language = $data['language'];

        if(request()->hasFile('image')){
            $image = Upload(request('image'), 'uploads/sub-admin/', 400, 400);
            $user->image = $image;
        }
        $user->save();

        if (request()->input('subadmintype_id') == 1) { //1 == counselor
          $counselor = new Counselor();
          $counselor->user_id = $user->id;
          $counselor->subadmintype_id = 'counselor';
          $counselor->save();

        }elseif (request()->input('subadmintype_id') == 2){ //2== team leader
            $teamleader = new TeamLeader();
            $teamleader->user_id = $user->id;
            $teamleader->subadmintype_id = 'team_leader';
            $teamleader->save();
        }

        $userdata = [];
        $userdata['name'] = $data['name'];
        $userdata['email'] = $data['email'];
        $userdata['password'] = $data['password'];

        Mail::send('backend.admin.emails.welcome', ['user' => $userdata], function($message) use ($data){
            $message->to($data['email']);
            $message->subject('Welcome Mail from Touch and Earn');
        });
        
        return true;

    }
}
