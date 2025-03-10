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
        Schema::table('usuario_o_a_l_s', function (Blueprint $table) {
            $table->string('vehiculo')->nullable(true)->change();
            $table->string('fecha_activacion')->nullable(true)->change();
            $table->string('programa_oal')->nullable(true)->change();
            $table->string('programa_oal_2')->nullable(true)->change();
            $table->string('programa_oal_3')->nullable(true)->change();
            $table->string('año_programa_oal')->nullable(true)->change();
            $table->string('año_programa_oal_2')->nullable(true)->change();
            $table->string('año_programa_oal_3')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
