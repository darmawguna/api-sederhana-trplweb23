<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('makanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_makanan');
            $table->integer('price');
            $table->string('desc', 500);
            $table->string('category');
            $table->integer('stok');
            $table->string('foto_makanan')->nullable();
            $table->string('sku')->unique();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('makanans');
    }
};
