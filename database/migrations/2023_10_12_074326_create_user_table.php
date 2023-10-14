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
        Schema::create('user', function (Blueprint $table) {
            $table->id('iduser');
            $table->string('username', 45)->nullable();
            $table->string('password', 100)->nullable();
            $table->unsignedBigInteger('idrole');
            $table->timestamps();

            $table->primary('iduser');
            $table->index('idrole', 'fk_user_role_idx');

            $table->foreign('idrole', 'fk_user_role')
                ->references('idrole')
                ->on('role')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
