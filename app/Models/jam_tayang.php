<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jam_tayang extends Model
{
    use HasFactory;
    protected $table = 'jam_tayang'; // Sesuaikan nama tabel sesuai kebutuhan

    protected $fillable = [
        'id_film',
        'waktu_mulai',
        'durasi',
    ];

}
