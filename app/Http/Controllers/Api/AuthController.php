<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
   public function login(Request $request){
   $validation= $request->validate([
        'email'=>'required|string',
        'password'=>'required|string',
    ]);
    $user=User::where('email',$request->email)->first();

    if(empty($user) || !Hash::check($request->password,$user->password)){
        return Response::json([
            'message'=>"Credentials do not match..Try Again....",
        ]);
    }
    $token=$user->createToken('myToken')->plainTextToken;
    return Response::json([
        'user'=>$user,
        'token'=>$token,
        'status'=>200,
    ]);

   }
   public function logout(){
      auth()->user()->tokens()->delete();
return Response::json([
    'message'=>"Logout Success",
]);
   }
   public function register(Request $request){
       $validation=$request->validate([
        'name'=>'required|string',
        'email'=>'required|string',
        'password'=>'required|confirmed',
        'phone'=>'required',
        'address'=>'required',
       ]);
  $user= User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'phone'=>$request->phone,
        'address'=>$request->address,


       ]);
       $token=$user->createToken('registerToken')->plainTextToken;
       return Response::json([
           'message'=>'Register Successs!',
           'token'=>$token,
       ],200);
   }
}
