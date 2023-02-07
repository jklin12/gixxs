<?php

namespace App\Http\Controllers;

use App\Models\KawasanEkosistemEsensial;
use Illuminate\Http\Request;

class KesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dokumen Kawasn Ekosistem Esensial';
        $subtitle = '';

        $data = KawasanEkosistemEsensial::orderByDesc('created_at')->paginate(5);

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.kes.index', $load);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Kawasn Ekosistem Esensial';
        $subtitle = '';



        $load['title'] = $title;
        $load['subtitle'] = $subtitle;

        return view('backend.pages.kes.create', $load);
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
            'nama' => ['required', 'string', 'max:255'],
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'exp_date' => ['required', 'date'], 
        ]);

        $filePath = $request->file('file')->store('/files/kes', 'public');

        $postVal['kes_nama'] = $request->nama; 
        $postVal['kes_file'] = $filePath; 
        $postVal['kes_exp_date'] = $request->exp_date; 

        $insert =  KawasanEkosistemEsensial::create($postVal);

        $request->session()->flash('success', 'Tambah Data Suksess');
        return redirect()->route('kes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Kawasan Ekosistem Esensial';
        $subtitle = '';

        $data = KawasanEkosistemEsensial::find($id);

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.kes.edit', $load);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'file' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'exp_date' => ['required', 'date'], 
        ]);

        $postVal['kes_nama'] = $request->nama;
        $postVal['kes_exp_date'] = $request->exp_date;
     

        KawasanEkosistemEsensial::where('kes_id', $id)->update($postVal);

        if ($request->file('file')) {
            $filePath = $request->file('file')->store('/files/kes', 'public');
            //dd($filePath);
            KawasanEkosistemEsensial::where('kes_id', $id)
                ->update(['kes_file' => $filePath]);
        }

        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('kes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = KawasanEkosistemEsensial::where('kes_id', $id)->delete();
        session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('kes.index');
    }
}
