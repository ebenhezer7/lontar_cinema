<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LogM;
use Illuminate\Http\Request;
use PDF;

class userR extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman User'
        ]);
        $subtittle = "halaman user";
        $user = User::all();
        return view('user.user', compact('user', 'subtittle', 'log'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Tambah User'
        ]);
        $subtittle = "halaman tambah user";
        $user = User::all();
        return view('user.user_create', compact('user', 'subtittle', 'log'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'role' => 'required',
        ]);

        $users = new User([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $users->save();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menambah Data User ' . $users->nama
        ]);

        return redirect()->route('user.index')->with('success', 'User Berhasil Ditambah', compact('log'));
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
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Edit User'
        ]);

        $subtittle = "Halaman edit User";
        $user = User::find($id);
        return view('user/user_edit', compact('user', 'subtittle', 'log'));
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
        $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'role' => 'required',
        ]);

        $user = User::find($id);
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->role = $request->input('role');
        $user->update();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Memperbaharui Data User ' . $user->nama
        ]);

        return redirect()->route('user.index')->with('success', 'Data Users Berhasil Diedit', compact('log'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Data User ' . $user->nama
        ]);

        return redirect()->route('user.index')->with('success', 'User Berhasil Dihapus', compact('log'));
    }

    public function changepassword($id)
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Edit Password'
        ]);
        $subtittle = "Halaman edit password User";
        $user = User::find($id);
        return view('user/user_changepassword', compact('user', 'subtittle', 'log'));
    }

    public function change(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required',
            'password_confirm' => 'required|same:new_password',
        ]);

        $user = User::where("id", $id)->first();
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengganti Password User ' . $user->nama
        ]);

        return redirect()->route('user.index')->with('success', 'Password Berhasil Diedit', compact('log'));
    }
    public function pdf(){
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Data User'
        ]);
        $user = User::all();
        $pdf = PDF::loadview('user/user_pdf', ['user' => $user]);
        return $pdf->stream('user.pdf', compact('log'));
    }
    
}
