<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReleveController;
use App\Http\Controllers\UserController;
use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
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

Route::get('/', function(){
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'role:admin'])->group(function(){
    Route::get('/admin-dashboard', function () {
        return view('admin-dashboard');
    })->name('admin.dashboard');
    
    Route::patch('/users/{id}', [UserController::class, 'updateEtat']);
    Route::delete('/users/delete/{id}', [UserController::class, 'deleteUser']);
    Route::resource('/regions', RegionController::class);
    Route::resource('/ports', PortController::class);
});

Route::middleware(['auth:sanctum', 'role:finance,admin'])->group(function () {
    Route::get('/finance-dashboard', function () {
        return view('finance-dashboard');
    })->name('finance.dashboard');
    // Toutes les routes de ressource pour les clients
    Route::resource('/clients', ClientController::class)->except('index','show');
    Route::resource('/postes', PosteController::class);
    Route::get('/factures/encaisser/{id}', [FactureController::class, 'showEncaisserForm'])->name('factures.encaisser.form');
    Route::post('/factures/encaisser/{id}', [FactureController::class, 'encaisser'])->name('factures.encaisser');
    Route::get('/clients', [ClientController::class, 'index']);
    Route::get('/clients/{id}', [ClientController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'role:infra,admin'])->group(function () {
    Route::get('/infra-dashboard', function () {
        return view('infra-dashboard');
    })->name('infra.dashboard');
    Route::resource('/releves', ReleveController::class);
});

Route::middleware(['auth:sanctum', 'role:facturation,admin'])->group(function () {
    Route::get('/facturation-dashboard', function () {
        return view('facturation-dashboard');
    })->name('facturation.dashboard');
    Route::resource('/factures', FactureController::class)->except('index','show');
    Route::get('/factures/annuler/{id}', [FactureController::class, 'showAnnulerForm'])->name('factures.showAnnulerForm');
    Route::post('/factures/annuler/{id}', [FactureController::class, 'annuler'])->name('factures.annuler');
    Route::get('factures/{id}/download', [FactureController::class, 'downloadPDF'])->name('factures.downloadPDF');
});

// Route index accessible aux administrateurs et aux finance
// Route::middleware(['auth:sanctum', 'role:admin,finance'])->group(function(){
//     Route::get('/clients', [ClientController::class, 'index']);
//     Route::get('/clients/{id}', [ClientController::class, 'show']);
// });

Route::middleware(['auth:sanctum', 'role:facturation, finance, admin'])->resource('/prestations', PrestationController::class);
Route::middleware(['auth:sanctum', 'role:admin,finance,facturation'])->group(function(){
    Route::get('/factures', [FactureController::class, 'index'])->name('factures.index');
    Route::get('/factures/annulees', [FactureController::class, 'indexAnnulee'])->name('factures.annulees');
    Route::get('/factures/{id}', [FactureController::class, 'show']);
});

Route::resource('/users', UserController::class);