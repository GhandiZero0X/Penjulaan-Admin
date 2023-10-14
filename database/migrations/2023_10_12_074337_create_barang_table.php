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
            $table->increments('idbarang');
            $table->char('jenis', 1)->nullable();
            $table->string('nama', 45)->nullable();
            $table->integer('idsatuan')->unsigned();
            $table->tinyInteger('status')->nullable();
            $table->integer('harga')->nullable();
            $table->timestamps();
        });

        // Set foreign key constraint to the 'idsatuan' column
        Schema::table('barang', function (Blueprint $table) {
            $table->foreign('idsatuan')->references('idsatuan')->on('satuan')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop the foreign key constraint first
        Schema::table('barang', function (Blueprint $table) {
            $table->dropForeign(['idsatuan']);
        });

        Schema::dropIfExists('barang');
    }
}

