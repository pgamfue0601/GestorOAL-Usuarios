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
            $table->string('sexo')->nullable(true)->change();
            $table->string('discapacidad')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_o_a_l_s', function (Blueprint $table) {
            $table->dropColumn('sexo');
            $table->dropColumn('discapacidad');
        });
    }
};
