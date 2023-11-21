<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIs\DriveController;

use App\Http\Controllers\APIs\userController;


Route::post("register",[userController::class ,'register']);
Route::post("login",[userController::class ,'login']);

Route::middleware("auth:sanctum")->group(function(){
    Route::post("logout",[userController::class ,'logout']);


    Route::prefix("drive")->group(function(){

        Route::get("/MyFiles/{id}",[DriveController::class , 'MyFiles']);
        Route::get("/show/{id}",[DriveController::class , 'show']);
        Route::get("/publicfiles",[DriveController::class,'publicfiles']);
        Route::get("/error",[DriveController::class,'error']);
        Route::get("/allfiles",[DriveController::class , 'allfiles']);



        Route::post("/store/{id}",[DriveController::class , 'store']);
        // route with ID
        Route::post("/update/{id}",[DriveController::class , 'update']);
        Route::post("/destroy/{id}",[DriveController::class , 'destroy']);
        Route::get("/changestatus/{id}",[DriveController::class,'changestatus']);


});

});

