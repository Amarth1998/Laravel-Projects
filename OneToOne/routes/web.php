<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SellerController;


Route::get('onetoone',[SellerController::class,'onetoone']);
Route::get('onetomany',[SellerController::class,'onetomany']);

Route::get('manytoone',[SellerController::class,'manytoone']);
