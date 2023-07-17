<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DetailTransactionController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\MemberController;

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

Route::get('/', [AuthController::class, "indexlogin"]);
Route::get('/login', [AuthController::class, "indexlogin"])->name('login');
Route::post('/login', [AuthController::class, "login"]);

Route::get('/lupa-password', [AuthController::class, "indexlupapassword"]);
Route::post('/kirim-password-baru', [AuthController::class, "kirimpasswordbaru"]);

Route::match(['get', 'post'], '/fonnte-webhook', [ChatController::class, "ambilchat"]);

/* Dashboard Manajemen */
Route::group(['middleware' => ['auth', 'role:0']], function () {
    Route::get('/manajemen', [DashboardController::class, "indexmanajemen"]);
    Route::get('/manajemen/detail', [DashboardController::class, "detailmanajemen"]);
    Route::get('/manajemen/setting', [DashboardController::class, "indexsetting"]);
    Route::get('/manajemen/chat/', [ChatController::class, "indexchatmanajemen"]);
    Route::get('/manajemen/chat/{nopenerima}', [ChatController::class, "chatmembermanajemen"]);
    Route::get('/manajemen/chat-template', [ChatController::class, "indextemplatechatmanajemen"]);
    Route::post('/manajemen/chat-template/store', [ChatController::class, "store"]);
    Route::post('/manajemen/chat-template/ubah', [ChatController::class, "ubah"]);
    Route::post('/manajemen/chat-template/hapus', [ChatController::class, "hapus"]);
    Route::get('/manajemen/obat', [MedicineController::class, "indexmanajemen"]);
    Route::post('/manajemen/obat/store', [MedicineController::class, "store"]);
    Route::post('/manajemen/obat/ubah', [MedicineController::class, "ubah"]);
    Route::get('/manajemen/pegawai', [PegawaiController::class, "indexmanajemen"]);
    Route::post('/manajemen/pegawai/store', [PegawaiController::class, "store"]);
    Route::post('/manajemen/pegawai/ubah', [PegawaiController::class, "ubah"]);
    Route::get('/manajemen/member', [MemberController::class, "indexmanajemen"]);
    Route::get('/manajemen/member/ubah/{id}', [MemberController::class, "editmembermanajemen"]);
    Route::post('/manajemen/member/store', [MemberController::class, "store"]);
    Route::post('/manajemen/member/ubah', [MemberController::class, "ubah"]);
    Route::post('/manajemen/member/ubah-obat', [MemberController::class, "ubahobat"]);
    Route::get('/manajemen/rekap-pembelian', [TransactionController::class, "indexmanajemen"]);
    Route::get('/manajemen/rekap-pembelian/{token}',  [DetailTransactionController::class, "detailtransaksimanajemen"]);
});

Route::group(['middleware' => ['auth', 'role:1']], function () {
    Route::get('/pegawai', [DashboardController::class, "indexpegawai"]);
    Route::get('/pegawai/detail', [DashboardController::class, "detailpegawai"]);
    Route::get('/pegawai/chat/', [ChatController::class, "indexchatpegawai"]);
    Route::get('/pegawai/chat/{nopenerima}', [ChatController::class, "chatmemberpegawai"]);
    Route::get('/pegawai/obat', [MedicineController::class, "indexpegawai"]);
    Route::post('/pegawai/obat/store', [MedicineController::class, "store"]);
    Route::post('/pegawai/obat/ubah', [MedicineController::class, "ubah"]);
    Route::get('/pegawai/member', [MemberController::class, "indexpegawai"]);
    Route::get('/pegawai/member/ubah/{id}', [MemberController::class, "editmemberpegawai"]);
    Route::post('/pegawai/member/store', [MemberController::class, "store"]);
    Route::post('/pegawai/member/ubah', [MemberController::class, "ubah"]);
    Route::post('/pegawai/member/ubah-obat', [MemberController::class, "ubahobat"]);
    Route::get('/pegawai/pembelian', [TransactionController::class, "indexpegawai"]);
    Route::get('/pegawai/pembelian/create', [TransactionController::class, "create"]);
    Route::post('/pegawai/pembelian/store', [TransactionController::class, "store"]);
    Route::get('/pegawai/pembelian/{token}',  [DetailTransactionController::class, "detailtransaksipegawai"]);
    // Route::post('/pegawai/chat/kirim', [ChatController::class, "kirimchat"]);
});

Route::group(['middleware' => ['auth', 'role:0,1']], function () {
    Route::get('/profil', [DashboardController::class, "profil"]);
    Route::post('/update-profil', [DashboardController::class, "updateprofile"]);
    Route::post('/update-password', [DashboardController::class, "updatepassword"]);
    Route::post('/update-setting', [DashboardController::class, "updatesetting"]);
    Route::post('/logout', [AuthController::class, "logout"]);
});
