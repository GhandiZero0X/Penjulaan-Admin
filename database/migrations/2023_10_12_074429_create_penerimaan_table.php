<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanTable extends Migration
{
    public function up()
    {
        Schema::create('penerimaan', function (Blueprint $table) {
            $table->id('idpenerimaan');
            $table->timestamp('created_at')->nullable();
            $table->char('status', 1)->nullable();
            $table->bigInteger('idpengadaan')->unsigned();
            $table->bigInteger('iduser')->unsigned();
            $table->foreign('idpengadaan')->references('idpengadaan')->on('pengadaan')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('iduser')->references('iduser')->on('user')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penerimaan');
    }
}
