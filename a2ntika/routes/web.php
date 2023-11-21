<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DriveController;
use App\Http\Controllers\UserController;
use App\Models\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware("auth")->group(function(){



    Route::prefix("user")->group(function(){
        Route::get("/profile",[UserController::class,'profile'])->name("user.profile");
        Route::post("/uploadimage",[UserController::class,'uploadimage'])->name("user.uploadimage");

    });

    Route::prefix("drive")->group(function(){

        Route::get("/MyFiles",[DriveController::class , 'MyFiles'])->name("drive.MyFiles");
        Route::get("/show/{id}",[DriveController::class , 'show'])->name("drive.show");
        Route::get("/publicfiles",[DriveController::class,'publicfiles'])->name("drive.publicfiles");
        Route::get("/error",[DriveController::class,'error'])->name("drive.error");
        Route::get("/allfiles",[DriveController::class , 'allfiles'])->name("drive.allfiles")->middleware("admin");



        Route::get("/create",[DriveController::class , 'create'])->name("drive.create");
        Route::post("/store",[DriveController::class , 'store'])->name("drive.store");
        // route with ID
        Route::get("/edit/{id}",[DriveController::class , 'edit'])->name("drive.edit");
        Route::post("/update/{id}",[DriveController::class , 'update'])->name("drive.update");
        Route::post("/destroy/{id}",[DriveController::class , 'destroy'])->name("drive.destroy");
        Route::get("/download/{id}",[DriveController::class ,'download'])->name("drive.download");
        Route::get("/changestatus/{id}",[DriveController::class,'changestatus'])->name("drive.changestatus");
    });






});
