<?php

use App\Http\Controllers\Master\BeritaController;
use App\Http\Controllers\Master\DosenCircleController;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Master\JurusanController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\MahasiswaController;
use App\Http\Controllers\Setting\PeriodeController;
use App\Http\Controllers\Master\ProdiController;
use App\Http\Controllers\Master\TahapanProposalController;
use App\Http\Controllers\Proposal\AdminHasilSeminarProposalController;
use App\Http\Controllers\Proposal\AdminPendaftaranSemproController;
use App\Http\Controllers\Proposal\AdminProposalMahasiswaBermasalahController;
use App\Http\Controllers\Proposal\AdminProposalMahasiswaController;
use App\Http\Controllers\Proposal\AdminUsulanTopikController;
use App\Http\Controllers\Report\LogActivityController;
use App\Http\Controllers\Setting\AccountController;
use App\Http\Controllers\Setting\GroupController;
use App\Http\Controllers\Setting\MenuController;
use App\Http\Controllers\Setting\ProfileController;
use App\Http\Controllers\Setting\UserController;
use App\Http\Controllers\Transaction\QuotaDosenController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'dosen', 'middleware' => ['auth']], function () {

    // Kelola Dosen
    Route::resource('kelola_dosen', DosenController::class)->parameter('kelola_dosen', 'id');
    Route::post('kelola_dosen/list', [DosenController::class, 'list']);
    Route::get('kelola_dosen/{id}/delete', [DosenController::class, 'confirm']);
    Route::get('kelola_dosen/show', [DosenController::class, 'show'])->name('show-data');
    Route::get('kelola_dosen/menu_save', [DosenController::class, 'menu_save']);


});

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

    // User
    Route::get('periode', [PeriodeController::class, 'index']);
    // Route::resource('periode', PeriodeController::class)->parameter('periode', 'id');
    // Route::post('periode/list', [PeriodeController::class, 'list']);
    Route::post('periode/update', [PeriodeController::class, 'update'])->name('periode.update'); // Tambahkan ini
    // Route::get('periode/{id}/delete', [PeriodeController::class, 'confirm']);
});
