<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;





class ProviderController extends Controller
{

      // ####################### *Start register* ########################

      public function register(Request $request)
      {
          $request->validate([
              'name'     => 'required|string|max:255',
              'email'    => 'required|string|email|max:255|unique:users',
              'password' => 'required|string|min:8|confirmed',
          ]);
  
          $user= User::create([
              'name'     => $request->name,
              'email'    => $request->email,
              'password' => Hash::make($request->password),
              'role'	 => 'provider',
          ]);
          return response()->json(['message', 'Provider registered successfully'], 201);
      }
  
      // ########################## *end register* ##########################
      
      
      // ####################### *Start login* ########################
  
      public function login(Request $request) 
      {
          $request->validate ([
              'email'     => 'required|string|email',
              'password'  =>'required|string'
          ]);
  
          $user = User::where('email', $request->email)->first();
  
          if (!$user || !Hash::check($request->password, $user->email)){
              throw ValidationException::withMessges([
                  'email' => 'The provided credentials are incorrect.',
              ]);
          }
  
          $token = $user->createToken('auth_token')->plainTextToken;
  
          return response()->json(['access_token' =>$token, 'token_type'=>'Bearer']);
  
      }
  
      // ########################## *end login* ##########################
  
  
      // ####################### *Start logout* ########################
  
      public function logout(Request $request) {
          $request->user()->tokens()->delete();
          return response()->json(['message', 'Logged out successfully']);
  
      }
      // ########################## *end logout user* ##########################

}
