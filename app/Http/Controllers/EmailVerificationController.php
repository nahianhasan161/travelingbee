<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


class EmailVerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        $user = User::find($request->user_id);

        if($user){



        if ($user->hasVerifiedEmail()) {
            return [
                'message' => 'Already Verified'
            ];
        }

        $user->sendEmailVerificationNotification();

        return ['status' => 'verification-link-sent'];

    }
    else{
        return ['status' => 'You are not Authenticated'];

    }
}
    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Email already verified'
            ];
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return [
            'message'=>'Email has been verified'
        ];
    }


    /* public function verify(EmailVerificationRequest $request)
    {

        if($request->user()->hasVerifiedEmail()){
            return [
                'message' => 'Email is already verified'
            ];
        }
        if($request->user()->markEmailAsVerified()){

            event(new Verified($request->user()));
            return [
                'message' => 'Verified'
            ];
        }

    } */

}
