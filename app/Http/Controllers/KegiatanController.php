<?php

namespace App\Http\Controllers;

use App\KegiatanYayasan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KegiatanYayasan::all();
        return view('admin.pages.kegiatan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'foto' => 'required|image|mimes:png,jpg',
            'judul' => 'required',
            'deskripsi' => 'required'
        ]);


        if ($data['foto']) {
            $file = $data['foto'];
            $file_name = $file->getFilename().".".strtolower($file->getClientOriginalExtension());
            
            $file_location = "assets/img/foto/";
            
            $gambar = $file_location.$file_name;
            Storage::disk('public')->putFileAs($file_location, $file, $file_name);

            $data['foto'] = $gambar;
        }

        KegiatanYayasan::create($data);

        Alert::toast('kegiatan yayasan berhasil ditambah!', 'success');
        return redirect()->route('kegiatan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'edit_foto' => '',
            'edit_judul' => 'required',
            'edit_deskripsi' => 'required'
        ]);

        $item = [];
        $kegiatan = KegiatanYayasan::findOrFail($id);
        if (isset($data['edit_foto'])) {
            $file = $data['edit_foto'];
            $file_name = $file->getFilename().".".strtolower($file->getClientOriginalExtension());
            
            $file_location = "assets/img/foto/";
            
            $gambar = $file_location.$file_name;
            Storage::disk('public')->putFileAs($file_location, $file, $file_name);
            Storage::delete($kegiatan->foto);
            $kegiatan->foto = $gambar;
        }

        $kegiatan->judul = $data['edit_judul'];
        $kegiatan->deskripsi = $data['edit_deskripsi'];
        $kegiatan->save();
        Alert::toast('kegiatan yayasan berhasil diubah!', 'success');
        return redirect()->route('kegiatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kegiatan = KegiatanYayasan::findOrFail($id);
        $kegiatan->delete();
        Alert::toast('kegiatan yayasan berhasil dihapus!', 'success');
        return redirect()->route('kegiatan.index');
    }
}
