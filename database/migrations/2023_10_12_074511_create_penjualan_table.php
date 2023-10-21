<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('idpenjualan')->autoIncrement();
            $table->timestamp('created_at')->nullable();
            $table->integer('subtotal_nilai')->nullable();
            $table->integer('ppn')->nullable();
            $table->integer('total_nilai')->nullable();
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('idmargin_penjualan');
            $table->boolean('status_aktif')->default(true);
            $table->softDeletes();

            // Define foreign keys
            $table->foreign('iduser')
                ->references('iduser')
                ->on('user')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('idmargin_penjualan')
                ->references('idmargin_penjualan')
                ->on('margin_penjualan')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
};
