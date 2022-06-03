<?php

use App\Http\Controllers\FirstController;
use App\Http\Controllers\SecondController;
use App\Http\Controllers\ZipcodeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\ThirdController;
use Illuminate\Support\Facades\Route;
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

Route::get('/',[FirstController::class,'index']);

// ZIPcode（参画前の準備課題）
Route::get('/zipcode',[ZipcodeController::class,'zipcode']);
Route::get('/zipcode/view',[ZipcodeController::class,'view']);
Route::post('/zipcode/view',[ZipcodeController::class,'add']);
Route::get('/zipcode/view/delete/{id}',[ZipcodeController::class,'delete']);



// DB接続API
Route::get('/zipcode/address',[PostController::class,'address']);


Route::get('/first/request',[FirstController::class,'request']);
Route::post('/first/request',[FirstController::class,'request']);
Route::get('/first/request2',[FirstController::class,'request2']);
Route::post('/first/request2',[FirstController::class,'request2']);
Route::get('/first/service',[FirstController::class,'service']);
Route::get('/first/service2',[FirstController::class,'service2']);
Route::get('/first/service2/{id}',[FirstController::class,'service2']);
Route::get('/first/service3',[FirstController::class,'service3']);

Route::get('/second/aimai',[SecondController::class,'aimai']);
Route::get('/second/aimai/{id}',[SecondController::class,'aimai']);
Route::get('/second/hashi',[SecondController::class,'hashi']);
Route::get('/second/pluck',[SecondController::class,'pluck']);
Route::get('/second/chunk',[SecondController::class,'chunk']);
Route::get('/second/chunkOrderBy',[SecondController::class,'chunkOrderBy']);
Route::get('/second/whereAndOr/',[SecondController::class,'aimai']);
Route::get('/second/whereAndOr/{id}',[SecondController::class,'whereAndOr']);
Route::get('/second/page',[SecondController::class,'page']);
Route::get('/second/model',[SecondController::class,'model']);
Route::get('/second/reject',[SecondController::class,'reject']);
Route::get('/second/diff',[SecondController::class,'diff']);
Route::get('/second/modelKeys',[SecondController::class,'modelKeys']);
Route::get('/second/merge',[SecondController::class,'merge']);
Route::get('/second/map',[SecondController::class,'map']);
Route::get('/second/fields',[SecondController::class,'fields']);
Route::get('/second/accessa',[SecondController::class,'accessa']);
Route::get('/second/save/{id}/{name}',[SecondController::class,'save']);
Route::get('/second/search',[SecondController::class,'search']);
Route::get('/second/json',[SecondController::class,'json']);
Route::get('/second/json/{id}',[SecondController::class,'json']);

Route::get('/third/name',[ThirdController::class,'name']);








/* Route::get('/',[SecondController::class,'']); */











//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
