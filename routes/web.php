<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::resource('user', UserController::class)->except('destroy');
    Route::delete('user', [UserController::class, 'destroy'])->name('user.destroy');
});