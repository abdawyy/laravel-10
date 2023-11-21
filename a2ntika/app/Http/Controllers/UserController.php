<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile(){
        $id=auth()->user()->id;
        $user=User::find($id);
        return view("user.profile",compact('user'));
    }
    public function uploadimage(Request $request){
        $id=auth()->user()->id;
        $user=User::find($id);
        //
        $file_data=$request->file("image");
        $drive_name= $file_data->getClientOriginalName();
        $drive_extension=$file_data->getClientOriginalExtension();
        $location=public_path("./users");
        $file_data->move($location,$drive_name);
        //---------------
        $user->image=$drive_name;
        $user->save();
        return redirect()->back()->with("done","upload done thank you");

    }
}
