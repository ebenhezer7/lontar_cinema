<?php

namespace App\Http\Controllers;

use App\Models\jam_tayang;
use App\Models\logM;
use App\Models\productM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class jam_tayangR extends Controller
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
            'activity' => 'User Melihat Halaman Data jam tayang'
        ]);
        $jamTayangs = Jam_tayang::join('product', 'jam_tayang.id_film', '=', 'product.id')
        ->select('jam_tayang.*', 'product.nama_produk')
        ->get();
        $subtittle = "halaman jam tayang";
        return view('studio.jam_tayang', compact('jamTayangs', 'subtittle', 'log'));
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
            'activity' => 'User Melihat Tambah Data Jam tayang'
        ]);
        $subtittle = "halaman jam tayang";
        $jamTayangs = jam_tayang::all();
        $produk = productM::all();
        return view('studio.jam_tayang_create', compact('jamTayangs', 'subtittle', 'log', 'produk'));
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
            'id_film' => 'required',
            'waktu_mulai' => 'required',
            'durasi' => 'required',
        ]);
    
        $jam = new jam_tayang([
            'id_film' => $request->id_film,
            'waktu_mulai' => $request->waktu_mulai,
            'durasi' => $request->durasi,
        ]);
        $jam->save();
    
        $log = logM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menambahkan Data jam ' . $jam->id_film . ' dengan jam tayang ' . $jam->waktu_mulai
        ]);
    
        return redirect()->route('jam_tayang.index')->with('success', 'jam tayang Berhasil Ditambah')->with(compact('log'));
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
            'activity' => 'User Melihat Halaman Edit Data jam tayang'
        ]);
        $subtittle = "halaman edit jam tayang";
        $jamTayangs = jam_tayang::find($id);
        $produk = productM::all();
        return view('studio.jam_tayang_edit', compact('jamTayangs', 'subtittle', 'log', 'produk'));
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
            'id_film' => 'required',
            'waktu_mulai' => 'required',
            'durasi' => 'required',
        ]);

        $jam = jam_tayang::find($id);
        $jam->id_film = $request->input('id_film');
        $jam->waktu_mulai = $request->input('waktu_mulai');
        $jam->durasi = $request->input('durasi');
        $jam->update();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Memperbaharui Data jam tayang ' . $jam->id_film
        ]);

        return redirect()->route('jam_tayang.index')->with('success', 'Data kursi Berhasil Diedit', compact('log'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jam = jam_tayang::where('id',$id)->delete();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Data jam tayang '
        ]);

        return redirect()->route('jam_tayang.index')->with('success', 'jam tayang Berhasil Dihapus', compact('log'));
    }
}
