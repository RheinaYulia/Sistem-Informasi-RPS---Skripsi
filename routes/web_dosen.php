<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\Profile\DosenProfileController;
use App\Http\Controllers\Proposal\DosenLogBimbinganController;
use App\Http\Controllers\Proposal\DosenPembimbingController;
use App\Http\Controllers\Proposal\DosenRekapUjianSemproController;
use App\Http\Controllers\Proposal\DosenUjianSemproController;
use App\Http\Controllers\Proposal\DosenUsulanTopikController;
use App\Http\Controllers\Proposal\DosenSemproController;
use App\Http\Controllers\Rps\RpsController;
use App\Http\Controllers\Rps\RPSdetailController;
use App\Http\Controllers\Setting\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'lecturer', 'middleware' => ['auth']], function() {

    // profile Dosen
    Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function() {
        Route::get('/', [DosenProfileController::class, 'index']);
        Route::put('/', [DosenProfileController::class, 'update']);
        Route::put('avatar', [DosenProfileController::class, 'update_avatar']);
        Route::put('password', [DosenProfileController::class, 'update_password']);
    });
});

Route::group(['prefix' => 'rps', 'middleware' => ['auth']], function() {

     // Kelola Dosen
     Route::resource('kelola_rps', RpsController::class)->parameter('kelola_rps', 'id');
     Route::post('kelola_rps/list', [RpsController::class, 'list']);
     Route::get('kelola_rps/{id}/delete', [RpsController::class, 'confirm']);
     Route::get('kelola_rps/{id}/showi', [RpsController::class, 'showi']);
     Route::post('kelola_rps/{id}/detail/menu_save', [RPSController::class, 'menu_save']);

      // Kelola Dosen
      Route::resource('kelola_master', RPSdetailController::class)->parameter('kelola_master', 'id');
      Route::post('kelola_master/list', [RPSdetailController::class, 'list']);
      Route::get('kelola_master/{id}/delete', [RPSdetailController::class, 'confirm']);
});
