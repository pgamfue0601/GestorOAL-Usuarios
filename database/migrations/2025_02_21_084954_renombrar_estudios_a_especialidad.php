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
            $table->renameColumn('estudios', 'especialidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_o_a_l_s', function (Blueprint $table) {
            $table->renameColumn('especialidad', 'estudios');
        });
    }
};
