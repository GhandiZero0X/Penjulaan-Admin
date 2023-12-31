<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->id('idpengadaan')->autoIncrement();
            $table->timestamp('timestamp')->nullable();
            $table->unsignedBigInteger('user_iduser');
            $table->char('status', 1)->nullable();
            $table->unsignedBigInteger('vendor_idvendor');
            $table->integer('subtotal_nilai')->nullable();
            $table->integer('ppn')->nullable();
            $table->integer('total_nilai')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->softDeletes();


            $table->foreign('user_iduser', 'fk_pengadaan_user_iduser')
                ->references('iduser')
                ->on('user')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
            $table->foreign('vendor_idvendor', 'fk_pengadaan_vendor_idvendor')
                ->references('idvendor')
                ->on('vendor')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('pengadaan');
    }
};
