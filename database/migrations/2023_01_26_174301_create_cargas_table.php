<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargas', function (Blueprint $table) {
            $table->id('car_id');
            $table->dateTime('car_fecha_carga');
            $table->dateTime('car_fecha_salida');
            $table->string('car_guia_despacho');
            $table->string('car_certificado_calidad');
            $table->string('car_imagen_patente');
            $table->string('car_imagen_carga');
            $table->boolean('car_email_enviado')->default(false);
            $table->unsignedBigInteger('car_empresa_id');
            $table->unsignedBigInteger('car_planta_id');
            $table->unsignedBigInteger('car_tipo_id');
            $table->unsignedBigInteger('car_tamano_bola_id');
            $table->unsignedBigInteger('car_patente_id');
            $table->unsignedBigInteger('car_chofer_id');
            $table->unsignedBigInteger('car_cliente_id');
            $table->unsignedBigInteger('car_destino_id');
            $table->unsignedBigInteger('car_punto_carga_id');
            $table->unsignedBigInteger('car_usuario_id');

            $table->foreign('car_empresa_id')->references('emt_id')->on('empresa_transportes');
            $table->foreign('car_planta_id')->references('pla_id')->on('plantas');
            $table->foreign('car_tipo_id')->references('tic_id')->on('tipo_cargas');
            $table->foreign('car_tamano_bola_id')->references('tab_id')->on('tamano_bolas');
            $table->foreign('car_patente_id')->references('pat_id')->on('patentes');
            $table->foreign('car_chofer_id')->references('cho_id')->on('choferes');
            $table->foreign('car_cliente_id')->references('cli_id')->on('clientes');
            $table->foreign('car_destino_id')->references('des_id')->on('destinos');
            $table->foreign('car_punto_carga_id')->references('puc_id')->on('punto_cargas');
            $table->foreign('car_usuario_id')->references('usu_id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargas');
    }
}
