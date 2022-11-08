<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {


            $input = $request->only('name','email','password');
            $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
        if($request['role']){
            $user->syncRoles($request['role']);
        };
            /* $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name; */

            $user->assignRole('user');
        $response = [
            'success' => true,
            'test' => $request['role'],
            'data' => new UserResource($user),
            'message' => 'User Register Successfull'
        ];

        return response()->json($response,200);

    }
    public function login(LoginRequest $request)
    {
        $validated = Validator::make($request->all(),[


            'email' => 'required|email',
            'password' => 'required',

           ]);
            if($validated->fails()){
                $response = [
                    'success' => false,
                    'message' => $validated->errors()
                ];
                return response()->json($response,400);
            }

       if( Auth::attempt(['email' => $request->email, 'password' => $request->password],true) )
       {
        $user = Auth::user();
        /* $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name; */
    $response = [
        'success' => true,
        'data' => new UserResource(Auth::user()),
        'message' => 'User Login Successfull'
    ];
           return response()->json($response,200);
       }
       else{
        $response = [
            'success' => false,

            'message' => 'Email and Password Not Matched'
        ];
           return response()->json($response);
       }
    }
    public function authUser(Request $request)
    {
       /*  return response()->json(); */
        if(Auth::check()){

            $response = [
                'success' => true,
                'data' => new UserResource($request->user()),
                'message' => 'Auth User Details Fetching Successfull'
            ];
                   return response()->json($response,200);
        }else{
            Helper::sendError('User is not Authenticated');
        }
    }
    public function allUser()
    {
        $users = User::latest()->get();
        $role = $users[0]->getRoleNames();
        $formatedUser = [];
        foreach($users as $index => $user){
            $formatedUser[$index] = new UserResource($user);
        }
        $response = [
            'success' => true,
            'data' => $formatedUser,
            'message' => 'Auth User Details Fetching Successfull',
            'role' => $role
        ];
       return response()->json($response);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

            return response()->json('User Deleted Successfully');

        }

        public function update(User $user,Request $request)
        {
           $validated = Validator::make($request->all(),[
                'name' => 'required',
                'email' =>'required|email',

            ]
        );
       if($validated->fails()){

            Helper::sendError('Validation Failed',$validated->errors());
        }else{
            
            $request['role'] ? $user-> syncRoles($request['role']) : '';
            
            if($request->file('image')){

                $imageName = '';
                if($user->image){

                    $imagePath = public_path('/image/profile/'.$user->image);
                    if(File::exists($imagePath)){
                        unlink($imagePath);
                    }
                }
                $file = $request->file('image');
                $imageName = $file->getClientOriginalName();
                
                $file->move(public_path('image/profile'),$imageName);
                $user->update([
                    'image' => $imageName   
                ]);
            }
           $u = $user->update([
           
                'name' => $request['name'],
                'email' => $request['email'],
                
            ]);
            $response = [
                'success' => true,
                'data' => new UserResource($user),
                'message' => ' User Details Updating Successfull',
                /* 'role' => $request */
            ];
            return response()->json($response);
         }

        }
    }



