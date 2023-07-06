<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\templatePesan;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\User;
use App\Models\Setting;
use App\Models\Member;
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

    public function inputpegawai()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        // $jumlahuser = User::all()->where('role', 1)->count();
        // $jumlahcampaign = Campaign::all()->count();
        // $jumlahdanaterkumpul = Transaksi::all()->where('status_transaksi', 1)->sum('nominal_transaksi');
        // $nominalterbanyak = Transaksi::with('user')->select('user_id', DB::raw('max(nominal_transaksi) as max'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('nominal_transaksi', 'desc')->limit(5)->get();
        // // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('sum(nominal_transaksi) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('count(*) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        return view('manajemen.inputpegawai', [
            'companyname' => $companyname,
            // 'jumlahuser' => $jumlahuser,
            // 'jumlahcampaign' => $jumlahcampaign,
            // 'jumlahdanaterkumpul' => $jumlahdanaterkumpul,
            // 'nominalterbanyak' => $nominalterbanyak,
            // 'donasiterbanyak' => $donasiterbanyak,
        ]);
    }
    public function editpegawai()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        // $jumlahuser = User::all()->where('role', 1)->count();
        // $jumlahcampaign = Campaign::all()->count();
        // $jumlahdanaterkumpul = Transaksi::all()->where('status_transaksi', 1)->sum('nominal_transaksi');
        // $nominalterbanyak = Transaksi::with('user')->select('user_id', DB::raw('max(nominal_transaksi) as max'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('nominal_transaksi', 'desc')->limit(5)->get();
        // // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('sum(nominal_transaksi) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('count(*) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        return view('manajemen.editpegawai', [
            'companyname' => $companyname,
            // 'jumlahuser' => $jumlahuser,
            // 'jumlahcampaign' => $jumlahcampaign,
            // 'jumlahdanaterkumpul' => $jumlahdanaterkumpul,
            // 'nominalterbanyak' => $nominalterbanyak,
            // 'donasiterbanyak' => $donasiterbanyak,
        ]);
    }

    public function templatemanajemen()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $templates = templatePesan::all();
        return view('manajemen.template', [
            'companyname' => $companyname,
            'templates' => $templates
        ]);
    }



    public function indexchat()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $chats = Chat::all();

        return view('manajemen.chat', [
            'companyname' => $companyname,
            'chats'=>$chats
        ]);
    }

    public function pegawaimanajemen()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        // $jumlahuser = User::all()->where('role', 1)->count();
        // $jumlahcampaign = Campaign::all()->count();
        // $jumlahdanaterkumpul = Transaksi::all()->where('status_transaksi', 1)->sum('nominal_transaksi');
        // $nominalterbanyak = Transaksi::with('user')->select('user_id', DB::raw('max(nominal_transaksi) as max'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('nominal_transaksi', 'desc')->limit(5)->get();
        // // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('sum(nominal_transaksi) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('count(*) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        return view('manajemen.pegawai', [
            'companyname' => $companyname,
            // 'jumlahuser' => $jumlahuser,
            // 'jumlahcampaign' => $jumlahcampaign,
            // 'jumlahdanaterkumpul' => $jumlahdanaterkumpul,
            // 'nominalterbanyak' => $nominalterbanyak,
            // 'donasiterbanyak' => $donasiterbanyak,
        ]);
    }

    public function indexpegawai()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        // $jumlahuser = User::all()->where('role', 1)->count();
        // $jumlahcampaign = Campaign::all()->count();
        // $jumlahdanaterkumpul = Transaksi::all()->where('status_transaksi', 1)->sum('nominal_transaksi');
        // $nominalterbanyak = Transaksi::with('user')->select('user_id', DB::raw('max(nominal_transaksi) as max'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('nominal_transaksi', 'desc')->limit(5)->get();
        // // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('sum(nominal_transaksi) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('count(*) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();

        return view('pegawai.index', [
            'companyname' => $companyname,
            // 'jumlahuser' => $jumlahuser,
            // 'jumlahcampaign' => $jumlahcampaign,
            // 'jumlahdanaterkumpul' => $jumlahdanaterkumpul,
            // 'nominalterbanyak' => $nominalterbanyak,
            // 'donasiterbanyak' => $donasiterbanyak,
        ]);
    }

    public function memberpegawai()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        // $jumlahuser = User::all()->where('role', 1)->count();
        // $jumlahcampaign = Campaign::all()->count();
        // $jumlahdanaterkumpul = Transaksi::all()->where('status_transaksi', 1)->sum('nominal_transaksi');
        // $nominalterbanyak = Transaksi::with('user')->select('user_id', DB::raw('max(nominal_transaksi) as max'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('nominal_transaksi', 'desc')->limit(5)->get();
        // // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('sum(nominal_transaksi) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('count(*) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();

        return view('pegawai.member', [
            'companyname' => $companyname,
            // 'jumlahuser' => $jumlahuser,
            // 'jumlahcampaign' => $jumlahcampaign,
            // 'jumlahdanaterkumpul' => $jumlahdanaterkumpul,
            // 'nominalterbanyak' => $nominalterbanyak,
            // 'donasiterbanyak' => $donasiterbanyak,
        ]);
    }

    public function dataobat()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        // $jumlahuser = User::all()->where('role', 1)->count();
        // $jumlahcampaign = Campaign::all()->count();
        // $jumlahdanaterkumpul = Transaksi::all()->where('status_transaksi', 1)->sum('nominal_transaksi');
        // $nominalterbanyak = Transaksi::with('user')->select('user_id', DB::raw('max(nominal_transaksi) as max'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('nominal_transaksi', 'desc')->limit(5)->get();
        // // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('sum(nominal_transaksi) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('count(*) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();

        return view('pegawai.obat', [
            'companyname' => $companyname,
            // 'jumlahuser' => $jumlahuser,
            // 'jumlahcampaign' => $jumlahcampaign,
            // 'jumlahdanaterkumpul' => $jumlahdanaterkumpul,
            // 'nominalterbanyak' => $nominalterbanyak,
            // 'donasiterbanyak' => $donasiterbanyak,
        ]);
    }

    public function editobat()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        // $jumlahuser = User::all()->where('role', 1)->count();
        // $jumlahcampaign = Campaign::all()->count();
        // $jumlahdanaterkumpul = Transaksi::all()->where('status_transaksi', 1)->sum('nominal_transaksi');
        // $nominalterbanyak = Transaksi::with('user')->select('user_id', DB::raw('max(nominal_transaksi) as max'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('nominal_transaksi', 'desc')->limit(5)->get();
        // // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('sum(nominal_transaksi) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('count(*) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();

        return view('pegawai.editobat', [
            'companyname' => $companyname,
            // 'jumlahuser' => $jumlahuser,
            // 'jumlahcampaign' => $jumlahcampaign,
            // 'jumlahdanaterkumpul' => $jumlahdanaterkumpul,
            // 'nominalterbanyak' => $nominalterbanyak,
            // 'donasiterbanyak' => $donasiterbanyak,
        ]);
    }

    public function chat()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        // $jumlahuser = User::all()->where('role', 1)->count();
        // $jumlahcampaign = Campaign::all()->count();
        // $jumlahdanaterkumpul = Transaksi::all()->where('status_transaksi', 1)->sum('nominal_transaksi');
        // $nominalterbanyak = Transaksi::with('user')->select('user_id', DB::raw('max(nominal_transaksi) as max'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('nominal_transaksi', 'desc')->limit(5)->get();
        // // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('sum(nominal_transaksi) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('count(*) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();

        return view('pegawai.chat', [
            'companyname' => $companyname,
            // 'jumlahuser' => $jumlahuser,
            // 'jumlahcampaign' => $jumlahcampaign,
            // 'jumlahdanaterkumpul' => $jumlahdanaterkumpul,
            // 'nominalterbanyak' => $nominalterbanyak,
            // 'donasiterbanyak' => $donasiterbanyak,
        ]);
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
        $user->no = $request->input('nouser');

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
}
