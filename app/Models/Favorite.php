<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = "favorities";

    protected $fillable = [
        'id_usuario',
        'ref_api',
    ];
}
