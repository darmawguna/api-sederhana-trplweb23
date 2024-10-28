<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->string('harga', );
            $table->string('nama_kost');
            $table->string('fasilitas');
            $table->text('alamat');
            $table->string('jenis_kost');
            $table->string('no_rekening');
            $table->string('no_wa');
            $table->text('komentar')->nullable();
            $table->text('username')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosts');
    }
};
