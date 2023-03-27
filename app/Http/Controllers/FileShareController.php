<?php

namespace App\Http\Controllers;

use App\Models\FileMenu;
use App\Models\FileShare;
use Illuminate\Http\Request;

class FileShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Share File';
        $subtitle = '';

        $data = FileShare::orderByDesc('created_at')->paginate(5);
        

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.file_share.index', $load);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah File';
        $subtitle = '';

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['menus'] = FileMenu::where('file_menu_display', 1)->get();

        

        return view('backend.pages.file_share.create', $load);
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
            'menu' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        $postVal['file_share_menu'] = $request->menu;
        $postVal['file_share_title'] = $request->title;

        if ($request->file('file')) {
            $filePath = $request->file('file')->store('/files/file_share', 'public');
            //dd($filePath);
            $postVal['file_share_file'] = $filePath;
        }


        $insert =  FileShare::create($postVal);

        $request->session()->flash('success', 'Tambah Data Suksess');
        return redirect()->route('file_share.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileShare  $fileShare
     * @return \Illuminate\Http\Response
     */
    public function show(FileShare $fileShare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileShare  $fileShare
     * @return \Illuminate\Http\Response
     */
    public function edit(FileShare $fileShare)
    {
        $title = 'Edit File';
        $subtitle = '';



        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $fileShare;
        $load['menus'] = FileMenu::where('file_menu_display', 1)->get();

        return view('backend.pages.file_share.edit', $load);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileShare  $fileShare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileShare $fileShare)
    {
        $request->validate([
            'menu' => ['required'],
            'title' => ['required', 'string', 'max:255'], 
        ]);

        $postVal['file_share_menu'] = $request->menu;
        $postVal['file_share_title'] = $request->title;

        if ($request->file('file')) {
            $filePath = $request->file('file')->store('/files/file_share', 'public');
            //dd($filePath);
            $postVal['file_share_file'] = $filePath;
        }
        //dd($postVal)
        $fileShare->update($postVal);

        $request->session()->flash('success', 'Update Data Suksess');
        return redirect()->route('file_share.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileShare  $fileShare
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileShare $fileShare)
    {
        //
    }
}
