<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    //
    public function rekap_pembelian()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $pembelian = DB::table('transactions as t')
        ->join('detail_transactions as dt','dt.transaction_id','=','t.id')
        ->join('medicines as m','m.id','=','dt.id_medicines')
        ->join('members as mb','mb.id','=','t.id_users')
        ->select('mb.nama_member','m.nama_obat','t.created_at','m.harga_obat','dt.sub_total')
        ->get();
        return view('manajemen.rekap-pembelian',compact('companyname','pembelian'));
    }
}
