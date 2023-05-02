<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banco_id')->nullable(false);
            $table->string('tipo',1)->nullable(false);      //'C'orrente ou 'P'oupança ou 'S'alário
            $table->string('numero',10)->nullable(false);
            $table->float('saldo',15,2)->nullable(false);
            $table->timestamps();

            $table->foreign('banco_id')->references('id')->on('bancos');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contas');
    }
}
