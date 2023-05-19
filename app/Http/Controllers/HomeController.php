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
        $data = ProfilYayasan::first();
        return view('user.pages.home.index', compact('data'));
    }

    public function kegiatan()
    {
        $kegiatan = KegiatanYayasan::all();
        $data = ProfilYayasan::first();
        return view('user.pages.kegiatan.index', compact('data', 'kegiatan'));
    }

    public function donasi()
    {
        $data = ProfilYayasan::first();
        return view('user.pages.donasi.index', compact('data'));
    }

    public function profil()
    {
        $data = ProfilYayasan::first();
        return view('user.pages.profil.index', compact('data'));
    }

    public function struktur()
    {
        $data = ProfilYayasan::first();
        return view('user.pages.struktur.index', compact('data'));
    }

    public function kwitansi($id)
    {
        $donasi = Donasi::findOrFail($id);
        $terbilang = strtolower(terbilang($donasi->nominal_donasi));
        $image = URL::to('/').'/img/kuitansi.png';
        $pdf = PDF::loadview('admin.invoice.print.kuitansi',compact('donasi', 'terbilang'))->setPaper([0,0,610,235]);

        return $pdf->stream('kwitansi_donasi.pdf');
    }

    public function uploadDonasi(Request $request)
    {
        $rules = [
            'nama_donatur' => 'required',
            'nama_bank' => 'required',
            'tanggal_donasi' => 'required',
            'nominal_donasi' => 'required',
            'bukti_donasi' => 'required',
        ];

        $messages = [
            'nama_donatur.required' => 'Nama Donatur wajib diisi!',
            'nama_bank.required' => 'Nama Bank wajib diisi!',
            'tanggal_donasi.required' => 'Tanggal Donasi wajib diisi!',
            'nominal_donasi.required' => 'Nominal Donasi wajib diisi!',
            'bukti_donasi.required' => 'Bukti wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('home.index');
        }else{

            $data = $validator->validated();
            if ($data['bukti_donasi']) {
                $file = $data['bukti_donasi'];
                $file_name = $file->getFilename().".".strtolower($file->getClientOriginalExtension());
                
                $file_location = "assets/img/bukti_donasi/";
                
                $gambar = $file_location.$file_name;
                Storage::disk('public')->putFileAs($file_location, $file, $file_name);
            }
            $data['bukti_donasi'] = $gambar;

            $donasi = Donasi::create($data);
            // dd($donasi);
            Alert::toast('data donasi berhasil diunggah', 'success');
            return redirect()->route('home.donasi')->with(['donasi' => true, 'id' => $donasi->id]);
        }
    }
}
