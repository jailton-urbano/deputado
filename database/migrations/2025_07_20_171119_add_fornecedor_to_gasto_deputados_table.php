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
            $table->string('fornecedor')->after('tipoDespesa');
            $table->string('cnpj_cpf')->after('fornecedor');
        });
    }

    public function down()
    {
        Schema::table('gasto_deputados', function (Blueprint $table) {
            $table->dropColumn('fornecedor');
            $table->dropColumn('cnpj_cpf');
        });
    }
};
