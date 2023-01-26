<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patentes', function (Blueprint $table) {
            $table->id('pat_id');
            $table->string('pat_patente');
            $table->boolean('pat_estado')->default(true);
            $table->unsignedBigInteger('pat_empresa_id');

            $table->foreign('pat_empresa_id')->references('emt_id')->on('empresa_transportes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patentes');
    }
}
