<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function forgetPassword(Request $request)
    {
     
           /*  $status = Password::sendResetLink($request->only('email'));
            return $status; */
      
            $validated = Validator::make($request->all(),[


                'email' => 'required|email',
               
    
               ]);
                if($validated->fails()){
                    Helper::sendError('Validation Failed',$validated->errors());
                }
        
       $status = Password::sendResetLink($request->only('email'));
        if($status == Password::RESET_LINK_SENT){
            $msg = __($status);
            
            return [
                'status' => 200,
                'message' => __($status)
            ]; 
        } else{
            return [
                'status' => 401,
                'message' => 'Please wait before request again'
            ]; 
          
        }
      /* throw ValidationException::withMessages([
            'email' => [trans($status)]
        ]);   */
    }

    public function reset(Request $request)
    {
        $validated = Validator::make($request->all(),[

            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',

           ]);
            if($validated->fails()){
             
                Helper::sendError('Validation Failed',$validated->errors());
            }
       
        
        
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
