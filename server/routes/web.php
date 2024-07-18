<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReleveController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::resource('/clients', ClientController::class);

Route::resource('/users', UserController::class);
Route::patch('/users/{id}', [UserController::class, 'updateEtat']);
Route::post('/users/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

Route::resource('/ports', PortController::class);

Route::resource('/postes', PosteController::class);

Route::resource('/regions', RegionController::class);

Route::resource('/releves', ReleveController::class);

Route::resource('/factures', FactureController::class);

Route::resource('/prestations', PrestationController::class);