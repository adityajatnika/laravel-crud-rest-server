<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $table = 'keluarga';

    protected $fillable = [
        'nama',
        'status_keluarga',
        'jenis_kelamin',
        'umur',
        'pendidikan',
        'pendapatan',
    ];
}
