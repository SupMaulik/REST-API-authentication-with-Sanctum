<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Api\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

//Route for sample get API
Route::get('get-data',function(){

    return "This is my First Sample API";
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's

    
//Route For POST API TO INSERT OR SAVE DATA into Databse using API
Route::post('insert-data',[ProductController::class,'insert']);


//Route For PUT API TO UPDATE  DATA into Databse using API
Route::put('update-data',[ProductController::class,'update']);

//Route For Read data using get API from Database
//Route::get('display',[ProductController::class,'display']);


//Route For Delete data from Databse using API
Route::delete('delete-data',[ProductController::class,'delete']);

//Route API for search pattern 
Route::get('search',[ProductController::class,'search']);

//Get API Route for display data
Route::get('display',[ProductController::class,'display']);


Route::resource('products', App\Http\Controllers\Api\ProductController::class);




Route::post('logout',[UserController::class,'logout']);

});

Route::post('login',[UserController::class,'index']);
Route::post('register',[UserController::class,'register']);