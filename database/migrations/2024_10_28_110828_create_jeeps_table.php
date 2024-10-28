<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jeeps', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengguna');
            $table->string('nama_pengguna');
            $table->string('notelp_pengguna');
            $table->string('alamat_pengguna');
            $table->string('email_pengguna');
            $table->string('password_pengguna');
            $table->string('id_driver');
            $table->string('nama_driver');
            $table->string('notelp_driver');
            $table->string('email_driver');
            $table->string('password_driver');
            $table->string('id_admin');
            $table->string('nama_admin');
            $table->string('password_admin');
            $table->string('id_transaksi');
            $table->dateTime('tgl_pemesanan');
            $table->enum('status_pemesanan', ['pending', 'proses', 'selesai', 'batal']);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jeeps');
    }
};
