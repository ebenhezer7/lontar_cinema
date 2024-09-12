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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->integer('harga_produk')->dafault(0);
            $table->enum('jam_tayang', ['09.00 - 11.00', '11.00 - 13.00', '13.00 - 15.00', '15.00 - 17.00', '17.00 - 19.00', '19.00 - 21.00', '21.00 - 23.00']);            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
