<?php

namespace App\Http\Controllers;

use App\Upt;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UptController extends Controller
{
    public function index()
    {
        $data = User::where('roles', 'user')->get();
        return view('admin.pages.upt.index', compact('data'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('admin.data-user.index');
        }else{

            $data = $validator->validated();
            $data['roles'] = 'user';
            $data['password'] = Hash::make($data['password']);
            User::insert($data);
            Alert::toast('User berhasil dibuat!', 'success');
            return redirect()->route('admin.data-user.index');
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
            'id' => ['required'],
            'kepala_upt' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'string'],
        ];

        $messages = [
            'id.required' => 'Id wajib diisi!',
            'kepala_upt.required' => 'Kepala UPT wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'no_telp.required' => 'No. Telp wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('admin.data-upt.index');
        }else{

            $data = $validator->validated();
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }else {
                unset($data['password']);
            }
            Upt::findOrFail($data['id'])->update($data);
            Alert::toast('UPT berhasil diubah!', 'success');
            return redirect()->route('admin.data-upt.index');
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
        User::findOrFail($id)->delete();
        return redirect()->route('admin.data-user.index');
    }
}
