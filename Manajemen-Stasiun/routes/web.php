<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\KeretaController;
use App\Http\Controllers\loginController;


Route::group(['middleware' => 'adminLoggedIn'], function () {    

Route::get('/', function () {
    return view('landingPage');
});
Route::get('login', [loginController::class, 'showLoginForm'])->name('admin.login');
});

Route::post('/login', [loginController::class, 'login']);
Route::get('/logout', [loginController::class, 'logout'])->name('admin.logout');
Route::group(['middleware' => 'admin'], function () {    
    // Stasiun
    Route::get('/showStasiun', [PointController::class, 'index'])->name('stasiun.index');
    Route::post('/inputStasiun', [PointController::class,'store'])->name('stasiun.store');
    Route::get('/formInputStasiun', [PointController::class, 'show'])->name('formInputStasiun');
    Route::get('/formUpdateStasiun/{id}', [PointController::class, 'formUpdateStasiun'])->name('formUpdateStasiun');
    Route::post('/updateStasiun/{id}', [PointController::class, 'edit'])->name('updateStasiun');
    Route::post('/deleteStasiun/{id}', [PointController::class, 'destroy'])->name('deleteStasiun');

    // Rute
    Route::get('/rute', [RuteController::class, 'index'])->name('rute.index');
    Route::post('/rute/store', [RuteController::class,'store'])->name('rute.store');
    Route::get('/formCreateRute', [RuteController::class, 'formCreate'])->name('formCreateRute');
    Route::get('/rute/detail/{id}', [RuteController::class, 'showDetail'])->name('rute.detail');
    Route::get('/rute/EditPage/{id}', [RuteController::class, 'edit'])->name('rute.editPage');
    Route::post('/rute/update/{id}', [RuteController::class, 'update'])->name('rute.update'); 
    Route::get('/rute/delete/{id}', [RuteController::class, 'destroy'])->name('rute.delete');

    // Kereta
    Route::get('/kereta', [KeretaController::class, 'index'])->name('kereta.index');
    Route::post('/kereta/store', [KeretaController::class,'store'])->name('kereta.store');
    Route::get('/formCreateKereta', [KeretaController::class, 'create'])->name('kereta.create');
    Route::get('/kereta/edit/{id}', [KeretaController::class, 'formEdit'])->name('kereta.edit');
    Route::post('/kereta/update/{id}', [KeretaController::class, 'update'])->name('kereta.update'); 
    Route::get('/kereta/delete/{id}', [KeretaController::class, 'destroy'])->name('kereta.delete');
});

