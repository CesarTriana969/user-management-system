<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\CheckEmailCodeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordCodeController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('reset-password-mail', ResetPasswordCodeController::class)->name('reset-password-mail');
Route::post('check-email-code', CheckEmailCodeController::class)->name('check-email-code');
Route::post('change-password-email', ChangePasswordController::class)->name('change-password-email');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'system'], function () {
    require __DIR__ . '/web/panel.routes.php';
});

Route::get('/', function () {
    return redirect()->route('login');
});