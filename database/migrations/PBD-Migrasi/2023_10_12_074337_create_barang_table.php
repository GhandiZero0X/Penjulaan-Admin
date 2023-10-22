<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id('idbarang')->autoIncrement();
            $table->char('jenis', 1)->nullable();
            $table->string('nama', 45)->nullable();
            $table->unsignedBigInteger('idsatuan'); // Mengubah tipe data kolom "idsatuan" menjadi unsignedBigInteger
            $table->tinyInteger('status')->nullable();
            $table->integer('harga')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idsatuan')
                ->references('idsatuan')
                ->on('satuan')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
