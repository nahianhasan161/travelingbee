<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function forgetPassword(Request $request)
    {
     
           /*  $status = Password::sendResetLink($request->only('email'));
            return $status; */
      
       
         $request->validate([
            'email' => 'required|email'
        ]); 
       $status = Password::sendResetLink($request->only('email'));
        if($status == Password::RESET_LINK_SENT){
            return [
                'status' => __($status)
            ];
        }
      throw ValidationException::withMessages([
            'email' => [trans($status)]
        ]);  
    }

    public function reset(Request $request)
    {
       $validated = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed'],
        ]);
        
        
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message'=> 'Password reset successfully'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);

    }
}
