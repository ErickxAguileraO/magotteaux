<?php

use App\Models\Chofer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmpresaIdToChoferesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('choferes', function (Blueprint $table) {
            $table->unsignedBigInteger('cho_empresa_id')->after('cho_estado');
            $table->softDeletes();
        });

        Chofer::query()->update(['cho_empresa_id' => 1]);

        Schema::table('choferes', function (Blueprint $table) {
            $table->foreign('cho_empresa_id')->references('emt_id')->on('empresa_transportes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('choferes', function (Blueprint $table) {
            $table->dropForeign('choferes_cho_empresa_id_foreign');
            $table->dropColumn('cho_empresa_id');
            $table->dropSoftDeletes();
        });
    }
}
