<?php

use App\Http\Controllers\Rps\PengesahanController;

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'rps', 'middleware' => ['auth']], function() {
   
     // Kelola Bab
     Route::resource('pengesahan', PengesahanController::class)->parameter('pengesahan', 'id');
     Route::post('pengesahan/list', [PengesahanController::class, 'list']);
     Route::get('pengesahan/{id}/delete', [PengesahanController::class, 'confirm']);
});