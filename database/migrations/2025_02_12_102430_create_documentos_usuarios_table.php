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
        Schema::create('documentos_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_documento');
            $table->string('ruta_documento');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuario_o_a_l_s')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_usuarios');
    }
};
