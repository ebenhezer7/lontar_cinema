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
    public function up() : void
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_kursi');
            $table->string('nama_pelanggan');
            $table->string('nomor_unik', 10);
            $table->integer('harga_awal');
            $table->integer('uang_bayar');
            $table->integer('uang_kembali');
            $table->timestamps();

            $table->foreign('id_produk')->references('id')->on('product')->onDelete('cascade');
            $table->foreign('id_kursi')->references('id')->on('kursi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('transaction');
    }
};
