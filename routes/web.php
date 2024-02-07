<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MozController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\SemrushController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MozController::class, 'index']);
Route::get('semrush', [SemrushController::class, 'index']);
