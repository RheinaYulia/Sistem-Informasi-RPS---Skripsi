<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\Master\MediaController;
use App\Http\Controllers\Master\PustakaController;
use App\Http\Controllers\Profile\DosenProfileController;
use App\Http\Controllers\Proposal\DosenLogBimbinganController;
use App\Http\Controllers\Proposal\DosenPembimbingController;
use App\Http\Controllers\Proposal\DosenRekapUjianSemproController;
use App\Http\Controllers\Proposal\DosenSemproController;
use App\Http\Controllers\Proposal\DosenUjianSemproController;
use App\Http\Controllers\Proposal\DosenUsulanTopikController;
use App\Http\Controllers\Rps\PengembangController;
use App\Http\Controllers\Rps\PengesahanController;
use App\Http\Controllers\Rps\RpsBabController;
use App\Http\Controllers\Rps\RpsController;
use App\Http\Controllers\Rps\RPSdetailController;
use App\Http\Controllers\Rps\RPSMasterController;
use App\Http\Controllers\Rps\RpsTampilController;

use App\Http\Controllers\Rps\StatusSahController;
use App\Http\Controllers\Rps\StatusVerController;
use App\Http\Controllers\Rps\VerifikasiController;
use App\Http\Controllers\Setting\ProfileController;
use App\Models\Rps\PengesahanModel;
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

Route::group(['prefix' => 'master', 'middleware' => ['auth']], function() {

     Route::resource('media', MediaController::class)->parameter('media', 'id');
     Route::post('media/list', [MediaController::class, 'list']);
     Route::get('media/{id}/delete', [MediaController::class, 'confirm']);

     Route::resource('pustaka', PustakaController::class)->parameter('pustaka', 'id');
     Route::post('pustaka/list', [PustakaController::class, 'list']);
     Route::get('pustaka/{id}/delete', [PustakaController::class, 'confirm']);
});

