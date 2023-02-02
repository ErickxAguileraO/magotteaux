<?php

use App\Models\Destino;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClienteIdAndDeletedAtToDestinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->unsignedBigInteger('des_cliente_id');
            $table->softDeletes();
        });

        Destino::query()->update(['des_cliente_id' => 1]);

        Schema::table('destinos', function (Blueprint $table) {
            $table->foreign('des_cliente_id')->references('cli_id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->dropForeign('destinos_des_cliente_id_foreign');
            $table->dropColumn('des_cliente_id');
            $table->dropSoftDeletes();
        });
    }
}
