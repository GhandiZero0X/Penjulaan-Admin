<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKartuStokTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kartu_stok', function (Blueprint $table) {
            $table->id('idkartu_stok')->autoIncrement();
            $table->char('jenis_transaksi', 1)->nullable();
            $table->integer('masuk')->nullable();
            $table->integer('keluar')->nullable();
            $table->integer('stock')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('idtransaksi')->nullable();
            $table->unsignedBigInteger('idbarang');
            $table->boolean('status_aktif')->default(true);
            $table->softDeletes();

            $table->foreign('idbarang')
                ->references('idbarang')
                ->on('barang')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('kartu_stok');
    }
}
