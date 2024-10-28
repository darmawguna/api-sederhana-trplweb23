<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'harga',
        'nama_kost',
        'fasilitas',
        'alamat',
        'jenis_kost',
        'no_rekening',
        'no_wa',
        'komentar',
        'username',
        'foto',
    ];

}
