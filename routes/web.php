<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MailLogController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserExcelController;
use Illuminate\Support\Facades\Route;

Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login.get');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout.post');
Route::get('admin/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('admin.forgot-password.get');
Route::post('admin/forgot-password', [AuthController::class, 'forgotPassword'])->name('admin.forgot-password.post');
Route::get('admin/forgot-password/success', [AuthController::class, 'showForgotPasswordSuccess'])->name('admin.forgot-password.success');
Route::get('admin/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('admin.reset-password.get');
Route::get('admin/reset-password/error', [AuthController::class, 'showResetPasswordError'])->name('admin.reset-password.error');
Route::get('admin/reset-password/success', [AuthController::class, 'showResetPasswordSuccess'])->name('admin.reset-password.success');
Route::post('admin/reset-password', [AuthController::class, 'resetPassword'])->name('admin.reset-password.post');

Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth', 'as' => 'admin.'], function(){ 
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');
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
    // product
    Route::post('product/validate-search', [ProductController::class, 'validateSearch'])->name('product.validate_search');
    Route::resource('product', ProductController::class)->except('destroy');
    Route::delete('product', [ProductController::class, 'destroy'])->name('product.destroy');
    // order
    Route::get('order/pending', [OrderController::class, 'pending'])->name('order.pending');
    // activity log
    Route::get('activity-log', [ActivityLogController::class, 'index'])->name('activity_log.index');
    // mail log
    Route::get('mail-log', [MailLogController::class, 'index'])->name('mail_log.index');
});