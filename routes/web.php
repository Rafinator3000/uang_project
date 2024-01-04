<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Lokasi_UangController;
use App\Http\Controllers\uang_masukController;
use App\Http\Controllers\uang_keluarController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('lokasi_uang', Lokasi_UangController::class);
Route::resource('uang_masuk', Uang_MasukController::class);
Route::resource('uang_keluar', Uang_KeluarController::class);

Route::get('uang_masuk-pdf', [Uang_MasukController::class,'exportPDF'])->name('uang_masuk-pdf');
Route::get('uang_keluar-pdf', [Uang_KeluarController::class,'exportPDF'])->name('uang_keluar-pdf');