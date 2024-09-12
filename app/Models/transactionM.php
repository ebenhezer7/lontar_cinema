<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionM extends Model
{
    use HasFactory;
    protected $table = "transaction";
    protected $fillable = ["nomor_unik", "nama_pelanggan", "id_produk", "id_kursi", "harga_awal", "uang_bayar", "uang_kembali"];

    public function kursi()
    {
        return $this->belongsTo(kursiM::class, 'id_kursi');
    }
}
