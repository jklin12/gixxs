<?php

namespace App\Http\Controllers;

use App\Models\GeojsonCategory;
use App\Models\GeojsonProperties;
use App\Models\Menu;
use Illuminate\Http\Request;
use Shapefile\ShapefileReader;
use TeamZac\LaravelShapefiles\Reader;

class PetaController extends Controller
{
    public function index()
    {
        $geojsonData = Menu::leftJoin('geojson_categories', 'menus.menu_id', '=', 'geojson_categories.menu')
            ->leftJoin('geojson', function ($join) {
                $join->on('geojson_categories.category_id', '=', 'geojson.category')->where(['display' => 1]);
            })
            ->leftJoin('geojson_data', 'geojson.geojson_id', '=', 'geojson_data.geojson_id')
            ->orderBy('menu_order')
            ->where(['menu_show' => 1])
            ->get();


        $susunData = [];
        $menuData = [];
        foreach ($geojsonData as $key => $value) {
            if ($value->geojson_id) {
                $susunData[$value->geojson_id]['type'] = 'FeatureCollection';
                $susunData[$value->geojson_id]['name'] = $value->geojson_name;
                $susunData[$value->geojson_id]['features'][$key]['type'] = 'Feature';
                $susunData[$value->geojson_id]['features'][$key]['properties'] = json_decode($value->data_properties);
                $susunData[$value->geojson_id]['features'][$key]['geometry']['type'] = $value->data_type;
                $susunData[$value->geojson_id]['features'][$key]['geometry']['coordinates'] = json_decode($value->data_coordinates);


                $styleData[$value->geojson_id]['id'] =  'layer_' . $value->geojson_id;
                $styleData[$value->geojson_id]['type'] = 'fill';
                $styleData[$value->geojson_id]['source'] = 'source_' . strval($value->geojson_id);
                $styleData[$value->geojson_id]['paint']['fill-color'] = $value->geojson_color ??  $value->fill_color;
                $styleData[$value->geojson_id]['paint']['fill-opacity'] = $value->geojson_opacity ?? $value->fill_opacity;
                //$styleData[$value->category_id]['paint']['visibility'] = 'none';
            }

            $menuData[$value->menu_id]['menu_id'] = $value->menu_id;
            $menuData[$value->menu_id]['menu_name'] = $value->menu_name;
            if ($value->category_id) {
                $menuData[$value->menu_id]['menu_data'][$value->category_id]['category_name'] = $value->category_name;
                if ($value->geojson_id) {
                    $menuData[$value->menu_id]['menu_data'][$value->category_id]['category_data'][$value->geojson_id] = $value->geojson_name;
                }
            }
        }
        //dd($menuData);

        $susunDataBaru = [];
        foreach ($susunData as $key => $value) {
            $susunDataBaru[$key] = $value;
            $susunDataBaru[$key]['features'] = array_values($value['features']);
        }

        $load['geojson'] = $susunDataBaru;
        $load['style'] = $styleData;
        $load['menu'] = $menuData;

        return view('peta', $load);
    }

    public function petaMobile()
    {
        $geojsonData = Menu::leftJoin('geojson_categories', 'menus.menu_id', '=', 'geojson_categories.menu')
            ->leftJoin('geojson', function ($join) {
                $join->on('geojson_categories.category_id', '=', 'geojson.category')->where(['display' => 1]);
            })
            ->leftJoin('geojson_data', 'geojson.geojson_id', '=', 'geojson_data.geojson_id')
            ->orderBy('menu_order')
            ->where(['menu_show' => 1])
            ->get();


        $susunData = [];
        $menuData = [];
        foreach ($geojsonData as $key => $value) {
            if ($value->geojson_id) {
                $susunData[$value->geojson_id]['type'] = 'FeatureCollection';
                $susunData[$value->geojson_id]['name'] = $value->geojson_name;
                $susunData[$value->geojson_id]['features'][$key]['type'] = 'Feature';
                $susunData[$value->geojson_id]['features'][$key]['properties'] = json_decode($value->data_properties);
                $susunData[$value->geojson_id]['features'][$key]['geometry']['type'] = $value->data_type;
                $susunData[$value->geojson_id]['features'][$key]['geometry']['coordinates'] = json_decode($value->data_coordinates);


                $styleData[$value->geojson_id]['id'] =  'layer_' . $value->geojson_id;
                $styleData[$value->geojson_id]['type'] = 'fill';
                $styleData[$value->geojson_id]['source'] = 'source_' . strval($value->geojson_id);
                $styleData[$value->geojson_id]['paint']['fill-color'] = $value->geojson_color ??  $value->fill_color;
                $styleData[$value->geojson_id]['paint']['fill-opacity'] = $value->geojson_opacity ?? $value->fill_opacity;
                //$styleData[$value->category_id]['paint']['visibility'] = 'none';
            }

            $menuData[$value->menu_id]['menu_id'] = $value->menu_id;
            $menuData[$value->menu_id]['menu_name'] = $value->menu_name;
            if ($value->category_id) {
                $menuData[$value->menu_id]['menu_data'][$value->category_id]['category_name'] = $value->category_name;
                if ($value->geojson_id) {
                    $menuData[$value->menu_id]['menu_data'][$value->category_id]['category_data'][$value->geojson_id] = $value->geojson_name;
                }
            }
        }
        //dd($menuData);

        $susunDataBaru = [];
        foreach ($susunData as $key => $value) {
            $susunDataBaru[$key] = $value;
            $susunDataBaru[$key]['features'] = array_values($value['features']);
        }

        $load['geojson'] = $susunDataBaru;
        $load['style'] = $styleData;
        $load['menu'] = $menuData;
        return view('home.peta', $load);
    }

    public function ajax(Request $request)
    {

        $geojsonData = GeojsonCategory::where('category_id', $request->post('id'))
            ->join('geojson_data', 'geojson_categories.category_id', '=', 'geojson_data.geojson_id')->get();

        $susunData = [];

        foreach ($geojsonData as $key => $value) {
            $susunData['type'] = 'FeatureCollection';
            $susunData['name'] = $value->category_name;
            $susunData['features'][$key]['type'] = 'Feature';
            $susunData['features'][$key]['properties'] = json_decode($value->data_properties);
            $susunData['features'][$key]['geometry']['type'] = $value->data_type;
            $susunData['features'][$key]['geometry']['coordinates'] = json_decode($value->data_coordinates);


            $styleData['id'] = 'layer_' . strval($value->category_id);;
            $styleData['type'] = 'fill';
            $styleData['source'] = 'layer_' . strval($value->category_id);
            $styleData['paint']['fill-color'] = $value->fill_color;
            $styleData['paint']['fill-opacity'] = $value->fill_opacity;

            $menu[$value->category_id]['name'] = $value->category_name;
        }


        $load['geojson'] = json_encode($susunData);
        $load['style'] = json_encode($styleData);

        return response()->json($load);
    }
}
