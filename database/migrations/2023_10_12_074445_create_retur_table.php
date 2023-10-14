<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('retur', function (Blueprint $table) {
            $table->id('idretur');
            $table->timestamp('created_at')->nullable();
            $table->bigInteger('idpenerimaan')->unsigned();
            $table->integer('iduser')->unsigned();

            // Define foreign keys
            $table->foreign('idpenerimaan')->references('idpenerimaan')->on('penerimaan');
            $table->foreign('iduser')->references('iduser')->on('user');

            $table->primary('idretur');
        });
    }

    public function down()
    {
        Schema::dropIfExists('retur');
    }
};
