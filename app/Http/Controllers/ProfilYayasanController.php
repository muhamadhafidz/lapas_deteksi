<?php

namespace App\Http\Controllers;

use App\ProfilYayasan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Storage;

class ProfilYayasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProfilYayasan::first();
        return view('admin.pages.profil-yayasan.index', compact('data'));
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
        //
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
        $rules = [
            'nama_yayasan' => 'required',
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'nomor_rekening' => 'required',
        ];

        $messages = [
            'nama_yayasan.required' => 'Nama Yayasan wajib diisi!',
            'sejarah.required' => 'Sejarah wajib diisi!',
            'visi.required' => 'visi wajib diisi!',
            'misi.required' => 'misi wajib diisi!',
            'nomor_rekening.required' => 'nomor rekening wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('profil-yayasan.index');
        }else{

            $data = $validator->validated();
            ProfilYayasan::findOrFail($id)->update($data);
            Alert::toast('profil yayasan berhasil diubah!', 'success');
            return redirect()->route('profil-yayasan.index');
        }
    }

    public function uploadFoto(Request $request, $id, $tipe)
    {
        $rules = [
            'foto' => 'required',
        ];

        $messages = [
            'foto.required' => 'Foto wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('profil-yayasan.index');
        }else{

            $data = $validator->validated();
            $img = [];
            if ($data['foto']) {
                $file = $data['foto'];
                $file_name = $file->getFilename().".".strtolower($file->getClientOriginalExtension());
                
                $file_location = "assets/img/foto/";
                
                $gambar = $file_location.$file_name;
                Storage::disk('public')->putFileAs($file_location, $file, $file_name);
                if ($tipe == 'logo') {
                    $img['logo_pic'] = $gambar;
                }else if ($tipe == 'org') {
                    $img['struktur_organisasi'] = $gambar;
                }else if ($tipe == 'foto') {
                    $img['foto'] = $gambar;
                }
            }
            
            ProfilYayasan::findOrFail($id)->update($img);
            Alert::toast($tipe.' yayasan berhasil diubah!', 'success');
            return redirect()->route('profil-yayasan.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
