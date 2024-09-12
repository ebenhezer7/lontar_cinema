<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logM extends Model
{
    use HasFactory;
    protected $table = "log";
    protected $fillable = ["id_user", "activity"];
}
