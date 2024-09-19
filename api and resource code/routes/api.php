<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MemberController;


Route::resource('member',MemberController::class);
Route::get('searchStudent/{name}',[MemberController::class,'searchStudent']);
