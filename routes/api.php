<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProvinceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('auth/login', [LoginController::class, 'login'])->name('auth');
Route::middleware(['auth:api'])
    ->group(function () {
        Route::get('provinces', [ProvinceController::class, 'index']);
    });
