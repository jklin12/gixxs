<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DokumenKajianLingkungan;
use App\Models\FileMenu;
use App\Models\FileShare;
use App\Models\Galery;
use App\Models\GeojsonCategory;
use App\Models\IjinLingkungan;
use App\Models\KawasanEkosistemEsensial;
use App\Models\Option;
use App\Models\Proker;
use App\Models\RefProker;
use App\Models\Sppl;
use Illuminate\Http\Request;

class DataController extends Controller
{

    public function geojson(){
        $response['status'] = True;

        $geojsonData = GeojsonCategory::join('geojson_data', 'geojson_categories.category_id', '=', 'geojson_data.geojson_id')
            //->join('menus', 'geojson_categories.menu', '=', 'menus.menu_id')
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
 
            $menuData[$value->menu_id]['menu_id'] = $value->menu_id;
            $menuData[$value->menu_id]['menu_name'] = $value->menu_name;
            $menuData[$value->menu_id]['menu_data'][$value->category_id]['category_nama'] = $value->category_name;
        
        }

         
        $response['menu'] = $menuData;
        $response['data'] = $susunData;

        return response()->json($response, 200); 
    }
    public function ijinLingkungan()
    {

        $response['status'] = True;
        $response['data'] = IjinLingkungan::orderByDesc('created_at')->paginate(20);

        return response()->json($response, 200);
    }

    public function kes()
    {

        $response['status'] = True;
        $response['data'] = KawasanEkosistemEsensial::orderByDesc('created_at')->paginate(20);

        return response()->json($response, 200);
    }
    public function dkl()
    {

        $response['status'] = True;
        $response['data'] = DokumenKajianLingkungan::orderByDesc('created_at')->paginate(20);

        return response()->json($response, 200);
    }
    public function sppl()
    {

        $response['status'] = True;
        $response['data'] = Sppl::orderByDesc('created_at')->paginate(20);

        return response()->json($response, 200);
    }

    public function galery()
    {

        $response['status'] = True;
        $response['data'] = Galery::where('display','1')->orderByDesc('created_at')->get();

        return response()->json($response, 200);
    }

    public function fileMenu()
    {

        $response['status'] = True;
        $response['data'] = FileMenu::where('file_menu_display','1')->get();

        return response()->json($response, 200);
    }

    public function fileShare($menuId)
    {

        $fileShare = FileShare::where('file_share_menu',$menuId)->get();
        foreach ($fileShare as $key => $value) {
            $fileShare->menu = $value->menu->ref_menu_name;
        }
        
        $response['status'] = True;
        $response['data'] = $fileShare;

        return response()->json($response, 200);
    }
    public function refProker()
    {

        $response['status'] = True;
        $response['data'] = RefProker::get();

        return response()->json($response, 200);
    }

    public function proker($refProkerId)
    {

        $fileShare = Proker::where('ref_proker_id',$refProkerId)->get();
        foreach ($fileShare as $key => $value) {
            $fileShare->ref = $value->ref;
        }

        $response['status'] = True;
        $response['data'] = $fileShare;

        return response()->json($response, 200);
    }
    
    public function option($title)
    {

        $response['status'] = True;
        $response['data'] = Option::where(['display'=>'1','title'=>$title])->orderByDesc('created_at')->first();

        return response()->json($response, 200);
    }
    public function category($id)
    {

        $response['status'] = True;
        $response['data'] = GeojsonCategory::where(['menu'=>$id])->get();

        return response()->json($response, 200);
    }
}
