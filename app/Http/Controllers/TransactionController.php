<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Setting;
use App\Models\Medicine;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\DetailTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function indexmanajemen()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $transaction = DB::table('transactions')->join('members', 'transactions.id_member', '=', 'members.id')->join('users', 'transactions.id_users', '=', 'users.id')->select('transactions.*', 'members.nama_member', 'members.no_member', 'users.nama')->latest()->get();

        return view('manajemen.pembelian.index', [
            'companyname' => $companyname,
            'transactions' => $transaction,
        ]);
    }

    public function indexpegawai()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $member = Member::where('id_users', Auth::user()->id)->get();
        $transaction = DB::table('transactions')->join('members', 'transactions.id_member', '=', 'members.id')->where('transactions.id_users', Auth::user()->id)->select('transactions.*', 'members.nama_member', 'members.no_member')->latest()->get();
        return view('pegawai.pembelian.index', [
            'companyname' => $companyname,
            'members' => $member,
            'transactions' => $transaction,
        ]);
    }

    public function create(Request $request)
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;

        if (!$request['no_member']) {
            return back()->with('salah', 'Masukkan no member');
        }

        if (Member::where('no_member', $request['no_member'])->exists()) {
            $member = Member::where('no_member', $request['no_member'])->get();
            if (Auth::user()->id == $member[0]['id_users']) {
                // 'user ada dan sesuai';
                $detailmedicines = DB::table('detail_medicines')->join('medicines', 'detail_medicines.id_medicines', '=', 'medicines.id')->where('id_members', $member[0]['id'])->where('stok_obat', '>', '0' )->where('status_obat', '1' )->get();
                return view('pegawai.pembelian.create', [
                    'companyname' => $companyname,
                    // 'detailMedicines' => DetailMedicine::where('id_members', $member[0]['id'] )->get(),
                    'detailmedicines' => $detailmedicines,
                    'member' => $member,
                ]);
            } else {
                // 'user ada tp tidak sesuai';
                return back()->with('salah', 'Pastikan nomor telepon adalah member anda!');
            }
        } else {
            return back()->with('salah', 'Nomor telepon tidak ditemukan!');
        }
    }

    public function store(Request $request)
    {
        if (!$request['medicines']) {
            return back()->with('salah', 'Pilih Obat yang akan ditransaksikan');
        } else {

            $countMedicines = count($request->medicines);
            $dataSubHarga = [];

            for ($i = 0; $i < $countMedicines; $i++) {
                $medicine = Medicine::where('id', $request->medicines[$i])->get();
                $dataSubHarga[$i] = $medicine[0]['harga_obat'];
            }

            $totalHarga = $this->totalHarga($dataSubHarga);

            $token = sha1($request->no_member . now());
            $member = Member::where('no_member', $request['no_member'])->get();

            $validatedDataTransaction['token'] = $token;
            $validatedDataTransaction['id_users'] = Auth::user()->id;
            $validatedDataTransaction['id_member'] = $member[0]['id'];
            $validatedDataTransaction['total_harga'] = $totalHarga;
            $validatedDataTransaction['waktu_habis'] = now()->addDays($request->waktu_habis);
            $validatedDataTransaction['created_at'] = now();
            $validatedDataTransaction['updated_at'] = now();

            Transaction::create($validatedDataTransaction);

            $validatedDataDetailTransaction = [];
            for ($i = 0; $i < $countMedicines; $i++) {
                $medicine = Medicine::where('id', $request->medicines[$i])->first();

                $validatedDataDetailTransaction['token'] = $token;
                $validatedDataDetailTransaction['id_medicines'] = $request->medicines[$i];
                $validatedDataDetailTransaction['sub_total'] = $medicine->harga_obat;
                $validatedDataDetailTransaction['create_at'] = now();
                $validatedDataDetailTransaction['updated_at'] = now();

                // dd($validatedDataDetailTransaction);
                DetailTransaction::create($validatedDataDetailTransaction);

                $minstock = $medicine->stok_obat - 1;
                $medicine->update([
                    'stok_obat'     => $minstock,
                ]);
            }

            return back()->with('pesan', 'Transaksi berhasil ditambahkan');
        }
    }

    public function totalHarga($data)
    {
        $total = 0;
        for ($i = 0; $i < count($data); $i++) {
            $total = $total + $data[$i];
        }
        return $total;
    }

}
