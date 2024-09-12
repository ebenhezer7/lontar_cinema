<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kursiM extends Model
{
    use HasFactory;
    protected $table = "kursi";
    protected $fillable = ["kode_kursi"];
    
}
