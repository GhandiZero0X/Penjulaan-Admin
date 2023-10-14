<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('idpenjualan');
            $table->timestamp('created_at')->nullable();
            $table->integer('subtotal_nilai')->nullable();
            $table->integer('ppn')->nullable();
            $table->integer('total_nilai')->nullable();
            $table->integer('iduser');
            $table->integer('idmargin_penjualan');

            // Definisi kunci asing
            $table->foreign('iduser')->references('iduser')->on('user');
            $table->foreign('idmargin_penjualan')->references('idmargin_penjualan')->on('margin_penjualan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
}
