<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;

Route::get('login', [LoginController::class, 'index'])->name('.loginView');
Route::post('login', [LoginController::class, 'login'])->name('.login');
