<?php

namespace App\Http\Controllers\APIS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\User;
use illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function register(Request $request){
        
        $data=$request->validate([
            "name"=>"required|string",
            "email"=>"required|email|unique:user,email",
            "password"=>"required|confirmed",
        ]);
        $user=User::create([
            "name"=>$data['name'],
            "email"=>$data['email'],
            "password"=>bcrypt($data['password'])
        ]);
        $token =$user->createToken('mytoken')->plainTextToken;

        $response=[
            "message"=>"welcome boy",
            "token"=>$token,
            "user"=>$user,
            "status"=>"201",
        ];
        return response($response,201);

    }
    public function login(Request $request){
        $data = $request->validate([
            "email"=>"required|email",
            "password"=>"required",

        ]);
        $user=User::where("email",'=',$data['email']->first());
        if(!Hash::check($data['password'], $user->password)&&!$user){
            $response=[
                "message"=>"try again",
            ];
        }
        $token =$user->createToken('mytoken')->plainTextToken;

        $response=[
            "message"=>"welcome boy",
            "token"=>$token,
            "user"=>$user,
            "status"=>"201",
        ];
        return response($response,201);

    }
    public function logout(){
        auth()->user()->tokens()->delete();
        $response=[
            "message"=>"logout done",

        ];
        return response($response,201);

    }
}
