<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class TemplatePesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        $setting = Setting::first();
        $companyname = $setting->nama_perusahaan;
        return view('manajemen.addTemplate', [
            'companyname' => $companyname,
        ]);
    }

}
