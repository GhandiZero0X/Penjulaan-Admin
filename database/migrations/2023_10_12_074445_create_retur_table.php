<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('retur', function (Blueprint $table) {
            $table->id('idretur')->autoIncrement();
            $table->timestamp('created_at')->nullable();
            $table->unsignedBigInteger('idpenerimaan');
            $table->unsignedBigInteger('iduser');
            $table->boolean('status_aktif')->default(true);
            $table->softDeletes();

            // Define foreign keys
            $table->foreign('idpenerimaan')
                ->references('idpenerimaan')
                ->on('penerimaan')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('iduser')
                ->references('iduser')
                ->on('user')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    public function down()
    {
        Schema::dropIfExists('retur');
    }
};
