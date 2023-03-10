<?php

namespace App\Http\Controllers;

use App\Pengurus;
use Illuminate\Http\Request;
use Alert;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengurus::get();
        return view('admin.pages.pengurus.index', compact('data'));
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
            'nama_pengurus' => 'required',
            'nomor_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ];

        $messages = [
            'nama_pengurus.required' => 'Nama Pengurus wajib diisi!',
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
            return redirect()->route('master-pengurus.index');
        }else{

            $data = $validator->validated();
            $data['ttl'] = $data['tempat_lahir'].', '.$data['tanggal_lahir'];
            unset( $data['tempat_lahir']);
            unset( $data['tanggal_lahir']);
            Pengurus::insert($data);
            Alert::toast('Pengurus berhasil dibuat!', 'success');
            return redirect()->route('master-pengurus.index');
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
            'nama_pengurus' => 'required',
            'nomor_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ];

        $messages = [
            'nama_pengurus.required' => 'Nama Pengurus wajib diisi!',
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
            return redirect()->route('master-pengurus.index');
        }else{

            $data = $validator->validated();
            $data['ttl'] = $data['tempat_lahir'].', '.$data['tanggal_lahir'];
            unset( $data['tempat_lahir']);
            unset( $data['tanggal_lahir']);
            Pengurus::findOrFail($id)->update($data);
            Alert::toast('Pengurus berhasil diubah!', 'success');
            return redirect()->route('master-pengurus.index');
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
        Pengurus::findOrFail($id)->delete();
        Alert::toast('Pengurus berhasil dihapus!', 'success');
        return redirect()->route('master-pengurus.index');
    }
}
