<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function indexmanajemen()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $pegawai = User::where('role', 1)->get();
        return view('manajemen.pegawai.index', [
            'companyname' => $companyname,
            'pegawai' => $pegawai,
        ]);
    }

    public function store(Request $request)
    {
        $pegawai = $request->validate([
            'nama' => 'required|string',
            'no' => 'required|numeric',
            'password' => 'required|string|min:8',
        ]);

        $pegawai['password'] = Hash::make($request->password);
        $pegawai['role'] = 1;
        $checkno = User::where('no', $request->input('no'))->first();
        if($checkno != null){
            return back()->with('salah', 'No telepon duplikat');
        } else{
            User::create($pegawai);
        }
        return back()->with('pesan', 'Pegawai berhasil ditambahkan');
    }

    public function ubah(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'nama' => 'required|string',
            'no' => 'required|numeric',
            'status' => 'required',
        ]);
        $id = $request->input('id');
        $checkno = User::where('no', $request->input('no'))->first();
        if($checkno != null){
            if($checkno->id == $id){
                $updatepegawai = User::where(['id' => $id])->update([
                    'nama' => $request->input('nama'),
                    'no' => $request->input('no'),
                    'status' => $request->input('status'),
                ]);
            } else{
                return back()->with('salah', 'No telepon duplikat');
            }
        }else{
            $updatepegawai = User::where(['id' => $id])->update([
                'nama' => $request->input('nama'),
                'no' => $request->input('no'),
                'status' => $request->input('status'),
            ]);
        }

        return back()->with('pesan', 'Pegawai berhasil diubah');
    }
}
