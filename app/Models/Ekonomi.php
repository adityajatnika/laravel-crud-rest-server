<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekonomi extends Model
{
    use HasFactory;

    protected $table = 'ekonomi';

    protected $fillable = [
        'total_pendapatan',
        'pendapatan_usaha',
        'pendapatan_kiriman',
        'subsidi_pemerintah',
    ];
}
