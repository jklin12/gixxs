<?php

namespace App\Http\Controllers;

use App\Models\Geojson;
use App\Models\GeojsonCategory;
use App\Models\GeojsonData;
use App\Models\GeojsonProperties;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Geojson2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Geojson';
        $subtitle = '';

        $data = Menu::leftJoin('geojson_categories', 'menus.menu_id', '=', 'geojson_categories.menu')
            ->leftJoin('geojson', 'geojson_categories.category_id', '=', 'geojson.category')
            ->orderBy('menu_order')
            ->get();
        //print_r($data->toArray());die;
        //dd($data);

        $susunData = [];
        foreach ($data as $key => $value) {
            //if ($value->menu_id) {

            $susunData[$value->menu_id]['menu_id'] = $value->menu_id;
            $susunData[$value->menu_id]['menu_name'] = $value->menu_name;
            if ($value->menu) {
                $susunData[$value->menu_id]['category_data'][$value->category_id]['category_id'] = $value->category_id;
                $susunData[$value->menu_id]['category_data'][$value->category_id]['category_name'] = $value->category_name;
                if ($value->geojson_id) {
                    $susunData[$value->menu_id]['category_data'][$value->category_id]['geojson_data'][$value->geojson_id]['geojson_id'] = $value->geojson_id;
                    $susunData[$value->menu_id]['category_data'][$value->category_id]['geojson_data'][$value->geojson_id]['geojson_name'] = $value->geojson_name ?? $key;
                }
            }
            //}
        }
        //dd($susunData);
        //print_r($susunData);die;


        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $susunData;

        return view('backend.pages.geojson.index', $load);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Geojson';
        $subtitle = '';



        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['menu'] = Menu::get();

        return view('backend.pages.geojson.create', $load);
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
            'menu' => ['required'],
            'category' => ['required'],
            'file' => ['required'],
        ]);

        $files = [];
        if ($request->file('file')) {
            $fileName = time() . rand(1, 99) . '.' . $request->file('file')->extension();
            $request->file('file')->move(public_path('uploads/geojson'), $fileName);
            $files['name'] = $fileName;
        }

        $postVal['category'] = $request->category;
        $postVal['geojson_name'] = $request->name;
        $postVal['geojson_color'] = $request->geojson_color;
        $postVal['geojson_opacity'] = $request->geojson_opacity;
        $postVal['geojson_file'] = $files['name'];
        //dd($postVal);
        $insertJson = Geojson::create($postVal);
        //dd($insertJson->geojson_id);
        $geojson = '';
        $geojson = json_decode(file_get_contents("uploads/geojson/" . $files['name']), true);
        //dd($geojson);

        $propertiesData = [];
        $geojsonData = [];
        foreach ($geojson['features'] as $key => $value) {
            foreach ($value['properties'] as $propKey => $propVal) {
                $propertiesData[$propKey]['geojson_id'] = $insertJson->geojson_id;
                $propertiesData[$propKey]['table_key'] = $propKey;
            }
            $geojsonData[$key]['geojson_id'] = $insertJson->geojson_id;

            $geojsonData[$key]['data_properties'] = json_encode($value['properties']);
            $geojsonData[$key]['data_type'] = $value['geometry']['type'];
            $geojsonData[$key]['data_coordinates'] = json_encode($value['geometry']['coordinates']);
        }
        //dd($geojsonData);
        GeojsonProperties::insert($propertiesData);
        GeojsonData::insert($geojsonData);

        return redirect()->route('geojson.index')
            ->with('success', 'You have successfully upload file.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detail Geojson';
        $subtitle = '';

        $data = Geojson::join('geojson_categories', 'geojson.category', '=', 'geojson_categories.category_id')
            ->join('menus', 'geojson_categories.menu', '=', 'menus.menu_id')
            ->join('geojson_data', 'geojson.geojson_id', '=', 'geojson_data.geojson_id')
            //->join('geojson_properties', 'geojson_data.geojson_id', '=', 'geojson_properties.geojson_id')
            //->where('category_id', 9)
            ->where(DB::raw('geojson.geojson_id'), $id)
            ->get();
        


        $geojsonData = [];
        $geojson_id = 0;
        $geojsonItemData = [];
        foreach ($data as $key => $value) {
            $geojson_id = $value->geojson_id;
            $geojsonData['menu_id'] = $value->menu_id;
            $geojsonData['menu_name'] = $value->menu_name;            
            $geojsonData['menu_show'] = $value->menu_show;            
            $geojsonData['category_id'] = $value->category_id;
            $geojsonData['category_name'] = $value->category_name;
            $geojsonData['fill_color'] = $value->fill_color;
            $geojsonData['fill_opacity'] = $value->fill_opacity;

            $geojsonData['display'] = $value->display;            
            $geojsonData['geojson_id'] = $value->geojson_id;
            $geojsonData['geojson_name'] = $value->geojson_name;
            $geojsonData['geojson_color'] = $value->geojson_color;
            $geojsonData['geojson_opacity'] = $value->geojson_opacity;
            
             
            $geojsonItemData[$key]['data_type'] = $value->data_type;
            $geojsonItemData[$key]['data_properties']  = json_decode($value->data_properties);
            $geojsonItemData[$key]['data_coordinates'] = json_decode($value->data_coordinates);
        }

        $propKey = GeojsonProperties::where('geojson_id', $geojson_id)->get();



        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['geojsonData'] = $geojsonData;
        $load['geojsonItemData'] = $geojsonItemData;
        $load['propKey'] = $propKey->toArray();

        return view('backend.pages.geojson.show', $load);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Geojson';
        $subtitle = '';

        $data = GeojsonCategory::find($id);


        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

        return view('backend.pages.geojson.edit', $load);
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
            'name' => ['required', 'string', 'max:255'],
            'display' => ['required'],
            'fill_color' => ['required', 'string', 'max:255'],
            'fill_opacity' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $postVal['category_name'] = $request->name;
        $postVal['display'] = $request->display;
        $postVal['fill_color'] = $request->fill_color;
        $postVal['fill_opacity'] = $request->fill_opacity;


        GeojsonCategory::where('category_id', $id)->update($postVal);


        $request->session()->flash('success', 'Edit Data Suksess');
        return redirect()->route('geojson.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Geojson::where('geojson_id', $id)->delete();
        GeojsonData::where('geojson_id', $id)->delete();
        GeojsonProperties::where('geojson_id', $id)->delete();

        session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('geojson.index');
    }
}
