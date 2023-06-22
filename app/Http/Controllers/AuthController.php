<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexlogin()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        // $jumlahuser = User::all()->where('role', 1)->count();
        // $jumlahcampaign = Campaign::all()->count();
        // $jumlahdanaterkumpul = Transaksi::all()->where('status_transaksi', 1)->sum('nominal_transaksi');
        // $nominalterbanyak = Transaksi::with('user')->select('user_id', DB::raw('max(nominal_transaksi) as max'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('nominal_transaksi', 'desc')->limit(5)->get();
        // // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('sum(nominal_transaksi) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();
        // $donasiterbanyak = Transaksi::with('user')->select('user_id', DB::raw('count(*) as total'))->where('status_transaksi', 1)->groupBy('user_id')->orderBy('total', 'desc')->limit(5)->get();

        return view('auth.login', [
            'companyname' => $companyname,
            // 'jumlahuser' => $jumlahuser,
            // 'jumlahcampaign' => $jumlahcampaign,
            // 'jumlahdanaterkumpul' => $jumlahdanaterkumpul,
            // 'nominalterbanyak' => $nominalterbanyak,
            // 'donasiterbanyak' => $donasiterbanyak,
        ]);
    }

    public function login(Request $request)
    {

        $data = $request->validate([
            'nouser' => 'required|numeric',
            'password' => 'required|string'
        ]);

        $nouser = $data['nouser'];
        $password = $data['password'];

        if (Auth::attempt(array('no' => $nouser, 'password' => $password, 'role' => 0))) {
            $request->session()->regenerate();
            return redirect('/manajemen');
        } else if (Auth::attempt(array('no' => $nouser, 'password' => $password, 'role' => 1))) {
            $request->session()->regenerate();
            return redirect('/pegawai');
        }

        return redirect('/login')->with('salah', 'No Handphone atau kata sandi Anda salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
