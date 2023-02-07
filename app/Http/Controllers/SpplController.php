<?php

namespace App\Http\Controllers;

use App\Models\Sppl;
use Illuminate\Http\Request;

class SpplController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dokumen Sppl';
        $subtitle = '';

        $data = Sppl::orderByDesc('created_at')->paginate(5);

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.sppl.index', $load);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Sppl';
        $subtitle = '';



        $load['title'] = $title;
        $load['subtitle'] = $subtitle;

        return view('backend.pages.sppl.create', $load);
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
            'name' => ['required', 'string', 'max:255'],
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
            'exp_date' => ['required', 'date'], 
        ]);

        $filePath = $request->file('file')->store('/files/sppl', 'public');

        $postVal['sppl_name'] = $request->name;
        $postVal['sppl_exp_date'] = $request->exp_date;
        $postVal['sppl_file'] = $filePath;

        Sppl::create($postVal);

        $request->session()->flash('success', 'Tambah Data Suksess');
        return redirect()->route('sppl.index');
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

        $data = Sppl::find($id);

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.sppl.edit', $load);
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

        $postVal['sppl_name'] = $request->nama;
        $postVal['sppl_exp_date'] = $request->exp_date;

        Sppl::where('sppl_id', $id)->update($postVal);

        if ($request->file('file')) {
            $filePath = $request->file('file')->store('/files/sppl', 'public');
            //dd($filePath);
            Sppl::where('sppl_id', $id)
                ->update(['sppl_file' => $filePath]);
        }

        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('sppl.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Sppl::where('sppl_id', $id)->delete();
        session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('sppl.index');
    }
}
