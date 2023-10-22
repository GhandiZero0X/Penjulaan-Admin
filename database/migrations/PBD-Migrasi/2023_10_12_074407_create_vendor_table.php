<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorTable extends Migration
{
    public function up()
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->id('idvendor')->autoIncrement();
            $table->string('nama_vendor', 100)->nullable();
            $table->char('badan_hukum', 1)->nullable();
            $table->char('status', 1)->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendor');
    }
};
