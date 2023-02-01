<?php

namespace App\Http\Controllers;

use App\Models\GeojsonCategory;
use App\Models\GeojsonProperties;
use Illuminate\Http\Request;
use Shapefile\ShapefileReader;
use TeamZac\LaravelShapefiles\Reader;

class PetaController extends Controller
{
    public function index()
    {
        $geojsonData = GeojsonCategory::join('geojson_data', 'geojson_categories.category_id', '=', 'geojson_data.geojson_id')
            //->join('menus', 'geojson_categories.menu_id', '=', 'menus.menu_id')
            ->where('display', 1)
            ->orderBy('category_id')
            ->get();

        //dd($geojsonData->toArray());

        $susunData = [];
        $menuData = [];
        foreach ($geojsonData as $key => $value) {
            $susunData[$value->category_id]['menu'] = $value->menu_id;
            $susunData[$value->category_id]['type'] = 'FeatureCollection';
            $susunData[$value->category_id]['name'] = $value->category_name;
            $susunData[$value->category_id]['features'][$key]['type'] = 'Feature';
            $susunData[$value->category_id]['features'][$key]['properties'] = json_decode($value->data_properties);
            $susunData[$value->category_id]['features'][$key]['geometry']['type'] = $value->data_type;
            $susunData[$value->category_id]['features'][$key]['geometry']['coordinates'] = json_decode($value->data_coordinates);
            


            /*$styleData[$value->category_id]['id'] =  'layer_' . $value->category_id;
            $styleData[$value->category_id]['type'] = 'fill';
            $styleData[$value->category_id]['source'] = 'source_' . strval($value->category_id);
            $styleData[$value->category_id]['paint']['fill-color'] = $value->fill_color;
            $styleData[$value->category_id]['paint']['fill-opacity'] = $value->fill_opacity;*/
            //$styleData[$value->category_id]['paint']['visibility'] = 'none';


            $menuData[$value->menu_id]['menu_id'] = $value->menu_id;
            $menuData[$value->menu_id]['menu_name'] = $value->menu_name;
            $menuData[$value->menu_id]['menu_data'][$value->category_id]['category_nama'] = $value->category_name;
        
        }

        //dd($menuData);
        $susunDataBaru = [];
        $susunDataBaru2 = [];
        foreach ($susunData as $key => $value) {

            foreach ($value['features'] as $kf => $vf) {
                //dd($vf['properties']->Nama_Petan);
                //print_r($vf['properties']);
                $nama =  'Index_'.$kf;
                if (isset($vf['properties']->Nama_Petan)) {
                    $nama = $vf['properties']->Nama_Petan;
                }elseif (isset($vf['properties']->NAMA)) {
                    $nama = $vf['properties']->NAMA;
                
                }elseif (isset($vf['properties']->Nama)) {
                    $nama = $vf['properties']->Nama;
                }
                //$susunDataBaru[$key + $kf] = $value;
                $susunDataBaru[$key + $kf]['type'] = $value['type'];
                $susunDataBaru[$key + $kf]['name'] = $nama;
                $susunDataBaru[$key + $kf]['features'][] = $vf;
                $menuData[$value['menu']]['menu_data'][$key]['data'][$key + $kf] = $nama;

                $styleData[$key + $kf]['id'] =  'layer_' . $key + $kf;
                $styleData[$key + $kf]['type'] = 'fill';
                $styleData[$key + $kf]['source'] = 'source_' . strval($key + $kf);
                $styleData[$key + $kf]['paint']['fill-color'] = '#f71836';
                $styleData[$key + $kf]['paint']['fill-opacity'] = 0.8;
            }
        }
        
        //dd($menuData);

        $load['geojson'] = $susunDataBaru;
        $load['style'] = $styleData;
        $load['menu'] = $menuData;
        
        return view('peta', $load);
    }

    public function petaMobile()
    {
        $geojsonData = GeojsonCategory::join('geojson_data', 'geojson_categories.category_id', '=', 'geojson_data.geojson_id')
            ->join('menus', 'geojson_categories.menu_id', '=', 'menus.menu_id')
            //->where('category_id', 9)
            ->orderBy('category_id')
            ->get();

        //dd($geojsonData->toArray());

        $susunData = [];
        $menuData = [];
        foreach ($geojsonData as $key => $value) {
            $susunData[$value->category_id]['menu'] = $value->menu_id;
            $susunData[$value->category_id]['type'] = 'FeatureCollection';
            $susunData[$value->category_id]['name'] = $value->category_name;
            $susunData[$value->category_id]['features'][$key]['type'] = 'Feature';
            $susunData[$value->category_id]['features'][$key]['properties'] = json_decode($value->data_properties);
            $susunData[$value->category_id]['features'][$key]['geometry']['type'] = $value->data_type;
            $susunData[$value->category_id]['features'][$key]['geometry']['coordinates'] = json_decode($value->data_coordinates);
            


            /*$styleData[$value->category_id]['id'] =  'layer_' . $value->category_id;
            $styleData[$value->category_id]['type'] = 'fill';
            $styleData[$value->category_id]['source'] = 'source_' . strval($value->category_id);
            $styleData[$value->category_id]['paint']['fill-color'] = $value->fill_color;
            $styleData[$value->category_id]['paint']['fill-opacity'] = $value->fill_opacity;*/
            //$styleData[$value->category_id]['paint']['visibility'] = 'none';


            $menuData[$value->menu_id]['menu_id'] = $value->menu_id;
            $menuData[$value->menu_id]['menu_name'] = $value->menu_name;
            $menuData[$value->menu_id]['menu_data'][$value->category_id]['category_nama'] = $value->category_name;
        
        }

        //dd($menuData);
        $susunDataBaru = [];
        $susunDataBaru2 = [];
        foreach ($susunData as $key => $value) {

            foreach ($value['features'] as $kf => $vf) {
                //dd($vf['properties']->Nama_Petan);
                //print_r($vf['properties']);
                $nama =  'Index_'.$kf;
                if (isset($vf['properties']->Nama_Petan)) {
                    $nama = $vf['properties']->Nama_Petan;
                }elseif (isset($vf['properties']->NAMA)) {
                    $nama = $vf['properties']->NAMA;
                
                }elseif (isset($vf['properties']->Nama)) {
                    $nama = $vf['properties']->Nama;
                }
                //$susunDataBaru[$key + $kf] = $value;
                $susunDataBaru[$key + $kf]['type'] = $value['type'];
                $susunDataBaru[$key + $kf]['name'] = $nama;
                $susunDataBaru[$key + $kf]['features'][] = $vf;
                $menuData[$value['menu']]['menu_data'][$key]['data'][$key + $kf] = $nama;

                $styleData[$key + $kf]['id'] =  'layer_' . $key + $kf;
                $styleData[$key + $kf]['type'] = 'fill';
                $styleData[$key + $kf]['source'] = 'source_' . strval($key + $kf);
                $styleData[$key + $kf]['paint']['fill-color'] = '#f71836';
                $styleData[$key + $kf]['paint']['fill-opacity'] = 0.8;
            }
        }
        
        //dd($menuData);

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
