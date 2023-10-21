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
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->id('iddetail_penjualan')->autoIncrement();
            $table->integer('harga_satuan');
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->unsignedBigInteger('penjualan_idpenjualan');
            $table->unsignedBigInteger('idbarang');
            $table->boolean('status_aktif')->default(true);
            $table->softDeletes();
            $table->timestamps();

            // Kunci asing ke tabel 'penjualan'
            $table->foreign('penjualan_idpenjualan')
                ->references('idpenjualan')
                ->on('penjualan')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            // Kunci asing ke tabel 'barang'
            $table->foreign('idbarang')
                ->references('idbarang')
                ->on('barang')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
