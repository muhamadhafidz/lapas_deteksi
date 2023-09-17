<?php

namespace App\Http\Controllers;

use App\Upt;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $data = User::get();
        return view('admin.pages.user.index', compact('data'));
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
            'roles' => ['required'],
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'roles.required' => 'Role wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('admin.data-user.index');
        }else{

            $data = $validator->validated();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            
            Upt::create([
                'user_id' => $user->id,
                'kepala_upt' => '',
                'alamat' => '',
                'no_telp' => '',
            ]);
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
            'name' => ['required', 'string', 'max:255'],
            'roles' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,'.$id],
        ];

        $messages = [
            'name.required' => 'Nama wajib diisi!',
            'roles.required' => 'Role wajib diisi!',
            'email.required' => 'Email wajib diisi!',
        ];
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            $error = $validator->getMessageBag()->first();

            Alert::toast($error, 'error');
            return redirect()->route('admin.data-user.index');
        }else{

            $data = $validator->validated();
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }else {
                unset($data['password']);
            }
            User::findOrFail($id)->update($data);
            Alert::toast('User berhasil diubah!', 'success');
            return redirect()->route('admin.data-user.index');
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
