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
        Schema::create('detail_retur', function (Blueprint $table) {
            $table->id('iddetail_retur')->autoIncrement();
            $table->integer('jumlah');
            $table->string('alasan', 200);
            $table->unsignedBigInteger('idretur');
            $table->unsignedBigInteger('iddetail_penerimaan');
            $table->boolean('status_aktif')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idretur')
                ->references('idretur')
                ->on('retur')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');

            $table->foreign('iddetail_penerimaan')
                ->references('iddetail_pengadaan')
                ->on('detail_pengadaan')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_retur');
    }
};
