<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Option';
        $subtitle = '';

        $data = Option::orderByDesc('created_at')->paginate(5);


        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.option.index', $load);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Option';
        $subtitle = '';

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;

        return view('backend.pages.option.create', $load);
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
        ]);

        $postVal['title'] = $request->title;
        $postVal['body'] = $request->body;
        $postVal['display'] = $request->display;


        $insert =  Option::create($postVal);



        $request->session()->flash('success', 'Tambah Data Suksess');
        return redirect()->route('option.index');
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
        $title = 'Edit Option';
        $subtitle = '';

        $data = Option::find($id);

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.option.edit', $load);
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
        ]);

        $postVal['title'] = $request->title;
        $postVal['body'] = $request->body;
        $postVal['display'] = $request->display;

        Option::find($id)->update($postVal);
 

        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('option.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Option::find($id)->delete();
        session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('option.index');
    }
}
