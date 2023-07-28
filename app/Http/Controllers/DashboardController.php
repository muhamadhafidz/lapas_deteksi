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
        return view('admin.pages.dashboard.index');
    }
}
