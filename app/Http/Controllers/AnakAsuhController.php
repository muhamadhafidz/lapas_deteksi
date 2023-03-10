<?php

namespace App\Http\Controllers;

use App\Anakasuh;
use Illuminate\Http\Request;
use Alert;

class AnakAsuhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Anakasuh::get();
        return view('admin.pages.anak-asuh.index', compact('data'));
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
            'nama_anak' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ];

        $messages = [
            'nama_anak.required' => 'Nama Anak Asuh wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'tanggal_masuk.required' => 'Tanggal Masuk wajib diisi!',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi!',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-anak-asuh.index');
        }else{

            $data = $validator->validated();
            $data['ttl'] = $data['tempat_lahir'].', '.$data['tanggal_lahir'];
            unset( $data['tempat_lahir']);
            unset( $data['tanggal_lahir']);
            Anakasuh::insert($data);
            Alert::toast('Anak Asuh berhasil dibuat!', 'success');
            return redirect()->route('master-anak-asuh.index');
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
            'nama_anak' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
        ];

        $messages = [
            'nama_anak.required' => 'Nama Anak Asuh wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'tanggal_masuk.required' => 'Tanggal Masuk wajib diisi!',
            'tempat_lahir.required' => 'Tempat Lahir wajib diisi!',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('master-anak-asuh.index');
        }else{

            $data = $validator->validated();
            $data['ttl'] = $data['tempat_lahir'].', '.$data['tanggal_lahir'];
            unset( $data['tempat_lahir']);
            unset( $data['tanggal_lahir']);
            Anakasuh::findOrFail($id)->update($data);
            Alert::toast('Anak Asuh berhasil diubah!', 'success');
            return redirect()->route('master-anak-asuh.index');
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
        Anakasuh::findOrFail($id)->delete();
        Alert::toast('Anak Asuh berhasil dihapus!', 'success');
        return redirect()->route('master-anak-asuh.index');
    }
}
