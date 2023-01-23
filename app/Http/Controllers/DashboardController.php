<?php

namespace App\Http\Controllers;

use App\Models\DokumenKajianLingkungan;
use App\Models\IjinLingkungan;
use App\Models\KawasanEkosistemEsensial;
use App\Models\Sppl;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $ijinLingkungan = IjinLingkungan::count();
        $kes = KawasanEkosistemEsensial::count();
        $sppl = Sppl::count();
        $dkl = DokumenKajianLingkungan::count();

        $load['il'] = $ijinLingkungan;
        $load['kes'] = $kes;
        $load['sppl'] = $sppl;
        $load['dkl'] = $dkl; 

        return view('backend.pages.dashboard.index',$load);
    }
}
