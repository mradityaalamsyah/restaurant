<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('home');
});



Route::group(['prefix' => 'menu', 'as' => 'menu.'], function() {
    Route::get('/create', [MenuController::class, 'create'])->name('create');
    Route::post('/tambah', [MenuController::class,'store'])->name('store');
});