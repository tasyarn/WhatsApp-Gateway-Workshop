<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailTransactionController extends Controller
{
    public function detailtransaksimanajemen($token)
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;

        if (!Transaction::where('token', '=', $token)->exists()) {
            return back()->with('salah', 'Token tidak tersedia');
        }

        $user = User::where('id', Auth::user()->id)->get();
        if ($user[0]['role'] != 0) {
            $transaksi = Transaction::where('token', $token)->get();
            if (Auth::user()->id != $transaksi[0]['id_users']) {
                return back()->with('salah', 'Transaksi tidak tersedia');
            }
        }

        $transaction = DB::table('transactions')->join('members', 'transactions.id_member', '=', 'members.id')->join('users', 'transactions.id_users', '=', 'users.id')->where('token', request()->token)->select('transactions.*', 'users.nama', 'members.nama_member', 'members.no_member', 'members.alamat_member')->get();
        $detailtransaction = DB::table('detail_transactions')->join('medicines', 'detail_transactions.id_medicines', '=', 'medicines.id')->where('detail_transactions.token', request()->token)->get();

        return view('manajemen.pembelian.detail', [
            'companyname' => $companyname,
            'transaction' => $transaction,
            'detailtransactions' => $detailtransaction,
        ]);
    }

    public function detailtransaksipegawai($token)
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;

        if (!Transaction::where('token', '=', $token)->exists()) {
            return back()->with('salah', 'Token tidak tersedia');
        }

        $user = User::where('id', Auth::user()->id)->get();
        if ($user[0]['role'] != 0) {
            $transaksi = Transaction::where('token', $token)->get();
            if (Auth::user()->id != $transaksi[0]['id_users']) {
                return back()->with('salah', 'Transaksi tidak tersedia');
            }
        }

        $transaction = DB::table('transactions')->join('members', 'transactions.id_member', '=', 'members.id')->where('token', request()->token)->select('transactions.*', 'members.nama_member', 'members.no_member', 'members.alamat_member')->get();
        $detailtransaction = DB::table('detail_transactions')->join('medicines', 'detail_transactions.id_medicines', '=', 'medicines.id')->where('detail_transactions.token', request()->token)->get();

        return view('pegawai.pembelian.detail', [
            'companyname' => $companyname,
            'transaction' => $transaction,
            'detailtransactions' => $detailtransaction,
        ]);
    }
}
