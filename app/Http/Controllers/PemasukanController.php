<?php

namespace App\Http\Controllers;

use App\Pemasukan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pemasukan::get();
        return view('admin.pages.pemasukan.index', compact('data'));
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
            'keterangan' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
        ];

        $messages = [
            'keterangan.required' => 'Keterangan wajib diisi!',
            'tanggal.required' => 'Tanggal wajib diisi!',
            'nominal.required' => 'Nominal wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('pemasukan.index');
        }else{

            $data = $validator->validated();
            Pemasukan::insert($data);
            Alert::toast('Pemasukan berhasil dibuat!', 'success');
            return redirect()->route('pemasukan.index');
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
            'keterangan' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
        ];

        $messages = [
            'keterangan.required' => 'Keterangan wajib diisi!',
            'tanggal.required' => 'Tanggal wajib diisi!',
            'nominal.required' => 'Nominal wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('pemasukan.index');
        }else{

            $data = $validator->validated();
            Pemasukan::findOrFail($id)->update($data);
            Alert::toast('Pemasukan berhasil dibuat!', 'success');
            return redirect()->route('pemasukan.index');
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
        Pemasukan::findOrFail($id)->delete();
        return redirect()->route('pemasukan.index');
    }
}
