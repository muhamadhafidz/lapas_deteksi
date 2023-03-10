<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengeluaran::get();
        return view('admin.pages.pengeluaran.index', compact('data'));
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
            return redirect()->route('pengeluaran.index');
        }else{

            $data = $validator->validated();
            Pengeluaran::insert($data);
            Alert::toast('pengeluaran berhasil dibuat!', 'success');
            return redirect()->route('pengeluaran.index');
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
            return redirect()->route('pengeluaran.index');
        }else{

            $data = $validator->validated();
            Pengeluaran::findOrFail($id)->update($data);
            Alert::toast('pengeluaran berhasil dibuat!', 'success');
            return redirect()->route('pengeluaran.index');
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
        Pengeluaran::findOrFail($id)->delete();
        return redirect()->route('pengeluaran.index');
    }
}
