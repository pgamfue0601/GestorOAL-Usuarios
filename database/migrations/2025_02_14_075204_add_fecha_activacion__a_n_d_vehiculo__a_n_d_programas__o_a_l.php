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
            $table->text('vehiculo')->after('carnet');
            $table->text('fecha_activacion')->after('dni');
            $table->string('programa_oal');
            $table->string('programa_oal_2')->after('programa_oal');
            $table->string('programa_oal_3')->after('programa_oal_2');
            $table->string('año_programa_oal')->after('programa_oal');
            $table->string('año_programa_oal_2')->after('programa_oal_2');
            $table->string('año_programa_oal_3')->after('programa_oal_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_o_a_l_s', function (Blueprint $table) {
            $table->dropColumn(['programa_oal', 'programa_oal_2', 'programa_oal_3', 'año_programa_oal', 'año_programa_oal_2', 'año_programa_oal_3', 'fecha_activacion', 'vehiculo']);
        });
    }
};
