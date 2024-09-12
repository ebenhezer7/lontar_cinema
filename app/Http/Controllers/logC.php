<?php

namespace App\Http\Controllers;

use App\Models\logM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class logC extends Controller
{
    public function index(Request $request)
    {
        $logM = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Log'
        ]);

        $query = LogM::select('users.*', 'log.*', 'users.id AS id_usr')
        ->join('users', 'users.id', '=', 'log.id_user', )
        ->orderBy('log.created_at', 'desc');       
        if ($request->filled('start_date') && $request->filled('end_date')) {
            // Jika kedua tanggal diisi, cari transaksi antara rentang tanggal
            $query->whereDate('log.created_at', '>=', $request->start_date)
            ->whereDate('log.created_at', '<=', $request->end_date);
        } elseif ($request->filled('start_date')) {
            // Jika hanya tanggal awal diisi, cari transaksi pada tanggal awal
            $query->whereDate('log.created_at', '=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            // Jika hanya tanggal akhir diisi, cari transaksi pada tanggal akhir
            $query->whereDate('log.created_at', '=', $request->end_date);
        }
        $data = $query->get();

        $subtittle = "Daftar Aktivitas";
        return view('main/log', compact('subtittle', 'data'));
    }
}
