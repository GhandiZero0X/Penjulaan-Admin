<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detail_penerimaan', function (Blueprint $table) {
            $table->id('iddetail_penerimaan');
            $table->integer('harga_satuan');
            $table->integer('jumlah');
            $table->integer('sub_total');
            $table->unsignedBigInteger('idbarang');
            $table->unsignedBigInteger('idpengadaan');

            // Kunci asing ke tabel "barang"
            $table->foreign('idbarang')->references('idbarang')->on('barang')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            // Kunci asing ke tabel "pengadaan"
            $table->foreign('idpengadaan')->references('idpengadaan')->on('pengadaan')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('detail_penerimaan');
    }
}
