<?php

namespace App\Http\Controllers;

use App\Donatur;
use Illuminate\Http\Request;
use Alert;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Donatur::get();
        return view('admin.pages.donatur.index', compact('data'));
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
        $rules = [
            'nama_donatur' => 'required',
            'nomor_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ];

        $messages = [
            'nama_donatur.required' => 'Nama Donatur wajib diisi!',
            'nomor_telp.required' => 'Nomor Telepon wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi!',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi!',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-donatur.index');
        }else{

            $data = $validator->validated();
            $data['ttl'] = $data['tempat_lahir'].', '.$data['tanggal_lahir'];
            unset( $data['tempat_lahir']);
            unset( $data['tanggal_lahir']);
            Donatur::insert($data);
            Alert::toast('Donatur berhasil dibuat!', 'success');
            return redirect()->route('master-donatur.index');
        }
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
            'nama_donatur' => 'required',
            'nomor_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ];

        $messages = [
            'nama_donatur.required' => 'Nama Donatur wajib diisi!',
            'nomor_telp.required' => 'Nomor Telepon wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi!',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi!',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-donatur.index');
        }else{

            $data = $validator->validated();
            $data['ttl'] = $data['tempat_lahir'].', '.$data['tanggal_lahir'];
            unset( $data['tempat_lahir']);
            unset( $data['tanggal_lahir']);
            Donatur::findOrFail($id)->update($data);
            Alert::toast('Donatur berhasil diubah!', 'success');
            return redirect()->route('master-donatur.index');
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
        Donatur::findOrFail($id)->delete();
        Alert::toast('Donatur berhasil dihapus!', 'success');
        return redirect()->route('master-donatur.index');
    }
}
