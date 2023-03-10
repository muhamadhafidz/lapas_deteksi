<?php

namespace App\Http\Controllers;

use App\Donasi;
use App\Pemasukan;
use App\Pengeluaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::get()->sum('nominal');
        $pemasukan = Pemasukan::get()->sum('nominal');
        $total_donasi = Donasi::get()->count();
        $nominal_donasi = Donasi::get()->sum('nominal_donasi');
        return view('admin.pages.dashboard.index', compact('pengeluaran', 'pemasukan', 'total_donasi', 'nominal_donasi'));
    }
}
