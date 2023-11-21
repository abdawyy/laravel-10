<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drive;
use Illuminate\Support\Facades\DB;

class DriveController extends Controller
{
    public function MyFiles($id){
        $user_id=$id;
        $drives=Drive::where("user_id","=",$user_id)->get();
        $response=[
            "message"=>"success",
            "Data"=>$drives,
            "status"=>201,
        ];

        return response($response,200);
    }
    public function publicfiles()
    {

        $drives=Drive::where("status", "=" ,'public')->get();
        $response=[
            "message"=>"success",
            "Data"=>$drives,
            "status"=>201,
        ];

        return response($response,200);
    }





    public function store(Request $request ,$id)
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
      //  $drive->user_id=auth()->user()->id;
        $drive->user_id=$id;
        $drive->save();
        $response=[
            "message"=>"success",
            "Data"=>$drive,
            "status"=>201,
        ];

        return response($response,200);

    }



    public function show($id)
    {
        $drive=DB::table('drivewithusers')->where('Drive_id','=',$id)->first();
        if(empty($drive)){
            $response=[
                "message"=>"No found Any Data",
            ];
        }else{
            $response=[
                "message"=>"success",
                "data"=>$drive,
                "status"=>200
            ];

        }
        return response($response,200);

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

        $response=[
            "message"=>"success",
            "Data"=>$drive,
            "status"=>201,
        ];

        return response($response,200);

    }


    public function destroy($id)
    {
        $drive=Drive::where("id",$id)->first();
        $filepath=public_path("/upload/$drive->file");
        unlink($filepath);
        $drive->delete();

        $response=[
            "message"=>"success",
            "Data"=>$drive,
            "status"=>201,
        ];

        return response($response,200);



    }


    public function changestatus($id){
        $drive = Drive::find($id);
        if($drive->status =='private'){
            $drive->status ="public";
            $drive->save();
            $response=[
                "message"=>"success status pubilc",
                "Data"=>$drive,
                "status"=>201,
            ];

            return response($response,200);
        }else{
            $drive->status='private';
            $drive->save();
            $response=[
                "message"=>"success status private",
                "Data"=>$drive,
                "status"=>201,
            ];

            return response($response,200);


        }
    }

    public function allfiles(){
        $drive=Drive::all();
        if(empty($drive)){
            $response=[
                "message"=>"No found Any Data",
            ];
        }else{
            $response=[
                "message"=>"success",
                "data"=>$drive,
                "status"=>200
            ];

        }
        return response($response,200);

    }
    public function download($id)
    {
        $drive=Drive::where("id",$id)->first();
        $filepath=public_path("/upload/$drive->file");
        return response()->download($filepath);
    }
}
