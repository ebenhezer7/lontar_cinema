<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\LogM;

class loginC extends Controller
{
    public function login()
    {
        $subtittle = "Halaman Login";
        return view('main.login', compact('subtittle'));
    }

    public function login_action(Request $request)
    {
        
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $logM = logM::create([
                'id_user' => Auth::user()->id,
                'activity' => 'User Melakukan Login'
            ]);

            $request->session()->put('logM', $logM);
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'username' => 'Username salah',
            'password' => 'Password Salah',
        ]);
        
    }

    public function logout(Request $request)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan logout'
        ]);
    
        Auth::logout();
    
        $request->session()->forget('logM'); // Menghapus 'logM' dari sesi
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
