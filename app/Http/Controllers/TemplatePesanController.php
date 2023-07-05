<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\templatePesan;
use App\Http\Requests\StoretemplatePesanRequest;
use App\Http\Requests\UpdatetemplatePesanRequest;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretemplatePesanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretemplatePesanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\templatePesan  $templatePesan
     * @return \Illuminate\Http\Response
     */
    public function show(templatePesan $templatePesan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\templatePesan  $templatePesan
     * @return \Illuminate\Http\Response
     */
    public function edit(templatePesan $templatePesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetemplatePesanRequest  $request
     * @param  \App\Models\templatePesan  $templatePesan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetemplatePesanRequest $request, templatePesan $templatePesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\templatePesan  $templatePesan
     * @return \Illuminate\Http\Response
     */
    public function destroy(templatePesan $templatePesan)
    {
        //
    }
}
