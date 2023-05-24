<?php

use App\Http\Controllers\PesertaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesertaDeleteController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     dd('aa');
//     return view('nilaiPeserta');
// });
Route::get('/', [AuthController::class, 'index']);
// LOGIN AUTH

// Route::get('nilaiPeserta', [AuthController::class, 'dashboard']); 
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('customLogin', [AuthController::class, 'authenticate']); 
Route::post('logout', [AuthController::class, 'logout']); 
Route::get('register', [AuthController::class, 'registration'])->name('register')->middleware('guest');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

// INDEX

// Route::get('/nilaiPeserta', [PesertaController::class,'nilaiPeserta'])->name('nilaiPeserta');
// Route::post('/nilaiPeserta/proses', [PesertaController::class,'proses']);
// Route::post('/nilaiPeserta/store', [PesertaController::class,'store'])->name('nilaiPeserta.store');

// Route::get('/nilaiPeserta/getById/{id}', [PesertaController::class, 'getDataById'])->name('data.getById');
Route::get('/nilaiPeserta/info/{id}', [PesertaController::class, 'getInfoById']);

// Route::post('/nilaiPeserta/{id}', [PesertaController::class, 'update']);
Route::get('/nilaiPeserta/{id}', [PesertaController::class, 'destroy'])->name('page.destroy');

Route::resource('nilaiPeserta', PesertaController::class)->middleware('auth');

// Route::resource('nilaiPeserta', AdminController::class)->except('show'); // ->middleware('admin')
