<?php

namespace App\Http\Controllers;

use App\Models\DokumenKajianLingkungan;
use Illuminate\Http\Request;

class DklController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dokumen Kajian Lingkungan';
        $subtitle = '';

        $data = DokumenKajianLingkungan::orderByDesc('created_at')->paginate(5);

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.dkl.index', $load);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Dokumen Kajian Lingkungan';
        $subtitle = '';



        $load['title'] = $title;
        $load['subtitle'] = $subtitle;

        return view('backend.pages.dkl.create', $load);
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
        ]);

        $filePath = $request->file('file')->store('/files/dkl', 'public');

        $postVal['dkl_nama'] = $request->nama; 
        $postVal['dkl_file'] = $filePath; 

        $insert =  DokumenKajianLingkungan::create($postVal);

        $request->session()->flash('success', 'Tambah Data Suksess');
        return redirect()->route('dkl.index');
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
        $title = 'Edit Dokumen Kajian Lingkungan';
        $subtitle = '';

        $data = DokumenKajianLingkungan::find($id);

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.dkl.edit', $load);
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
        ]);

        $postVal['dkl_nama'] = $request->nama;
     

        DokumenKajianLingkungan::where('dkl_id', $id)->update($postVal);

        if ($request->file('file')) {
            $filePath = $request->file('file')->store('/files/dkl', 'public');
            //dd($filePath);
            DokumenKajianLingkungan::where('dkl_id', $id)
                ->update(['dkl_file' => $filePath]);
        }

        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('dkl.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = DokumenKajianLingkungan::where('dkl_id', $id)->delete();
        session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('dkl.index');
    }
}