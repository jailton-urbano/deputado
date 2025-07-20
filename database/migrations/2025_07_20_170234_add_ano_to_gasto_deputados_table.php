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
         Schema::table('gasto_deputados', function (Blueprint $table) {
            $table->integer('ano')->after('deputado_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gasto_deputados', function (Blueprint $table) {
           $table->integer('ano')->after('deputado_id');
        });
    }
};
