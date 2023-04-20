<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrecuenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frecuencias', function (Blueprint $table) {
            $table->id('fre_id');
            $table->string('fre_frecuencia');
            $table->unsignedBigInteger('fre_cliente_id');
            $table->foreign('fre_cliente_id')->references('cli_id')->on('clientes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frecuencias');
    }
}
