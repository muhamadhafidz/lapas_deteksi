<?php

namespace App\Http\Controllers;

use App\Donasi;
use App\KegiatanYayasan;
use App\ProfilYayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;
use Storage;
use PDF;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('login');
    }
    
}
