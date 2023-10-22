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
        Schema::create('margin_penjualan', function (Blueprint $table) {
            $table->id('idmargin_penjualan')->autoIncrement();
            $table->timestamp('created_at')->nullable();
            $table->double('persen')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->unsignedBigInteger('iduser');
            $table->boolean('status_aktif')->default(true);
            $table->softDeletes();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('iduser')
                ->references('iduser')
                ->on('user')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('margin_penjualan');
    }
};
