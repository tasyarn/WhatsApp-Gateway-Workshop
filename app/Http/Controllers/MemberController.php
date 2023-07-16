<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Member;
use App\Models\User;
use App\Models\DetailMedicine;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function indexmanajemen()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $member = Member::with('user')->get();
        $pegawai = User::where('role', 1)->get();
        $medicine = Medicine::get();
        return view('manajemen.member.index', [
            'companyname' => $companyname,
            'member' => $member,
            'pegawai' => $pegawai,
            'medicine' => $medicine,
        ]);
    }

    public function indexpegawai()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $member = Member::where('id_users', Auth::user()->id)->get();
        $medicine = Medicine::get();
        return view('pegawai.member.index', [
            'companyname' => $companyname,
            'member' => $member,
            'medicine' => $medicine,
        ]);
    }

    public function editmembermanajemen($id)
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $member = Member::where('id', $id)->first();
        $detailmedicine = DetailMedicine::with('medicine')->where('id_members', $id)->get();
        $medicine = Medicine::get();
        $pegawai = User::where('role', 1)->get();
        if ($member != null) {
            return view('manajemen.member.edit', [
                'companyname' => $companyname,
                'member' => $member,
                'detailmedicine' => $detailmedicine,
                'medicine' => $medicine,
                'pegawai' => $pegawai,
            ]);
        } else {
            return redirect('/pegawai/member/')->with('salah', 'Bukan member Anda');
        }
    }

    public function editmemberpegawai($id)
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $member = Member::where('id_users', Auth::user()->id)->where('id', $id)->first();
        $detailmedicine = DetailMedicine::with('medicine')->where('id_members', $id)->get();
        $medicine = Medicine::get();
        if ($member != null) {
            return view('pegawai.member.edit', [
                'companyname' => $companyname,
                'member' => $member,
                'detailmedicine' => $detailmedicine,
                'medicine' => $medicine,
            ]);
        } else {
            return redirect('/pegawai/member/')->with('salah', 'Bukan member Anda');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_users' => 'required',
            'nama_member' => 'required|string',
            'no_member' => 'required|numeric',
            'alamat_member' => 'required|string',
            'medicines' => 'required'
        ]);

        $member['id_users'] = $request->id_users;
        $member['nama_member'] = $request->nama_member;
        $member['no_member'] = $request->no_member;
        $member['alamat_member'] = $request->alamat_member;

        $countMedicines = count($request->medicines);

        $checkno = Member::where('no_member', $request->input('no_member'))->first();
        if ($checkno != null) {
            return back()->with('salah', 'No telepon duplikat');
        } else {
            $createmember = Member::create($member);
            for ($i = 0; $i < $countMedicines; $i++) {
                $detailmedicine['id_members'] = $createmember->id;
                $detailmedicine['id_medicines'] = $request->medicines[$i];

                DetailMedicine::create($detailmedicine);
            }
        }

        return back()->with('pesan', 'Member berhasil ditambahkan');
    }

    public function ubah(Request $request)
    {
        $data = $request->validate([
            'iduser' => 'required',
            'id' => 'required',
            'namamember' => 'required|string',
            'nomember' => 'required|numeric',
            'alamatmember' => 'required',
        ]);
        $id = $request->input('id');
        $checkno = Member::where('no_member', $request->input('nomember'))->first();
        if ($checkno != null) {
            if ($checkno->id == $id) {
                $updatemember = Member::where(['id' => $id])->update([
                    'id_users' => $request->input('iduser'),
                    'nama_member' => $request->input('namamember'),
                    'no_member' => $request->input('nomember'),
                    'alamat_member' => $request->input('alamatmember'),
                ]);
            } else {
                return back()->with('salah', 'No telepon duplikat');
            }
        } else {
            $updatepegawai = Member::where(['id' => $id])->update([
                'id_users' => $request->input('iduser'),
                'nama_member' => $request->input('namamember'),
                'no_member' => $request->input('nomember'),
                'alamat_member' => $request->input('alamatmember'),
            ]);
        }

        return back()->with('pesan', 'Data Member berhasil diubah');
    }

    public function ubahobat(Request $request)
    {
        $data = $request->validate([
            'idmember' => 'required',
            'medicines' => 'required',
        ]);
        $id = $request->input('idmember');
        $countMedicines = count($request->medicines);
        $member = Member::where('id', $id)->first();
        if ($member != null) {
            $hapusdetailobat = DetailMedicine::where('id_members', $id)->delete();
            for ($i = 0; $i < $countMedicines; $i++) {
                $detailmedicine['id_members'] = $id;
                $detailmedicine['id_medicines'] = $request->medicines[$i];

                DetailMedicine::create($detailmedicine);
            }
        } else {
            return back()->with('salah', 'Member tidak ditemukan');
        }

        return back()->with('pesan', 'Data obat berhasil diubah');
    }
}
