<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorTable extends Migration
{
    public function up()
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->id('idvendor'); // Ini akan membuat kolom "id" yang auto-increment
            $table->string('nama_vendor', 100)->nullable();
            $table->char('badan_hukum', 1)->nullable();
            $table->char('status', 1)->nullable();
            $table->timestamps(); // Ini akan membuat kolom "created_at" dan "updated_at"
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendor');
    }
}
