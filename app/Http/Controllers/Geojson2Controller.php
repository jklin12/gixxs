<?php

namespace App\Http\Controllers;

use App\Models\GeojsonCategory;
use App\Models\GeojsonData;
use App\Models\GeojsonProperties;
use Illuminate\Http\Request;

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

        $data = $geojsonData = GeojsonCategory::orderByDesc('created_at')
            ->paginate(10);

        $load['title'] = $title;
        $load['subtitle'] = $subtitle;
        $load['data'] = $data;

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
            'display' => ['required'],
            'file' => ['required'],
            'fill_color' => ['required', 'string', 'max:255'],
            'fill_opacity' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $files = [];
        if ($request->file('file')) {
            $fileName = time() . rand(1, 99) . '.' . $request->file('file')->extension();
            $request->file('file')->move(public_path('uploads/geojson'), $fileName);
            $files['name'] = $fileName;
        }

        $geojson = '';
        $geojson = json_decode(file_get_contents("uploads/geojson/" . $files['name']), true);
        //dd($geojson);

        $categoryData['category_name'] = $request->name;
        $categoryData['display'] = $request->display;
        $categoryData['fill_color'] = $request->fill_color;
        $categoryData['fill_opacity'] = $request->fill_opacity;

        $category = GeojsonCategory::create($categoryData);
        //dd($category->category_id);
        $propertiesData = [];
        $geojsonData = [];
        foreach ($geojson['features'] as $key => $value) {
            foreach ($value['properties'] as $propKey => $propVal) {
                $propertiesData[$propKey]['geojson_id'] = $category->category_id;
                $propertiesData[$propKey]['table_key'] = $propKey;
            }
            $geojsonData[$key]['geojson_id'] = $category->category_id;
            $geojsonData[$key]['data_properties'] = json_encode($value['properties']);
            $geojsonData[$key]['data_type'] = $value['geometry']['type'];
            $geojsonData[$key]['data_coordinates'] = json_encode($value['geometry']['coordinates']);
        }
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

        $data = GeojsonCategory::join('geojson_data', 'geojson_categories.category_id', '=', 'geojson_data.geojson_id')
            //->join('geojson_properties', 'geojson_data.geojson_id', '=', 'geojson_properties.geojson_id')
            //->where('category_id', 9)
            ->where('category_id', $id)
            ->get();


        $geojsonData = [];
        $geojson_id = 0;
        $geojsonItemData = [];
        foreach ($data as $key => $value) {
            $geojson_id = $value->geojson_id;
            $geojsonData['category_id'] = $value->category_id;
            $geojsonData['category_name'] = $value->category_name;
            $geojsonData['display'] = $value->display;
            $geojsonData['fill_color'] = $value->fill_color;
            $geojsonData['fill_opacity'] = $value->fill_opacity;
            $geojsonData['created_at'] = $value->created_at;
            $geojsonData['updated_at'] = $value->updated_at;

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
        $deleted = GeojsonCategory::where('category_id', $id)->delete();
        GeojsonData::where('geojson_id',$id)->delete();
        GeojsonProperties::where('geojson_id',$id)->delete();

        session()->flash('success', 'Hapus Data Suksess');
        return redirect()->route('dkl.index');
    }
}
