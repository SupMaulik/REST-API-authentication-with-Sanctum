<?php

namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    //

     public function index(Request $request)
     {

        $user=User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password,$user->password))
        {
            return response(["message"=>"These credentials don't match our records"],404);

        }

        $token=$user->createToken('api-token')->plainTextToken;

         $response=['user'=>$user,
                    'token'=>$token,
                   ];

                   return response($response,201);

     }

     public function register(Request $req)
     {
          $req->validate([

              "name"=>'required',
              "email"=>'required',
              "password"=>'required|confirmed',
              'password_confirmation'=>'required'
          ]);

          $user=new User();
          $user->name=$req->name;
          $user->email=$req->email;
          $user->password=Hash::make($req->password);
          $user->save();

          $token=$user->createToken('api-token')->plainTextToken;


          $response=['user'=>$user,
          'token'=>$token,
           "message"=>"User inserted"
         ];
      return response($response,201);
        

     }

     public function logout(Request $req)
     {
           $req->user()->tokens()->delete();
           return response(["Logout Successfuly"]);

     }
}
