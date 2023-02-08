<?php

use App\Models\Carga;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroGuiaDespachoToCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cargas', function (Blueprint $table) {
            $table->string('car_numero_guia_despacho')->after('car_fecha_salida');
        });

        Carga::query()->update(['car_numero_guia_despacho' => time()]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cargas', function (Blueprint $table) {
            $table->dropColumn('car_numero_guia_despacho');
        });
    }
}
