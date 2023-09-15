<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;




//member all route
Route::get('/',[MemberController::class,'index']);
Route::post('/member/store',[MemberController::class,'store'])->name('member.store');
Route::get('/edit/member/{id}',[MemberController::class,'edit']);
Route::post('/update/member/{id}',[MemberController::class,'update']);
