<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;


Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'login'])->name('.loginView');
Route::get('login', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'login'])->name('.login');
