<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
    use HasFactory;

    protected $fillable = [
        'namapembeli',
        'namabarang',
        'jumlahbarang',
        'bond',
        'tanggal',
    ];
}
