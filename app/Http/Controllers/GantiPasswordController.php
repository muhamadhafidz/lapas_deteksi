<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class GantiPasswordController extends Controller
{
    public function index()
    {
        return view('user.pages.ganti-password.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'password_old' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        //check if the current password matches with the password in the database
        $current_password = Auth::User()->password;
        if(Hash::check($request->password_old, $current_password))
        {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->password);
            $obj_user->save();
            Alert::toast('Password berhasil diubah!', 'success');
        }
        else
        {
            Alert::toast('Password lama tidak sesuai!', 'error');
        }
        return redirect()->route('user.ganti-password.index');
    }

}
