<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studioM extends Model
{
    use HasFactory;
    protected $table = "studio";
    protected $fillable = ["studio"];
}
