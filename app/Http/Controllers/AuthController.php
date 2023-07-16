<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function indexlogin()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;

        return view('auth.login', [
            'companyname' => $companyname,
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

        if (Auth::attempt(array('no' => $nouser, 'password' => $password, 'role' => 0, 'status' => 1))) {
            $request->session()->regenerate();
            return redirect('/manajemen');
        } else if (Auth::attempt(array('no' => $nouser, 'password' => $password, 'role' => 1, 'status' => 1))) {
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

    public function indexlupapassword()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        return view('auth.lupa-password', [
            'companyname' => $companyname,
        ]);
    }


    public function kirimpasswordbaru(Request $request)
    {
        $setting = Setting::first();
        $tokenfonnte = $setting->token_fonnte;
        $request->validate([
            'no' => 'required|numeric|exists:users',
        ], [
            'no.exists' => 'Nomor tidak terdaftar.',
        ]);

        $randompassword = Str::random(8);
        $passwordbaru = DB::table('users')->where('no', $request->no)->update(['password' => Hash::make($randompassword)]);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $request->no,
                'message' => "Password baru Anda adalah *".$randompassword."*",
                // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
                // 'filename' => 'filename',
                'schedule' => '0',
                'typing' => false,
                'delay' => '2',
                'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$tokenfonnte
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return back()->with('sukses', 'Kami telah mengirim password baru Anda!');
    }
}
