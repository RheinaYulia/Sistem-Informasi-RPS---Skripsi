<?php

use App\Http\Controllers\Kakel\KakelController;
use App\Http\Controllers\Rps\PengembangController;
use App\Http\Controllers\Rps\VerifikasiController1;
use App\Http\Controllers\Rps\VerifikasiController2;
use App\Http\Controllers\Rps\VerifikasiController3;
use App\Http\Controllers\Rps\VerifikasiController;
use App\Http\Controllers\Setting\GroupController;
use App\Http\Controllers\Setting\MenuController;
use App\Http\Controllers\Setting\UserController;
use Illuminate\Support\Facades\Route;






Route::group(['prefix' => 'setting', 'middleware' => ['auth']], function () {

    // Menu
    Route::resource('menu', MenuController::class)->parameter('menu', 'id');
    Route::post('menu/list', [MenuController::class, 'list']);
    Route::get('menu/{id}/delete', [MenuController::class, 'confirm']);

    // Group
    Route::resource('group', GroupController::class)->parameter('group', 'id');
    Route::post('group/list', [GroupController::class, 'list']);
    Route::put('group/{id}/menu', [GroupController::class, 'menu_save']);
    Route::get('group/{id}/delete', [GroupController::class, 'confirm']);

    // User
    Route::resource('user', UserController::class)->parameter('user', 'id');
    Route::post('user/list', [UserController::class, 'list']);
    Route::get('user/{id}/delete', [UserController::class, 'confirm']);
});

Route::group(['prefix' => 'rps', 'middleware' => ['auth']], function() {

     // Kelola Bab
     Route::resource('verifikasi', VerifikasiController::class)->parameter('verifikasi', 'id');
     Route::post('verifikasi/list', [VerifikasiController::class, 'list']);
     Route::get('verifikasi/{id}/delete', [VerifikasiController::class, 'confirm']);

     // Kelola Bab


     // Kelola Bab
     Route::resource('pengembang', PengembangController::class)->parameter('pengembang', 'id');
     Route::post('pengembang/list', [PengembangController::class, 'list']);
     Route::get('pengembang/{id}/delete', [PengembangController::class, 'confirm']);
});

Route::group(['prefix' => 'kakel', 'middleware' => ['auth']], function() {

    // Kelola Bab
    Route::resource('aktivasi', KakelController::class)->parameter('aktivasi', 'id');
    Route::post('aktivasi/list', [KakelController::class, 'list']);
    Route::get('aktivasi/{id}/delete', [KakelController::class, 'confirm']);
});

