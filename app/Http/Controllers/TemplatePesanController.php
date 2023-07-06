<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\ChatTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        return view('manajemen.chat.addTemplate', [
            'companyname' => $companyname,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'template_chat'=> 'required'
        ]);

        $validatedData['ID_User'] = Auth::user()->id;
        ChatTemplate::create($validatedData);
        $request->session()->flash('success', 'Data template berhasil ditambahkan!');
        return redirect('/manajemen/chat-template');
    }


    public function update(Request $request)
    {
        ChatTemplate::find(request('ID_template'))->update([
            'template_chat' => request('template_chat')
        ]);

        Session::flash('success', 'Template successfully updated.');
        return back()->with('success', true);
    }



}
