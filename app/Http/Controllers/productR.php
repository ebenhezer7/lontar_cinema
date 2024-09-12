<?php

namespace App\Http\Controllers;

use App\Models\productM;
use Illuminate\Http\Request;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;
use PDF;

class productR extends Controller
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
            'activity' => 'User Melihat Halaman produk'
        ]);

        $subtittle = "halaman product";
        $product = productM::all();
        return view('product.product', compact('product', 'subtittle', 'log'));
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
            'activity' => 'User Melihat Halaman tambah produk'
        ]);

        $subtittle = "halaman tambah product";
        $product = productM::all();
        return view('product.product_create', compact('product', 'subtittle', 'log'));
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
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'jam_tayang' => 'required',
        ]);

        // Pengecekan apakah sudah ada produk dengan jam tayang yang sama
        $existingProduct = productM::where('jam_tayang', $request->jam_tayang)->first();

        if ($existingProduct) {
            return back()->withErrors(['jam_tayang' => 'Jam tayang tersebut sudah digunakan oleh produk lain']);
        }

        // Lanjutkan menyimpan data produk jika tidak ada produk dengan jam tayang yang sama
        $product = new productM([
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'jam_tayang' => $request->jam_tayang,
        ]);
        $product->save();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menambahkan Produk ' . $product->nama_produk . ' dengan jam tayang ' . $product->jam_tayang
        ]);

        return redirect()->route('product.index')->with('success', 'Produk Berhasil Ditambah')->with(compact('log'));
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
            'activity' => 'User Melihat Halaman edit produk'
        ]);
        $subtittle = "halaman edit product";
        $product = productM::find($id);
        return view('product.product_edit', compact('product', 'subtittle', 'log'));
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
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'jam_tayang' => 'required',
        ]);
    
        $product = productM::find($id);
    
        // Cek apakah jam_tayang yang diubah tidak bersamaan dengan produk lainnya
        $checkJamTayang = productM::where('jam_tayang', $request->input('jam_tayang'))
            ->where('id', '<>', $id)
            ->exists();
    
        if ($checkJamTayang) {
            // Jika jam tayang sudah digunakan oleh produk lain, berikan pesan error
            return back()->withErrors(['jam_tayang' => 'Jam tayang tersebut sudah digunakan oleh produk lain']);
        }
    
        // Update data produk
        $product->nama_produk = $request->input('nama_produk');
        $product->harga_produk = $request->input('harga_produk');
        $product->jam_tayang = $request->input('jam_tayang');
        $product->update();
    
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mengedit film ' . $product->nama_produk
        ]);
    
        return redirect()->route('product.index')->with('success', 'Data product Berhasil Diedit', compact('log'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = productM::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Produk tidak ditemukan');
        }
    
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus sebuah film ' . $product->nama_produk
        ]);
    
        $product->delete();
    
        return redirect()->route('product.index')->with('success', 'Produk Berhasil Dihapus')->with('log', $log);

    }
    public function pdf(){
        $product = productM::all();
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Data Product'
        ]);
        $pdf = PDF::loadview('product/product_pdf', ['product' => $product]);
        return $pdf->stream('product.pdf', compact('log'));
    }
}
