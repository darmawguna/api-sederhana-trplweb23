<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jeep extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pengguna',
        'nama_pengguna',
        'notelp_pengguna',
        'alamat_pengguna',
        'email_pengguna',
        'password_pengguna',
        'id_driver',
        'nama_driver',
        'notelp_driver',
        'email_driver',
        'password_driver',
        'id_admin',
        'nama_admin',
        'password_admin',
        'id_transaksi',
        'tgl_pemesanan',
        'status_pemesanan',
    ];

}
