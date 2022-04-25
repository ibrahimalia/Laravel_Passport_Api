<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginAdmin(){
        $credentials = request(['email','password']);
        $auth = Auth::guard('api-admin-s')->attempt($credentials);
        if (! $auth) {

            return response()->json(['msg'=>"something wrong in user information"],404);
        }
          $user = Admin::where('email' , request('email'))->first();
          $token = $user->createToken("adminToken")->accessToken;
          $response= [
              'user'=>$user,
              'token'=>$token
          ];
         return response($response,201);
      }
      public function registerAdmin(Request $request){
          $filed = $request->validate([
              'name'=>'required|string',
              'email' =>'required|string|email',
              'password' => 'required|string'
          ]) ;
          $user= Admin::create([
              'name'=>$filed['name'],
              'email'=>$filed['email'],
              'password'=>Hash::make($filed['password']),
          ]);
          $token = $user->createToken("adminToken")->accessToken;
          $response= [
              'user'=>$user,
              'token'=>$token
          ];
         return response($response,201);
      }
    public function login(){
        $credentials = request(['email','password']);
        $auth = auth("api-s")->attempt($credentials);
        if (! $auth) {

            return response()->json(['msg'=>"something wrong in user information"],404);
        }
          $user = User::where('email' , request('email'))->first();
          $token = $user->createToken("myToken")->accessToken;
          $response= [
              'user'=>$user,
              'token'=>$token
          ];
         return response($response,201);
      }
      public function register(Request $request){
          $filed = $request->validate([
              'name'=>'required|string',
              'email' =>'required|string|email',
              'password' => 'required|string'
          ]) ;
          $user= User::create([
              'name'=>$filed['name'],
              'email'=>$filed['email'],
              'password'=>Hash::make($filed['password']),
          ]);
          $token = $user->createToken("myToken")->accessToken;
          $response= [
              'user'=>$user,
              'token'=>$token
          ];
         return response($response,201);
      }
      public function infoUser(Request $request){
        return Auth::user();
    }
      public function infoAdmin(Request $request){
        return Auth::user();
    }
}
