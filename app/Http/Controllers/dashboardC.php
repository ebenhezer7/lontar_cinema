<?php

namespace App\Http\Controllers;

use App\Models\logM;
use App\Models\productM;
use App\Models\transactionM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class dashboardC extends Controller
{
    public function index()
    {
        $LogM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Dashboard'
        ]);
        $totaluser = User::count();
        $totalfilm = productM::count();
        $totaltransaksi = transactionM::count();
        $totalpemasukan = DB::table('transaction')->sum(DB::raw('uang_bayar - uang_kembali'));
        $subtittle = "Halaman Dashboard";
        return view('dashboard', compact('LogM','totaluser','totaltransaksi','totalfilm','totalpemasukan', 'subtittle'));

    }
}
