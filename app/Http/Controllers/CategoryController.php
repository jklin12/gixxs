<?php

namespace App\Http\Controllers;

use App\Models\GeojsonCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //dd($request->all());
        $request->validate([
            'menu_id' => ['required', 'int'],
            'category_name' => ['required', 'string', 'max:255'],
            'display' => ['required'],
            'fill_opacity' => ['required'],
            'fill_color' => ['required', 'string'],
        ]);

        $postVal['menu'] = $request->menu_id;
        $postVal['category_name'] = $request->category_name;
        $postVal['display'] = $request->display;
        $postVal['fill_color'] = $request->fill_color;
        $postVal['fill_opacity'] = $request->fill_opacity;
        //dd($postVal);
        GeojsonCategory::insert($postVal);

        $request->session()->flash('success', 'Tambah Data Suksess');
        return redirect()->route('menu.index');
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
        $validate =  $request->validate([
            'menu_id' => ['required', 'int'],
            'category_name' => ['required', 'string', 'max:255'],
            'display' => ['required', 'int'],
            'fill_opacity' => ['required'],
            'fill_color' => ['required', 'string'],
        ]);

        $postVal['menu'] = $request->menu_id;
        $postVal['category_name'] = $request->category_name;
        $postVal['display'] = $request->display;
        $postVal['fill_color'] = $request->fill_color;
        $postVal['fill_opacity'] = $request->fill_opacity;

        $edit =  GeojsonCategory::where('category_id', $id)->update($postVal);

        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        GeojsonCategory::where('category_id', $id)->delete();

        $request->session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('menu.index');
    }
}
