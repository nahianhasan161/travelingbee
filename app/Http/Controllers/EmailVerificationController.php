<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    public function sendVerificationEmail(Request $request){
        
         if($request->user()->hasVerifiedEmail()){
            return [
                'message' => 'Already Verified'
            ];
        } 
          
           $request->user()->sendEmailVerificationNotification();
            return [
                'message' => 'Verification link send'
            ];

    }
    public function verify(EmailVerificationRequest $request)
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
        
    }
  
}
