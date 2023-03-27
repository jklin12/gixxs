<?php

namespace App\Http\Controllers;

use App\Models\FileMenu;
use Illuminate\Http\Request;

class FileMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Menu Files';
        $subtitle = '';

        $data = FileMenu::get();

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.data_master.menu_file_index', $load);
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
            'file_menu_title' => ['required', 'string', 'max:255'],
            'file_menu_file' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
        ]);

        $postVal['file_menu_title'] = $request->file_menu_title;
        $postVal['file_menu_display'] = $request->file_menu_display;


        $insert =  FileMenu::create($postVal);

        if ($request->file('file_menu_file')) {
            $filePath = $request->file('file_menu_file')->store('/files/menu_file', 'public');
            //dd($filePath,$insert->file_menu_id);
            FileMenu::find($insert->file_menu_id)
                ->update(['file_menu_file' => $filePath]);
        }

        $request->session()->flash('success', 'Tambah Data Suksess');
        return redirect()->route('menu_file.index');
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
        //
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
            'file_menu_title' => ['required', 'string', 'max:255'],
         
        ]);

        $postVal['file_menu_title'] = $request->file_menu_title;
        $postVal['file_menu_display'] = $request->file_menu_display;


        $insert =  FileMenu::find($id)->update($postVal);

        if ($request->file('file_menu_file')) {
            $filePath = $request->file('file_menu_file')->store('/files/menu_file', 'public');
            //dd($filePath,$insert->file_menu_id);
            FileMenu::find($id)
                ->update(['file_menu_file' => $filePath]);
        }

        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('menu_file.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        FileMenu::find($id)->delete();

        $request->session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('menu_file.index');
    }
}
