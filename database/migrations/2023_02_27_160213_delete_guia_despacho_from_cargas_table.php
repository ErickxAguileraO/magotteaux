<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteGuiaDespachoFromCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cargas', function (Blueprint $table) {
            $table->dropColumn('car_guia_despacho');
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
            $table->string('car_guia_despacho')->nullable()->after('car_fecha_salida');
        });
    }
}
