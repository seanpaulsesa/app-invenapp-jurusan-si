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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');

            
            // $table->foreignId('category_id')->constrained()->onDelete('cascade');

            // $table->unsignedBigInteger('category_id')->nullable();
            // $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');

            $table->foreignId('category_id')->nullable()->constrained('categories')->onUpdate('cascade')->onDelete('set null');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
