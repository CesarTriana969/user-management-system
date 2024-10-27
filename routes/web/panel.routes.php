<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::controller(App\Http\Controllers\UserController::class)->group(function(){
        Route::get('/users', 'index')->name('user');
        Route::get('/get/users', 'users')->name('get.user');
        Route::get('/user/create', 'create')->name('get.create');
        Route::get('/user/edit/{user}', 'edit')->name('get.edit');
        Route::post('/user/store', 'store');
        Route::put('/update-password', 'updatePassword')->name('update-password');
        Route::put('/user/update/{id}', 'update');
        Route::post('/user/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\RoleController::class)->group(function(){
        Route::get('/roles', 'index')->name('role');
        Route::get('/role/create', 'create')->name('role.create');
        Route::post('/role/store', 'store');
        Route::patch('/role/update/{id}', 'update');
        Route::get('/get/roles', 'roles')->name('get.roles');
        Route::get('/get/names-roles', 'rolesName');
        Route::get('/user-permissions', 'permissions');
        Route::post('/role/delete', 'destroy');
    });

    Route::controller(App\Http\Controllers\PermissionController::class)->group(function(){
        Route::get('/permissions', 'index')->name('permission');
        Route::get('/get/permissions', 'permissions')->name('get.permissions');
        Route::get('/get/all/permissions', 'allPermissions')->name('get.all.permissions');
    });
});
