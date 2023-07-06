<?php

namespace App\Http\Controllers;

use App\Models\obat;
use App\Http\Requests\StoreobatRequest;
use App\Http\Requests\UpdateobatRequest;

class ObatController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreobatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreobatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function show(obat $obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function edit(obat $obat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateobatRequest  $request
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateobatRequest $request, obat $obat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function destroy(obat $obat)
    {
        //
    }
}
