<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function indexmanajemen()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        return view('manajemen.index', [
            'companyname' => $companyname,
        ]);
    }

    public function indexsetting()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $nopenerima = $setting->no_penerima_pesan;
        $tokenfonnte = $setting->token_fonnte;

        return view('manajemen.setting', [
            'companyname' => $companyname,
            'nopenerima' => $nopenerima,
            'tokenfonnte' => $tokenfonnte,
        ]);
    }

    public function detailmanajemen(Request $request)
    {
        if (!$request['page']) {
            return redirect('/manajemen');
        }

        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;

        switch ($request['page']) {
            case 'keaktifan-pegawai':
                $users = User::where('role', 1)->pluck('nama')->toArray();
                $pegawaiData = User::where('role', 1)->get();
                $totalchat = Chat::count();

                // Inisialisasi array untuk pegawai yang tidak pernah menghubungi pelanggan
                $pegawaiTidakAktif = [];

                // Inisialisasi array untuk persentase keaktifan per pegawai
                $pegawaiPersentase = [];

                // nomer yg pernah menghubungi pelanggan
                $pegawaiPersentaseNumber = [];

                //total
                $hasil = [];

                $hasilannual = [];

                $year = date('Y');
                $month = date('m');

                //monthly
                foreach ($pegawaiData as $pegawai) {

                    $jumlahKontak = Chat::where('no_pengirim', $pegawai->no)
                        ->whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->count();

                    if ($jumlahKontak > 0) {
                        // Hitung persentase keaktifan
                        $persentase = round(($jumlahKontak / $totalchat) * 100, 2);
                        $pegawaiPersentaseNumber[] = $pegawai->no;
                        $pegawaiPersentase[$pegawai->no] = $persentase;
                    } else {
                        // Pegawai tidak pernah menghubungi pelanggan
                        $pegawaiTidakAktif[$pegawai->no] = 0;
                    }
                }

                foreach ($pegawaiData as $key => $pegawai) {
                    if (in_array($pegawai->no, $pegawaiPersentaseNumber)) {
                        $hasil[$key] = $pegawaiPersentase[$pegawai->no];
                    } else {
                        $hasil[$key] = 0;
                    }
                }

                //annual
                foreach ($pegawaiData as $pegawai) {

                    $jumlahKontak = Chat::where('no_pengirim', $pegawai->no)
                        ->whereYear('created_at', $year)
                        ->count();

                    if ($jumlahKontak > 0) {
                        // Hitung persentase keaktifan
                        $persentase = round(($jumlahKontak / $totalchat) * 100, 2);
                        $pegawaiPersentaseNumber[] = $pegawai->no;
                        $pegawaiPersentase[$pegawai->no] = $persentase;
                    } else {
                        // Pegawai tidak pernah menghubungi pelanggan
                        $pegawaiTidakAktif[$pegawai->no] = 0;
                    }
                }

                foreach ($pegawaiData as $key => $pegawai) {
                    if (in_array($pegawai->no, $pegawaiPersentaseNumber)) {
                        $hasilannual[$key] = $pegawaiPersentase[$pegawai->no];
                    } else {
                        $hasilannual[$key] = 0;
                    }
                }


                return view('manajemen.detail.keaktifan-pegawai', [
                    'companyname' => $companyname,
                    'title' => 'Keaktifan Pegawai',
                    'users' => array_values($users),
                    'chartdataset' => array_values($hasil),
                    'chartdatasetannual' => array_values($hasilannual),

                ]);
                break;
            case 'jumlah-pasien':
                //data dalam bulan
                $year = date('Y'); // Tahun yang ingin dicari

                $months = range(1, 12);
                $resultmonth = [];

                foreach ($months as $month) {
                    $count = DB::table('members')
                        ->whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->count();

                    $resultmonth[] = $count;
                }

                //data dalam tahun
                $data = DB::table('members')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
                    ->whereYear('created_at', '>=', date('Y') - 4) // Mendapatkan data dalam lima tahun terakhir
                    ->groupBy(DB::raw('YEAR(created_at)'))
                    ->orderBy(DB::raw('YEAR(created_at)'))
                    ->pluck('count', 'year')
                    ->toArray();

                $startYear = date('Y') - 4; // Mulai dari lima tahun yang lalu
                $endYear = date('Y');

                $years = range($startYear, $endYear);
                $resultannual = [];

                foreach ($years as $year) {
                    $count = isset($data[$year]) ? $data[$year] : 0;
                    $resultannual[] = $count;
                }
                return view('manajemen.detail.jumlah-pasien', [
                    'companyname' => $companyname,
                    'title' => 'Jumlah Pasien',
                    'chartdatasetmonthly' => array_values($resultmonth),
                    'chartdatasetannual' => array_values($resultannual)
                ]);
                break;
            case 'jumlah-transaksi':
                //data tiap bulan
                $year = date('Y'); // Tahun yang ingin dicari
                $months = range(1, 12);
                $resultmonth = [];

                foreach ($months as $month) {
                    $count = DB::table('transactions')
                        ->whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->count();

                    $resultmonth[] = $count;
                }

                //data dalam tahun
                $data = DB::table('transactions')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
                    ->whereYear('created_at', '>=', date('Y') - 4) // Mendapatkan data dalam lima tahun terakhir
                    ->groupBy(DB::raw('YEAR(created_at)'))
                    ->orderBy(DB::raw('YEAR(created_at)'))
                    ->pluck('count', 'year')
                    ->toArray();

                $startYear = date('Y') - 4; // Mulai dari lima tahun yang lalu
                $endYear = date('Y');

                $years = range($startYear, $endYear);
                $resultannual = [];

                foreach ($years as $year) {
                    $count = isset($data[$year]) ? $data[$year] : 0;
                    $resultannual[] = $count;
                }

                return view('manajemen.detail.jumlah-transaksi', [
                    'companyname' => $companyname,
                    'title' => 'Jumlah Transaksi',
                    'chartdatasetmonthly' => array_values($resultmonth),
                    'chartdatasetannual' => array_values($resultannual)

                ]);
                break;
            case 'response-time':
                return view('manajemen.detail.response-time', [
                    'companyname' => $companyname,
                    'title' => 'Response Time'

                ]);
                break;
            default:
                return redirect('/manajemen');
                break;
        }
    }

    public function updatesetting(Request $request)
    {
        $request->validate([
            'namaperusahaan' => 'required|string',
        ]);

        if ($request['nopenerima'] != null) {
            $request->validate([
                'nopenerima' => 'numeric',
            ]);
        }

        if ($request['tokenfonnte'] != null) {
            $request->validate([
                'tokenfonnte' => 'string',
            ]);
        }

        $company = Setting::findOrFail(1);
        $company->nama_perusahaan = $request->input('namaperusahaan');
        $company->no_penerima_pesan = $request->input('nopenerima');
        $company->token_fonnte = $request->input('tokenfonnte');

        $company->save();
        return back()->with('pesan', 'Setting website berhasil diperbarui');
    }

    public function indexpegawai()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;

        return view('pegawai.index', [
            'companyname' => $companyname,
        ]);
    }

    public function detailpegawai(Request $request)
    {
        if (!$request['page']) {
            return redirect('/pegawai');
        }

        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;

        switch ($request['page']) {
            case 'keaktifan-pegawai':
                $users = User::where('role', 1)->pluck('nama')->toArray();
                $pegawaiData = User::where('role', 1)->get();
                $totalchat = Chat::count();
                $no_telp = User::where('id', Auth::id())->pluck('no')->all();

                // Inisialisasi array untuk pegawai yang tidak pernah menghubungi pelanggan
                $pegawaiTidakAktif = [];

                // Inisialisasi array untuk persentase keaktifan per pegawai
                $pegawaiPersentase = 0;

                // nomer yg pernah menghubungi pelanggan
                $pegawaiPersentaseNumber = 0;

                //total
                $hasil = [];

                $hasilannual = [];

                $year = date('Y');
                $month = date('m');

                //monthly

                $jumlahKontak = Chat::where('no_pengirim', $no_telp[0])
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count();

                // dd($jumlahKontak);
                if ($jumlahKontak > 0) {
                    // Hitung persentase keaktifan
                    $persentase = round(($jumlahKontak / $totalchat) * 100, 2);
                    $pegawaiPersentase = $persentase;
                }


                $hasil[0] = $pegawaiPersentase;

                //annual

                $jumlahKontak = Chat::where('no_pengirim', $no_telp[0])
                    ->whereYear('created_at', $year)
                    ->count();

                if ($jumlahKontak > 0) {
                    // Hitung persentase keaktifan
                    $persentase = round(($jumlahKontak / $totalchat) * 100, 2);
                    $pegawaiPersentaseNumber = $no_telp;
                    $pegawaiPersentase = $persentase;
                }

                $hasilannual[0] = $pegawaiPersentase;


                return view('pegawai.detail.keaktifan-pegawai', [
                    'companyname' => $companyname,
                    'title' => 'Keaktifan Pegawai',
                    'users' => array_values($pegawaiData = User::where('no', $no_telp)->pluck('nama')->all()),
                    'chartdataset' => array_values($hasil),
                    'chartdatasetannual' => array_values($hasilannual),

                ]);
                break;
            case 'jumlah-pasien':
                //data dalam bulan
                $year = date('Y'); // Tahun yang ingin dicari

                $months = range(1, 12);
                $resultmonth = [];
                $user_id = Auth::id();

                foreach ($months as $month) {
                    $count = DB::table('members')
                        ->where('id_users', $user_id)
                        ->whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->count();

                    $resultmonth[] = $count;
                }

                //data dalam tahun
                $data = DB::table('members')
                    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
                    ->where('id_users', $user_id)
                    ->whereYear('created_at', '>=', date('Y') - 4) // Mendapatkan data dalam lima tahun terakhir
                    ->groupBy(DB::raw('YEAR(created_at)'))
                    ->orderBy(DB::raw('YEAR(created_at)'))
                    ->pluck('count', 'year')
                    ->toArray();

                $startYear = date('Y') - 4; // Mulai dari lima tahun yang lalu
                $endYear = date('Y');

                $years = range($startYear, $endYear);
                $resultannual = [];

                foreach ($years as $year) {
                    $count = isset($data[$year]) ? $data[$year] : 0;
                    $resultannual[] = $count;
                }
                return view('pegawai.detail.jumlah-pasien', [
                    'companyname' => $companyname,
                    'title' => 'Jumlah Pasien',
                    'chartdatasetmonthly' => array_values($resultmonth),
                    'chartdatasetannual' => array_values($resultannual)
                ]);
                break;
            // case 'jumlah-transaksi':
            //     //data tiap bulan
            //     $year = date('Y'); // Tahun yang ingin dicari
            //     $months = range(1, 12);
            //     $resultmonth = [];
            //     $user_id = Auth::id();

            //     foreach ($months as $month) {
            //         $count = DB::table('transactions')
            //             ->where('id_users', $user_id)
            //             ->whereYear('created_at', $year)
            //             ->whereMonth('created_at', $month)
            //             ->count();

            //         $resultmonth[] = $count;
            //     }

            //     //data dalam tahun
            //     $data = DB::table('transactions')
            //         ->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            //         ->where('id_users', $user_id)
            //         ->whereYear('created_at', '>=', date('Y') - 4) // Mendapatkan data dalam lima tahun terakhir
            //         ->groupBy(DB::raw('YEAR(created_at)'))
            //         ->orderBy(DB::raw('YEAR(created_at)'))
            //         ->pluck('count', 'year')
            //         ->toArray();

            //     $startYear = date('Y') - 4; // Mulai dari lima tahun yang lalu
            //     $endYear = date('Y');

            //     $years = range($startYear, $endYear);
            //     $resultannual = [];

            //     foreach ($years as $year) {
            //         $count = isset($data[$year]) ? $data[$year] : 0;
            //         $resultannual[] = $count;
            //     }

            //     return view('pegawai.detail.jumlah-transaksi', [
            //         'companyname' => $companyname,
            //         'title' => 'Jumlah Transaksi',
            //         'chartdatasetmonthly' => array_values($resultmonth),
            //         'chartdatasetannual' => array_values($resultannual)
            //     ]);
            //     break;
            default:
                return redirect('/pegawai');
                break;
        }
    }

    public function profil()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;

        return view('profil', [
            'companyname' => $companyname,
        ]);
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nouser' => 'required|numeric'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->nama = $request->input('nama');
        $checkno = User::where('no', $request->input('nouser'))->first();
        if ($checkno != null) {
            if ($checkno->id == Auth::user()->id) {
                $user->no = $request->input('nouser');
            } else {
                return back()->with('salah', 'No telepon duplikat');
            }
        } else {
            $user->no = $request->input('nouser');
        }

        $user->save();
        return back()->with('pesan', 'Profil berhasil diperbarui');
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
            'password_baru' => 'required|string|min:8',
            'konfirmasi_password' => 'required'
        ]);

        $user = User::findOrFail(Auth::user()->id);
        if (!is_null($request->input('password') & $request->input('password_baru') & $request->input('konfirmasi_password'))) {
            if (Hash::check($request->input('password'), $user->password)) {
                $user->password = Hash::make($request->input('password_baru'));
            } else {
                return redirect()->back()->withInput()->with('salah', 'Password sekarang tidak cocok dengan akun Anda');
            }
        }

        $user->save();
        return back()->with('pesan', 'Kata sandi berhasil diperbarui');
    }
}
