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
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('gambar')->nullable();
            $table->unsignedBigInteger('kategori_id'); // Harus unsignedBigInteger untuk foreign key
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Tambahkan foreign key constraint
            $table->foreign('kategori_id')->references('id')->on('kategori_ruangan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruangan');
    }
};
