<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        $member = DB::table('members')->leftjoin('users','users.id','=','members.id_users')->select('members.*','users.nama')->get();
        $pegawai = User::where('role','1')->get();
        return  view('manajemen.member.member',compact('companyname','member','pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'id_users' => 'required',
            'nama_member'=> 'required',
            'no_member'=> 'required',
            'alamat_member'=> 'required'
        ]);

        Member::create($validatedData);
        // $request->session()->flash('success', 'Data obat berhasil ditambahkan!');
        return redirect('/manajemen/member');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $member = Member::find($request->id)->update(['id_users'=>$request->id_users]);
        return back()->with('success','selamat pasien berhasil di tambahkan');
    }

    public function update(Request $request)
    {
        Member::find(request('ID_member'))->update([
            'nama_member' => request('nama_member'),
            'alamat_member' => request('alamat_member'),
            'no_member' => request('no_member')
        ]);

        Session::flash('success', 'Data obat successfully updated.');
        return back()->with('success', true);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
