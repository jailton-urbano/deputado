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
        Schema::table('deputados', function (Blueprint $table) {
            $table->index('nome');
            $table->index('partido');
            $table->index('uf');
        });
    }

    public function down()
    {
        Schema::table('deputados', function (Blueprint $table) {
            $table->dropIndex(['nome']);
            $table->dropIndex(['partido']);
            $table->dropIndex(['uf']);
        });
    }
};
