<?php

namespace App\Http\Controllers;

use App\Models\GeojsonCategory;
use App\Models\GeojsonData;
use App\Models\GeojsonProperties;
use Illuminate\Http\Request;

class GeojsonController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'required|mimes:json|max:2048',
        ]);

        

        //$geojson = json_decode(file_get_contents("uploads/geojson/166901157333.json"), true);
        $files = [];
        if ($request->file('files')) {
            foreach ($request->file('files') as $key => $file) {
                $fileName = time() . rand(1, 99) . '.' . $file->extension();
                $file->move(public_path('uploads/geojson'), $fileName);
                $files[]['name'] = $fileName;
            }
        }

        foreach ($files as $key => $value) {
            $geojson ='';
            $geojson = json_decode(file_get_contents("uploads/geojson/".$value['name']), true);
            //dd($geojson);
            $categoryData['category_name'] = $geojson['name'];
            $categoryData['fill_color'] = '#0080ff';
            $categoryData['fill_opacity'] = '0.5';

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
        }
        return back()
            ->with('success', 'You have successfully upload file.');
    }
}
