<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('gasto_deputados', function (Blueprint $table) {
            $table->string('tipo_despesa')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('gasto_deputados', function (Blueprint $table) {
            $table->string('tipo_despesa')->nullable(false)->change();
        });
    }
};
