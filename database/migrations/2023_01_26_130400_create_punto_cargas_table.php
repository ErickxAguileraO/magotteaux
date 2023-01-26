<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntoCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punto_cargas', function (Blueprint $table) {
            $table->id('puc_id');
            $table->string('puc_nombre');
            $table->boolean('puc_estado')->default(true);
            $table->unsignedBigInteger('puc_planta_id');
            $table->softDeletes();

            $table->foreign('puc_planta_id')->references('pla_id')->on('plantas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('punto_cargas');
    }
}
