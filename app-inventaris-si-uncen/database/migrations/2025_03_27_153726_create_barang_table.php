<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('gambar')->nullable();

            $table->string('satuan')->nullable();
            $table->string('harga_satuan')->nullable();
            $table->string('jumlah_satuan')->nullable();
            $table->string('jumlah_harga')->nullable();

            $table->unsignedBigInteger('kategori_id'); // Harus unsignedBigInteger untuk foreign key
            $table->text('keterangan')->nullable();
            
            $table->timestamps();

            // Tambahkan foreign key constraint
            $table->foreign('kategori_id')->references('id')->on('kategori_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
