<?php

namespace App\Http\Controllers;

use App\Models\IjinLingkungan;
use Illuminate\Http\Request;

class IjinLingkunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dokumen Kawasan Ekosistem Esensial';
        $subtitle = '';

        $data = IjinLingkungan::orderByDesc('created_at')->paginate(5);


        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.ijin_lingkungan.index', $load);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Dokumen Ijin Lingkungan';
        $subtitle = '';



        $load['title'] = $title;
        $load['subtitle'] = $subtitle;

        return view('backend.pages.ijin_lingkungan.create', $load);
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

        $postVal['il_nama'] = $request->nama;
        $postVal['il_nib'] = $request->nib ?? '';
        $postVal['il_jenis_usaha'] = $request->jenis_usaha ?? '';
        $postVal['il_penanggung_jawab'] = $request->penanggung_jawab ?? '';
        $postVal['il_jabatan'] = $request->jabatan ?? '';
        $postVal['il_alamat_pusat'] = $request->alamat_pusat ?? '';
        $postVal['il_alamat_cabang'] = $request->alamat_cabang ?? '';
        $postVal['il_alamat_perwakilan'] = $request->alamat_perwakilan ?? '';
        $postVal['il_lokasi'] = $request->lokasi ?? '';

        $insert =  IjinLingkungan::create($postVal);

        if ($request->file('file')) {
            $filePath = $request->file('file')->store('/files/ijin_lingkungan', 'public');
            //dd($filePath);
            IjinLingkungan::where('il_id', $insert->il_id)
                ->update(['il_file' => $filePath]);
        }



        $request->session()->flash('success', 'Tambah Data Suksess');
        return redirect()->route('ijin_lingkungan.index');
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
        $title = 'Edit Dokumen Ijin Lingkungan';
        $subtitle = '';

        $data = IjinLingkungan::find($id);

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.ijin_lingkungan.edit', $load);
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

        $postVal['il_nama'] = $request->nama;
        $postVal['il_nib'] = $request->nib ?? '';
        $postVal['il_jenis_usaha'] = $request->jenis_usaha ?? '';
        $postVal['il_penanggung_jawab'] = $request->penanggung_jawab ?? '';
        $postVal['il_jabatan'] = $request->jabatan ?? '';
        $postVal['il_alamat_pusat'] = $request->alamat_pusat ?? '';
        $postVal['il_alamat_cabang'] = $request->alamat_cabang ?? '';
        $postVal['il_alamat_perwakilan'] = $request->alamat_perwakilan ?? '';
        $postVal['il_lokasi'] = $request->lokasi ?? '';

        IjinLingkungan::where('il_id', $id)->update($postVal);

        if ($request->file('file')) {
            $filePath = $request->file('file')->store('/files/ijin_lingkungan', 'public');
            //dd($filePath);
            IjinLingkungan::where('il_id', $id)
                ->update(['il_file' => $filePath]);
        }

        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('ijin_lingkungan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = IjinLingkungan::where('il_id', $id)->delete();
        session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('ijin_lingkungan.index');
    }
}
