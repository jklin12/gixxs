<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = 'Menu Geojson';
        $subtitle = '';

        $data = Menu::leftJoin('geojson_categories', 'menus.menu_id', '=', 'geojson_categories.menu')
            ->orderBy('menu_order')
            ->get();

        $susunData = [];
        foreach ($data as $key => $value) {


            $susunData[$value->menu_id]['menu_id'] = $value->menu_id;
            $susunData[$value->menu_id]['menu_name'] = $value->menu_name;
            $susunData[$value->menu_id]['menu_show'] = $value->menu_show;
            if ($value->category_id) {
                $susunData[$value->menu_id]['category_data'][$value->category_id]['category_id'] = $value->category_id;
                $susunData[$value->menu_id]['category_data'][$value->category_id]['menu'] = $value->menu;
                $susunData[$value->menu_id]['category_data'][$value->category_id]['category_name'] = $value->category_name;
                $susunData[$value->menu_id]['category_data'][$value->category_id]['display'] = $value->display;
                $susunData[$value->menu_id]['category_data'][$value->category_id]['fill_color'] = $value->fill_color;
                $susunData[$value->menu_id]['category_data'][$value->category_id]['fill_opacity'] = $value->fill_opacity;
            }
        }
        //dd($susunData);
        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $susunData;

        return view('backend.pages.data_master.menu_index', $load);
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
            'menu_name' => ['required', 'string', 'max:255'], 
        ]);

        $postVal['menu_name'] = $request->menu_name;
        $postVal['menu_show'] = $request->menu_show;

        Menu::insert($postVal);

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
        $request->validate([
            'menu_name' => ['required', 'string', 'max:255'], 
        ]);

        $postVal['menu_name'] = $request->menu_name;
        $postVal['menu_show'] = $request->menu_show;

        Menu::where('menu_id',$id)->update($postVal);

        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Menu::where('menu_id',$id)->delete();

        $request->session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('menu.index');
    }
}
