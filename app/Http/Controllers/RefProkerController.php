<?php

namespace App\Http\Controllers;

use App\Models\RefProker;
use Illuminate\Http\Request;

class RefProkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Referensi Program Kerja';
        $subtitle = '';

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = RefProker::get();

        return view('backend.pages.data_master.ref_proker_index', $load);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ref_proker_name' => ['required', 'string', 'max:255'],

        ]);

        RefProker::create(['ref_proker_name' => $request->ref_proker_name]);
        $request->session()->flash('success', 'Tambah Data Suksess');
        return redirect()->route('ref_proker.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RefProker  $refProker
     * @return \Illuminate\Http\Response
     */
    public function show(RefProker $refProker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RefProker  $refProker
     * @return \Illuminate\Http\Response
     */
    public function edit(RefProker $refProker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RefProker  $refProker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RefProker $refProker)
    {
        $request->validate([
            'ref_proker_name' => ['required', 'string', 'max:255'],

        ]);

        $refProker->update(['ref_proker_name' => $request->ref_proker_name]);
        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('ref_proker.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RefProker  $refProker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,RefProker $refProker)
    {
        $refProker->delete();
        $request->session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('ref_proker.index');
    }
}
