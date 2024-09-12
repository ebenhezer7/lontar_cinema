<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jam_tayang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_film');
            $table->time('waktu_mulai'); // Menggunakan tipe data time untuk hanya jam
            $table->integer('durasi');   // durasi dalam menit
            $table->timestamps();
        
            $table->foreign('id_film')->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jam_tayang');
    }
};
