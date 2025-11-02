<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserExcelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){ 
    // user
    Route::post('user/validate-search', [UserController::class, 'validateSearch'])->name('user.validate_search');
    Route::get('user/excel', [UserController::class, 'excel'])->name('user.excel');
    Route::resource('user', UserController::class)->except('destroy');
    Route::delete('user', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('user/excel/import', [UserExcelController::class, 'import'])->name('user.import');
    Route::get('user/excel/download-template', [UserExcelController::class, 'downloadTemplate'])->name('user.download_template');
    Route::get('user/excel/export', [UserExcelController::class, 'export'])->name('user.export');
    // category
    Route::post('category/validate-search', [CategoryController::class, 'validateSearch'])->name('category.validate_search');
    Route::resource('category', CategoryController::class)->except(['show', 'destroy']);
    Route::delete('category', [CategoryController::class, 'destroy'])->name('category.destroy');
});