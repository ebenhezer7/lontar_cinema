<?php

namespace App\Http\Controllers;

use App\Models\jam_tayang;
use App\Models\kursiM;
use App\Models\studioM;
use Illuminate\Http\Request;
use App\Models\LogM;
use App\Models\productM;
use Illuminate\Support\Facades\Auth;
use App\Models\transactionM;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class transactionR extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman transaksi'
        ]);
        $query = transactionM::select('transaction.*', 'product.*', 'kursi.*', 'transaction.id AS id_trans', 'transaction.created_at AS tanggal')
        ->join('product', 'product.id', '=', 'transaction.id_produk')
        ->join('kursi', 'kursi.id', '=', 'transaction.id_kursi')
        ->orderBy('transaction.id', 'desc');
        if ($request->filled('start_date') && $request->filled('end_date')) {
            // Jika kedua tanggal diisi, cari transaksi antara rentang tanggal
            $query->whereDate('transaction.created_at', '>=', $request->start_date)
            ->whereDate('transaction.created_at', '<=', $request->end_date);
        } elseif ($request->filled('start_date')) {
            // Jika hanya tanggal awal diisi, cari transaksi pada tanggal awal
            $query->whereDate('transaction.created_at', '=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            // Jika hanya tanggal akhir diisi, cari transaksi pada tanggal akhir
            $query->whereDate('transaction.created_at', '=', $request->end_date);
        }

        $TransactionsM = $query->get();

        $subtittle = "halaman transaksi";
        return view('transaction.transaction', compact('TransactionsM', 'subtittle', 'log'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman transaksi'
        ]);

        // Ambil produk, kursi, dan jamTayangs
        $produk = productM::all();
        $kursi = kursiM::all();
        $subtittle = "halaman transaksi";

        return view('transaction.transaction_create', compact('kursi', 'produk', 'subtittle', 'log'));
    }

    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $produk = productM::where("id", $request->input('id_produk'))->first();
        $kursi = kursiM::where("id", $request->input('id_kursi'))->first();

        $request->validate([
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'id_kursi' => 'required',
            'uang_bayar' => 'required'
        ]);

        // Cek apakah kursi yang dipilih 'booked'
        if ($kursi->status == 'booked') { 
            return redirect()->back()->with('error', 'Maaf, kursi ini sudah dipesan. Silakan pilih kursi lain.');
        }
       

        $transaction = new TransactionM;
        $transaction -> nomor_unik = $request->input('nomor_unik');
        $transaction -> nama_pelanggan = $request->input('nama_pelanggan');
        $transaction -> id_produk = $request->input('id_produk');
        $transaction -> id_kursi = $request->input('id_kursi'); 
        $transaction->harga_awal = $produk->harga_produk;
        $transaction -> uang_bayar = $request->input('uang_bayar');
        $transaction -> uang_kembali = $request->input('uang_bayar') - $produk->harga_produk;

        if ($transaction->uang_bayar < $produk->harga_produk) { 
            $error = 'uang anda tidak cukup';
            return redirect()->back()->with('error', 'Maaf, uang bayar tidak cukup.')->with(compact('error'));
        }

        $transaction->save();

        $kursi->status = 'booked';
        $kursi->save();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User melihat halaman transaksi dengan ' . $transaction->id . ' dengan nama ' . $transaction->nama_pelanggan
        ]);

        return redirect()->route('transaction.index')->with('success', 'transaksi berhasil ditambahkan', compact('log'));

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
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User melihat halaman edit transaksi',
        ]);

        $subtittle = "Edit Product Transaction";
        $transaction = transactionM::find($id);
        $product = productM::all();
        $kursi = kursiM::all();

        return view('transaction.transaction_edit', compact('subtittle','product','transaction', 'kursi'));

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
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'id_kursi' => 'required',
            'uang_bayar' => 'required',
        ]);
    
        // Ambil data transaksi yang akan diubah
        $transaction = transactionM::find($id);
        $product = productM::where("id", $request->input('id_produk'))->first();
    
        // Ambil data kursi yang akan diubah
        $selected_seat = kursiM::where("id", $request->input('id_kursi'))->first();
    
        // Cek apakah kursi yang dipilih saat ini 'free'
        if ($selected_seat->status == 'free') {
            // Ubah status kursi yang sebelumnya dipilih menjadi 'free'
            $previous_seat = kursiM::find($transaction->id_kursi);
            $previous_seat->status = 'free';
            $previous_seat->save();
    
            // Ubah status kursi yang baru dipilih menjadi 'booked'
            $selected_seat->status = 'booked';
            $selected_seat->save();
    
            // Perbarui data transaksi
            $transaction->nomor_unik = $request->input('nomor_unik');
            $transaction->nama_pelanggan = $request->input('nama_pelanggan');
            $transaction->id_produk = $request->input('id_produk');
            $transaction->id_kursi = $request->input('id_kursi');
            $transaction->uang_bayar = $request->input('uang_bayar');
            $transaction->save();
    
            // Catat log
            $log = LogM::create([
                'id_user' => Auth::user()->id,
                'activity' => 'User mengedit data transaksi dengan ' . $transaction->id . 'atas nama' . $transaction->nama_pelanggan
            ]);
    
            return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil diperbarui')->with(compact('log'));
        } else {
            return redirect()->back()->with('error', 'Kursi yang dipilih tidak tersedia');
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
        // Cari transaksi yang akan dihapus
        $transaction = TransactionM::find($id);

        // Cek apakah transaksi ditemukan
        if (!$transaction) {
            return redirect()->route('transaction.index')->with('error', 'Transaksi tidak ditemukan');
        }

        // Ambil kursi terkait
        $kursi = kursiM::find($transaction->id_kursi);

        // Ubah status kursi menjadi 'free'
        $kursi->status = 'free';
        $kursi->save();

        // Hapus transaksi
        $transaction->delete();


        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User menghapus data transaksi dengan ' . $transaction->id . 'atas nama' . $transaction->nama_pelanggan
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dihapus')->with(compact('log'));
        
    }
    public function pdf(){
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Data transaksi'
        ]);
       
        $transaction = transactionM::select('transaction.*', 'product.*', 'kursi.*', 'transaction.id AS id_trans', 'transaction.created_at AS tanggal')
        ->join('product', 'product.id', '=', 'transaction.id_produk')
        ->join('kursi', 'kursi.id', '=', 'transaction.id_kursi')
        ->orderBy('transaction.id', 'desc')->get();

        $totalpemasukan = DB::table('transaction')->sum(DB::raw('uang_bayar - uang_kembali'));

        $pdf = PDF::loadview('transaction/transaction_pdf', ['transaction' => $transaction], ['totalpemasukan' => $totalpemasukan]);
        return $pdf->stream('transaction.pdf', compact('log', 'totalpemasukan'));
    }

    public function pdf2($id){
        // Ambil data transaksi dan produk berdasarkan ID
        $transaction = transactionM::select('transaction.*', 'product.*', 'kursi.*', 'transaction.id AS id_trans')
        ->join('product', 'product.id', '=', 'transaction.id_produk')
        ->join('kursi', 'kursi.id', '=', 'transaction.id_kursi')
        ->where('transaction.id', $id)->first();

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User mencetak struk transaksi dengan ' . $transaction->id . ' atas nama ' . $transaction->nama_pelanggan
        ]);
        
        if ($transaction) {
            // Jika data ditemukan, buat PDF
            $pdf = PDF::loadView('transaction/transaction_struk', ['transaction' => $transaction, 'log' => $log]);
            return $pdf->stream('transaction.struk' . $id . '.pdf');
        } else {
            // Jika data tidak ditemukan, Anda dapat mengembalikan respons yang sesuai, misalnya, halaman 404.
            return response('Data transaksi tidak ditemukan', 404);
        }
    }

    public function all() {
        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User melihat halaman cari pertanggal transaksi'
        ]);
         $subtittle = "Laporan transaksi pertanggal";
         return view('transaction.transaction_pilih_tgl', compact('subtittle', 'log'));
     }

    public function pertanggal(Request $request) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $transaction = transactionM::select('transaction.*', 'product.*', 'kursi.*', 'transaction.id AS id_trans', 'transaction.created_at AS tanggal')
            ->join('product', 'product.id', '=', 'transaction.id_produk')
            ->join('kursi', 'kursi.id', '=', 'transaction.id_kursi')
            ->whereBetween('transaction.created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
            ->get();

        // Tampilkan data untuk memastikan apakah berhasil diambil

        $totalIncome = $transaction->sum(function ($transaction) {
            return $transaction->uang_bayar - $transaction->uang_kembali;
        });

        $log = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User mencetak laporan pertanggal transaksi dari tanggal ' . $start_date . ' sampai ' . $end_date
        ]);

        $pdf = PDF::loadview('transaction.transaction_pdf_pertanggal', ['transaction' => $transaction, 'totalIncome' => $totalIncome, 'start_date' => $start_date, 'end_date' => $end_date, 'log' => $log]);
        return $pdf->stream('Laporan.pdf');
    }

}
