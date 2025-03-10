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
        Schema::create('usuario_o_a_l_s', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->text('apellidos');
            $table->text('dni');
            $table->text('edad');
            $table->text('telefono');
            $table->text('ocupacion');
            $table->text('ocupacion2');
            $table->text('ocupacion3');
            $table->text('estudios');
            $table->text('disponibilidad');
            $table->text('carnet');
            $table->text('localidad');
            $table->text('observaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_o_a_l_s');
    }
};