Route::group(['prefix' => 'rps', 'middleware' => ['auth']], function() {

     // Kelola Dosen
     Route::resource('kelola_rps', RpsController::class)->parameter('kelola_rps', 'id');
     Route::post('kelola_rps/list', [RpsController::class, 'list']);
     Route::get('kelola_rps/{id}/delete', [RpsController::class, 'confirm']);

        // routes/web.php
    Route::get('/rps/kelola_rps/{id}', [RpsController::class, 'shows'])->name('rps.shows');

    Route::resource('detail_rps', RpsTampilController::class)->parameter('detail_rps', 'id');
     Route::post('detail_rps/list', [RpsTampilController::class, 'list']);

      // Kelola Dosen
      Route::resource('kelola_master', RPSdetailController::class)->parameter('kelola_master', 'id');
      Route::post('kelola_master/list', [RPSdetailController::class, 'list']);
      Route::post('kelola_master/{id}/listbab', [RPSdetailController::class, 'listbab'])->name('kelola_master.listbab');
      Route::get('kelola_master/master_rps/{id}/edit1', [RPSdetailController::class, 'edit1'])->name('kelola_master.edit1');
      Route::match(['post', 'put'], 'kelola_master/{id}/update1', [RPSdetailController::class, 'update1'])->name('kelola_master.update1');
      Route::get('kelola_master/master_rps/{id}/editCplProdi', [RPSdetailController::class, 'editCplProdi'])->name('kelola_master.editCplProdi');
      Route::match(['post', 'put'], 'kelola_master/{id}/updateCplProdi', [RPSdetailController::class, 'updateCplProdi'])->name('kelola_master.updateCplProdi');
      Route::get('kelola_master/master_rps/{id}/editCPMK', [RPSdetailController::class, 'editCPMK'])->name('kelola_master.editCPMK');
      Route::match(['post', 'put'], 'kelola_master/{id}/updateCPMK', [RPSdetailController::class, 'updateCPMK'])->name('kelola_master.updateCPMK');
      Route::get('kelola_master/master_rps/{id}/editBk', [RPSdetailController::class, 'editBk'])->name('kelola_master.editBk');
      Route::match(['post', 'put'], 'kelola_master/{id}/updateBk', [RPSdetailController::class, 'updateBk'])->name('kelola_master.updateBk');
      Route::get('kelola_master/master_rps/{id}/editPengampu', [RPSdetailController::class, 'editPengampu'])->name('kelola_master.editPengampu');
      Route::match(['post', 'put'], 'kelola_master/{id}/updatePengampu', [RPSdetailController::class, 'updatePengampu'])->name('kelola_master.updatePengampu');
      Route::get('kelola_master/master_rps/{id}/editMedia', [RPSdetailController::class, 'editMedia'])->name('kelola_master.editMedia');
      Route::match(['post', 'put'], 'kelola_master/{id}/updateMedia', [RPSdetailController::class, 'updateMedia'])->name('kelola_master.updateMedia');
      Route::get('kelola_master/master_rps/{id}/editPustaka', [RPSdetailController::class, 'editPustaka'])->name('kelola_master.editPustaka');
      Route::match(['post', 'put'], 'kelola_master/{id}/updatePustaka', [RPSdetailController::class, 'updatePustaka'])->name('kelola_master.updatePustaka');
      Route::get('kelola_master/{id}/delete', [RPSdetailController::class, 'confirm']);
      Route::get('kelola_master/master_rps/{id}/editMkSyarat', [RPSdetailController::class, 'editMkSyarat'])->name('kelola_master.editMkSyarat');
      Route::match(['post', 'put'], 'kelola_master/{id}/updateMkSyarat', [RPSdetailController::class, 'updateMkSyarat'])->name('kelola_master.updateMkSyarat');
    //   Route::get('kelola_master/master_rps/kelola-data/{id}', [RPSdetailController::class, 'kelolaData'])->name('kelola.data');

      //BAB RPS

      Route::get('kelola_master/bab_rps/kelola-data/{id}', [RPSdetailController::class, 'kelolaData'])->name('kelola.data');
      Route::post('kelola_master/{id}/listbab', [RPSdetailController::class, 'listbab'])->name('kelola_master.listbab');
      Route::get('kelola_master/bab_rps/{id}/{bab_id}/editBab', [RPSdetailController::class, 'editBab'])->name('kelola_master.editBab');
      Route::match(['post', 'put'], 'kelola_master/bab_rps/{id}/updateBab', [RPSdetailController::class, 'updateBab'])->name('kelola_master.updateBab');
      Route::get('kelola_master/bab_rps/{id}/{bab_id}/editBabMateri', [RPSdetailController::class, 'editBabMateri'])->name('kelola_master.editBabMateri');
      Route::match(['post', 'put'], 'kelola_master/bab_rps/{id}/updateBabMateri', [RPSdetailController::class, 'updateBabMateri'])->name('kelola_master.updateBabMateri');

      // Kelola Dosen
      

      // Kelola Bab
      Route::resource('kelola_bab', RpsBabController::class)->parameter('kelola_bab', 'id');
      Route::get('kelola_bab/bab_rps/kelola-data/{id}', [RPSBabController::class, 'kelolaData'])->name('kelola.data');
      Route::post('kelola_bab/list', [RpsBabController::class, 'list']);
      Route::post('kelola_bab/{id}/listbab', [RpsBabController::class, 'listbab'])->name('kelola_bab.listbab');
      Route::get('kelola_bab/{id}/delete', [RpsBabController::class, 'confirm']);
      Route::get('kelola_bab/bab_rps/{id}/{bab_id}/editBab', [RPSBabController::class, 'editBab'])->name('kelola_bab.editBab');
      Route::match(['post', 'put'], 'kelola_bab/bab_rps/{id}/updateBab', [RPSBabController::class, 'updateBab'])->name('kelola_bab.updateBab');
      Route::get('kelola_bab/bab_rps/{id}/{bab_id}/editBabMateri', [RPSBabController::class, 'editBabMateri'])->name('kelola_bab.editBabMateri');
      Route::match(['post', 'put'], 'kelola_bab/bab_rps/{id}/updateBabMateri', [RPSBabController::class, 'updateBabMateri'])->name('kelola_bab.updateBabMateri');


      // Kelola Bab
      Route::resource('status_ver', StatusVerController::class)->parameter('status_ver', 'id');
      Route::post('status_ver/list', [StatusVerController::class, 'list']);
      Route::get('status_ver/{id}/delete', [StatusVerController::class, 'confirm']);

      // Kelola Bab
      Route::resource('status_sah', StatusSahController::class)->parameter('status_sah', 'id');
      Route::post('status_sah/list', [StatusSahController::class, 'list']);
      Route::get('status_sah/{id}/delete', [StatusSahController::class, 'confirm']);

      
});
