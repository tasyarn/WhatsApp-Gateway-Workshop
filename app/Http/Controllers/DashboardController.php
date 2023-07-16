<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\obat;
use App\Models\User;
use App\Models\Setting;
use App\Models\ChatTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function indexmanajemen()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        // Mendapatkan data per bulan
        $chatsPerMonth = DB::table('chats')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as total'))
            ->groupBy('month')
            ->get();

        // Mendapatkan data per tahun
        $chatsPerYear = DB::table('chats')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total'))
            ->groupBy('year')
            ->get();

        // Memisahkan data bulan dan jumlah pesan per bulan
        $months = $chatsPerMonth->pluck('month');
        $messageCountsPerMonth = $chatsPerMonth->pluck('total');

        // Memisahkan data tahun dan jumlah pesan per tahun
        $years = $chatsPerYear->pluck('year');
        $messageCountsPerYear = $chatsPerYear->pluck('total');

        return view('manajemen.index', [
            'companyname' => $companyname,
            'months' => $months,
            'messageCountsPerMonth' => $messageCountsPerMonth,
            'years' => $years,
            'messageCountsPerYear' => $messageCountsPerYear
        ]);
    }

    public function inputpegawai(Request $request)
    {
        $pegawai = new Pegawai;
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->no_pegawai = $request->no_pegawai;
        $pegawai->alamat_pegawai = $request->alamat_pegawai;
        $pegawai->save();
        return redirect('/manajemen/pegawai');
    }

    public function editpegawai(Request $request, $id)
    {
        $pegawaiedit = Pegawai::findOrFail($id);
        $pegawaiedit->nama_pegawai = $request->nama_pegawai;
        $pegawaiedit->no_pegawai = $request->no_pegawai;
        $pegawaiedit->alamat_pegawai = $request->alamat_pegawai;
        $pegawaiedit->status = $request->status;
        $pegawaiedit->save();
        return redirect('/manajemen/pegawai');
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
            $pegawai = User::where('role', 1)->get();
            return view('manajemen.pegawai.pegawai',[
                'companyname' => $companyname,
                'pegawai' => $pegawai
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

    public function indexobat()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $obats = obat::all();

        return view('manajemen.obat.data-obat', [
            'companyname' => $companyname,
            'obats' => $obats
        ]);
    }

    public function createObat()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;

        return view('manajemen.obat.add-obat', [
            'companyname' => $companyname,
        ]);
    }

    public function storeObat(Request $request)
    {
        $validatedData = $request->validate([
            'nama_obat'=> 'required',
            'harga_obat'=> 'required',
            'stok_obat'=> 'required'
        ]);

        $validatedData['ID_User'] = Auth::user()->id;
        obat::create($validatedData);
        $request->session()->flash('success', 'Data obat berhasil ditambahkan!');
        return redirect('/manajemen/obat');
    }

    public function updateObat(Request $request)
    {
        obat::find(request('ID_obat'))->update([
            'nama_obat' => request('nama_obat'),
            'harga_obat' => request('harga_obat'),
            'stok_obat' => request('stok_obat'),
            'status' => request('status')
        ]);

        Session::flash('success', 'Data obat successfully updated.');
        return back()->with('success', true);
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

    public function pembelian()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;

        return view('pegawai.pembelian.pembelian', [
            'companyname' => $companyname,
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
}
