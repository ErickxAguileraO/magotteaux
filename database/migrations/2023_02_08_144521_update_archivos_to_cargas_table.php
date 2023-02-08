<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateArchivosToCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cargas', function (Blueprint $table) {
            $table->string('car_guia_despacho')->nullable()->change();
            $table->string('car_certificado_calidad')->nullable()->change();
            $table->string('car_imagen_patente')->nullable()->change();
            $table->string('car_imagen_carga')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cargas', function (Blueprint $table) {
            $table->string('car_guia_despacho')->change();
            $table->string('car_certificado_calidad')->change();
            $table->string('car_imagen_patente')->change();
            $table->string('car_imagen_carga')->change();
        });
    }
}
