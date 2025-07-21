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
            $table->integer('ano')->nullable()->change();
            $table->integer('mes')->nullable()->change();
            $table->string('fornecedor')->nullable()->default('')->change();
            $table->string('cnpj_cpf')->nullable()->default('')->change();
        });
    }

    public function down()
    {
        Schema::table('gasto_deputados', function (Blueprint $table) {
            $table->integer('ano')->nullable(false)->change();
            $table->integer('mes')->nullable(false)->change();
            $table->string('fornecedor')->nullable(false)->default(null)->change();
            $table->string('cnpj_cpf')->nullable(false)->default(null)->change();
        });
    }
};
