<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\templatePesanController;
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


Route::get('/profil', [DashboardController::class, "profil"]);

Route::post('/update-profil', [DashboardController::class, "updateprofile"]);
Route::post('/update-password', [DashboardController::class, "updatepassword"]);

Route::get('/login', [AuthController::class, "indexlogin"]);
Route::post('/login', [AuthController::class, "login"]);
// Route::get('/cari', [LandingController::class, 'cari'])->name('cari');
Route::post('/logout', [AuthController::class, "logout"]);

/* Dashboard Manajemen */
Route::group(['middleware' => ['auth', 'role:0']], function () {
    Route::get('/manajemen', [DashboardController::class, "indexmanajemen"]);
    Route::get('/manajemen/pegawai', [DashboardController::class, "pegawaimanajemen"]);
    Route::get('/manajemen/inputpegawai', [DashboardController::class, "inputpegawai"]);
//     Route::get('/manajemen/chat', [DashboardController::class, "chatmanajemen"]);
// <<<<<<< Updated upstream
    Route::get('/manajemen/data-pasien', [DashboardController::class, "dataPasien"]);
    Route::post('/manajemen/kirim-data-pasien', [DashboardController::class, "datapasienpost"]);

    Route::get('/manajemen/template', [DashboardController::class, "templatemanajemen"]);
    Route::get('/addTemplate', [templatePesanController::class, "create"]);

    Route::get('/manajemen/chat', [DashboardController::class, "indexchat"]);
    Route::get('/manajemen/setting', [DashboardController::class, "indexsetting"]);
});

Route::group(['middleware' => ['auth', 'role:1']], function () {
    Route::get('/pegawai', [DashboardController::class, "indexpegawai"]);
    Route::get('/pegawai/member', [DashboardController::class, "memberpegawai"]);


    Route::get('/pegawai/obat', [DashboardController::class, "dataobat"]);
    Route::get('/pegawai/editobat', [DashboardController::class, "editobat"]);
    Route::get('/pegawai/chat', [DashboardController::class, "chat"]);
});

