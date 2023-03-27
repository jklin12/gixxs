<?php

namespace App\Http\Controllers;

use App\Models\Proker;
use App\Models\RefProker;
use Illuminate\Http\Request;

class ProkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Program Kerja';
        $subtitle = '';

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = Proker::paginate(10);

        return view('backend.pages.proker.index', $load);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Program Kerja';
        $subtitle = '';

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['refs'] = RefProker::get();



        return view('backend.pages.proker.create', $load);
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
            'ref_proker_id' => ['required', 'integer'],
            'proker_title' => ['required', 'string'],
            'proker_body' => ['required'],

        ]);

        $postVal = ['ref_proker_id' => $request->ref_proker_id, 'proker_title'=> $request->proker_title, 'proker_body' => $request->proker_body];
        //dd($postVal);

        Proker::create($postVal);
        $request->session()->flash('success', 'Tambah Data Suksess');

        return redirect()->route('proker.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proker  $proker
     * @return \Illuminate\Http\Response
     */
    public function show(Proker $proker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proker  $proker
     * @return \Illuminate\Http\Response
     */
    public function edit(Proker $proker)
    {
        $title = 'Edit Proker';
        $subtitle = '';



        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $proker;
        $load['refs'] = RefProker::get();

        return view('backend.pages.proker.edit', $load);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proker  $proker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proker $proker)
    {
        $request->validate([
            'ref_proker_id' => ['required', 'integer'],
            'proker_title' => ['required', 'string'],
            'proker_body' => ['required'],

        ]);

        $postVal = ['ref_proker_id' => $request->ref_proker_id, 'proker_title'=> $request->proker_title, 'proker_body' => $request->proker_body];
        //dd($postVal);

        $proker->update($postVal);
        $request->session()->flash('success', 'Edit Data Suksess');

        return redirect()->route('proker.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proker  $proker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proker $proker)
    {
        $proker->delete();
        session()->flash('success', 'Hapus Data Suksess');

        return redirect()->route('proker.index');
    }
}
