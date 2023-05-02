<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conta_id')->nullable(false);
            $table->string('tipo',1)->nullable(false);   //'E'ntrada ou 'S'aída            
            $table->date('data')->nullable(false);
            $table->float('valor',15,2);
            $table->string('descricao', 60)->nullable(false);
            $table->timestamps();

            $table->foreign('conta_id')->references('id')->on('contas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lancamentos');
    }
}
