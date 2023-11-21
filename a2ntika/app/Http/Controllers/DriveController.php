<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drive;
use Illuminate\Support\Facades\DB;

class DriveController extends Controller
{
   
    public function MyFiles(){
        $user_id=auth()->user()->id;
        $drives=Drive::where("user_id","=",$user_id)->get();
        return view('drives.index' , compact("drives"));
    }
    public function publicfiles()
    {
        $user_id=auth()->user()->id;
        $drives=Drive::where("status", "=" ,'public')->get();
        return view('drives.public' , compact("drives"));
    }


    public function create()
    {
        //
        return view('drives.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required|min:5|max:50|string",
            "desc"=>"required|min:5|max:50|string",
            "file"=>"required|mimes:jpg,bmp,png",
        ]);

        $drive= new Drive();
        $drive->title= $request->title;
        $drive->desc=$request->desc;
        // file code
        $file_data=$request->file("file");
        $drive_name= $file_data->getClientOriginalName();
        $drive_extension=$file_data->getClientOriginalExtension();
        $location=public_path("./upload");
        $file_data->move($location,$drive_name);
        //---------------
        $drive->file=$drive_name;
        $drive->user_id=auth()->user()->id;
        $drive->save();
        return redirect()->back()->with("done","upload done thank you");


    }


    public function show($id)
    {
        $drive=DB::table('drivewithusers')->where('Drive_id','=',$id)->first();
        return view('drives.show' , compact("drive"));
    }


    public function edit($id)
    {
        $drive=Drive::find($id);
        return view('drives.edit' , compact("drive"));
    }


    public function update(Request $request, $id)
    {
        $drive= Drive::find($id);
        $drive->title= $request->title;
        $drive->desc=$request->desc;
        // file code
        $file_data=$request->file("file");
        if ($file_data==null){
            $drive_name=$drive->file;
        }
        else{
            $filepath=public_path("/upload/$drive->file");
            unlink($filepath);
            $drive_name= time() . $file_data->getClientOriginalName();
             $drive_extension=$file_data->getClientOriginalExtension();
             $location=public_path("./upload");
            $file_data->move($location,$drive_name);

        }


        //---------------
        $drive->file=$drive_name;
        $drive->user_id=auth()->user()->id;
        $drive->save();
        return redirect()->route("drive.show",$drive->id)->with("done","update done thank you");

    }


    public function destroy($id)
    {
        $drive=Drive::where("id",$id)->first();
        $filepath=public_path("/upload/$drive->file");
        unlink($filepath);
        $drive->delete();
        return redirect()->back()->with("done","successfully deleted");


        //
    }
    public function download($id)
    {
        $drive=Drive::where("id",$id)->first();
        $filepath=public_path("/upload/$drive->file");
        return response()->download($filepath);
    }
    public function changestatus($id){
        $drive = Drive::find($id);
        if($drive->status =='private'){
            $drive->status ="public";
            $drive->save();
            return redirect()->back()->with("done","successfully status pubilc ");
        }else{
            $drive->status='private';
            $drive->save();
            return redirect()->back()->with("done","successfully status private");


        }
    }
    public function error(){
        return view('drives.error');
    }
    public function allfiles(){
        $drives=Drive::all();
        return view('drives.index' , compact("drives"));
    }
}
