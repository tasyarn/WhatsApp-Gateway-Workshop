<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    public function indexmanajemen()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $medicine = DB::table('medicines')->get();
        return view('manajemen.obat.index', [
            'companyname' => $companyname,
            'medicines' => $medicine,
        ]);
    }

    public function indexpegawai()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $medicine = DB::table('medicines')->get();
        return view('pegawai.obat.index', [
            'companyname' => $companyname,
            'medicines' => $medicine,
        ]);
    }

    public function store(Request $request)
    {
        $validate = [
            'nama_obat' => 'required',
            'harga_obat' => 'required',
            'stok_obat' => 'required'
        ];

        $medicine = $request->validate($validate);
        Medicine::create($medicine);
        return back()->with('pesan', 'Obat berhasil ditambahkan');
    }

    public function ubah(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'status' => 'required',
        ]);
        $id = $request->input('id');
        $updatemedicine = Medicine::where(['id' => $id])->update([
            'nama_obat' => $request->input('nama'),
            'harga_obat' => $request->input('harga'),
            'stok_obat' => $request->input('stok'),
            'status_obat' => $request->input('status'),
        ]);

        return back()->with('pesan', 'Obat berhasil diubah');
    }
}
