<?php

namespace App\Http\Controllers;

use App\Models\DokumenKajianLingkungan;
use App\Models\IjinLingkungan;
use App\Models\KawasanEkosistemEsensial;
use App\Models\Sppl;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        return view('home/index');
    }

    public function ijinLingkungan(Request $request)
    {

        $title = "Ijin Lingkungan";

        $load['title'] = $title;

        $data = IjinLingkungan::get();

        //echo json_encode($data->toArray());
        //dd($data->toArray());
        $load['data'] = $data;

        return view('home/ijinLingkungan', $load);
    }

    public function kes(Request $request)
    {

        $title = "Kawasan Ekosistem Esensial";

        $load['title'] = $title;

        $data = KawasanEkosistemEsensial::get();

        $load['data'] = $data;
        //echo json_encode($data->toArray());die;
        //dd($data);

        return view('home/kes', $load);
    }

    public function dkl(Request $request)
    {

        $title = "Dokumen Kajian Lingkungan";

        $load['title'] = $title;

        $data = DokumenKajianLingkungan::get();
        //echo json_encode($data->toArray());die;

        $load['data'] = $data;

        return view('home/dkl', $load);
    }
    public function sppl(Request $request)
    {

        $title = "SPPL";

        $load['title'] = $title;

        $data = Sppl::get();
        //echo json_encode($data->toArray());die;
        $load['data'] = $data;

        return view('home/sppl', $load);
    }
}
