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
        Schema::create('detail_pengadaan', function (Blueprint $table) {
            $table->id('iddetail_pengadaan');
            $table->unsignedBigInteger('harga_satuan');
            $table->integer('jumlah');
            $table->unsignedBigInteger('sub_total');
            $table->unsignedBigInteger('idbarang');
            $table->unsignedBigInteger('idpengadaan');

            $table->foreign('idbarang')->references('idbarang')->on('barang');
            $table->foreign('idpengadaan')->references('idpengadaan')->on('pengadaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('detail_pengadaan');
    }
};
