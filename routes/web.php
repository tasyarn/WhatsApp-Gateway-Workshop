<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\templatePesanController;

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
    // Route::get('/manajemen/inputpegawai', [DashboardController::class, "inputpegawai"]);
    Route::put('/manajemen/pegawai/{id}', [DashboardController::class, "editpegawai"]);
    Route::post('/manajemen/inputpegawai', [DashboardController::class, "inputpegawai"]);

    Route::get('/manajemen/member', [MemberController::class, "index"]);
    Route::post('/manajemen/member/tambah-pegawai-ke-pasien', [MemberController::class, "store"]);
    Route::post('/manajemen/kirim-data-pasien', [DashboardController::class, "datapasienpost"]);

    //chat-tasya
    Route::get('/manajemen/chat-template', [DashboardController::class, "templatemanajemen"]);
    Route::get('/manajemen/add-template', [templatePesanController::class, "create"]);
    Route::post('/manajemen/storeChat', [templatePesanController::class, "store"]);
    Route::post('/update-template', [templatePesanController::class, "update"]);
    Route::get('/manajemen/chat', [DashboardController::class, "indexchat"]);

    Route::get('/manajemen/setting', [DashboardController::class, "indexsetting"]);

    //obat-sabrina
    Route::get('/manajemen/obat', [DashboardController::class, "indexobat"]);
    Route::get('/manajemen/add-obat', [DashboardController::class, "createObat"]);
    Route::post('/manajemen/storeObat', [DashboardController::class, "storeObat"]);
    Route::post('/update-obat', [DashboardController::class, "updateObat"]);
    Route::put('/riwayat-obat/{id}/archive', 'DashboardController@archive');
});

Route::group(['middleware' => ['auth', 'role:1']], function () {
    Route::get('/pegawai', [DashboardController::class, "indexpegawai"]);
    Route::get('/pegawai/member', [DashboardController::class, "memberpegawai"]);


    Route::get('/pegawai/obat', [DashboardController::class, "dataobat"]);
    Route::get('/pegawai/editobat', [DashboardController::class, "editobat"]);
    Route::get('/pegawai/chat', [DashboardController::class, "chat"]);
    Route::get('/pegawai/pembelian', [DashboardController::class, "pembelian"]);
});

Route::get('/manajemen/update-data-obat', function () {
    return view('/manajemen/update-data-obat');
});
