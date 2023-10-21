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
        Schema::create('detail_pengadaan', function (Blueprint $table) {
            $table->id('iddetail_pengadaan')->autoIncrement();
            $table->unsignedBigInteger('harga_satuan');
            $table->integer('jumlah');
            $table->unsignedBigInteger('sub_total');
            $table->unsignedBigInteger('idbarang');
            $table->unsignedBigInteger('idpengadaan');
            $table->boolean('status_aktif')->default(true);
            $table->softDeletes();

            $table->foreign('idbarang', 'fk_detail_pengadaan_idbarang')
                ->references('idbarang')
                ->on('barang')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
            $table->foreign('idpengadaan', 'fk_detail_pengadaan_idpengadaan')
                ->references('idpengadaan')
                ->on('pengadaan')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengadaan');
    }
};
