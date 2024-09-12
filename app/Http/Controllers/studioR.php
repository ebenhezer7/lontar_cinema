<?php

namespace App\Http\Controllers;

use App\Models\studioM;
use Illuminate\Http\Request;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;
use PDF;

class studioR extends Controller
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
            'activity' => 'User Melihat Halaman studio'
        ]);
        $subtittle = "halaman studio";
        $studio = studioM::all();
        return view('studio.studio', compact('studio', 'subtittle', 'log'));
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
            'activity' => 'User Melihat Halaman Tambah Studio'
        ]);
        $subtittle = "halaman tambah studio";
        $studio = studioM::all();
        return view('studio.studio_create', compact('studio', 'subtittle', 'log'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menambahkan Data Studio'
        ]);

        $request->validate([
            'studio' => 'required',
        ]);

        $studio = new studioM([
            'studio' => $request->studio,
        ]);
        $studio->save();

        return redirect()->route('studio.index')->with('success', 'studio Berhasil Ditambah', compact('log'));
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
            'activity' => 'User Melihat Halaman Edit Studio'
        ]);

        $subtittle = "halaman edit studio";
        $studio = studioM::find($id);
        return view('studio.studio_edit', compact('studio', 'subtittle', 'log'));
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
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengedir Data Studio'
        ]);

        $request->validate([
            'studio' => 'required',
        ]);

        $studio = studioM::find($id);
        $studio->studio = $request->input('studio');
        $studio->update();

        return redirect()->route('studio.index')->with('success', 'Data studio Berhasil Diedit', compact('log'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Data Studio'
        ]);

        studioM::where('id',$id)->delete();
        return redirect()->route('studio.index')->with('success', 'studio Berhasil Dihapus', compact('log'));
    }
    public function pdf(){
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Data Product'
        ]);
        $studio = studioM::all();
        $pdf = PDF::loadview('studio/studio_pdf', ['studio' => $studio]);
        return $pdf->stream('studio.pdf', compact('log'));
    }
}
