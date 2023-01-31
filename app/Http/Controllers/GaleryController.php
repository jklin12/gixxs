<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Galery';
        $subtitle = '';

        $data = Galery::orderByDesc('created_at')->paginate(5);


        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.galery.index', $load);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Galery';
        $subtitle = '';

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;

        return view('backend.pages.galery.create', $load);
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
            'title' => ['required', 'string', 'max:255'],
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        $postVal['title'] = $request->title;
        $postVal['body'] = $request->body;
        $postVal['display'] = $request->display;


        $insert =  Galery::create($postVal);

        if ($request->file('file')) {
            $filePath = $request->file('file')->store('/files/galery', 'public');
            //dd($filePath);
            Galery::find($insert->id)
                ->update(['file' => $filePath]);
        }



        $request->session()->flash('success', 'Tambah Data Suksess');
        return redirect()->route('galery.index');
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
        $title = 'Edit Galery';
        $subtitle = '';

        $data = Galery::find($id);

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.galery.edit', $load);
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
            'title' => ['required', 'string', 'max:255'],
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        $postVal['title'] = $request->title;
        $postVal['body'] = $request->body;
        $postVal['display'] = $request->display;

        Galery::find($id)->update($postVal);

        if ($request->file('file')) {
            $filePath = $request->file('file')->store('/files/galery', 'public');
            //dd($filePath);
            Galery::find($id)
                ->update(['file' => $filePath]);
        }

        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('galery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Galery::find($id)->delete();
        session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('galery.index');
    }
}
