<?php

use App\Models\Carga;
use App\Models\Chofer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenToCargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cargas', function (Blueprint $table) {
            $table->string('car_token')->nullable()->after('car_email_enviado');
        });

        Carga::query()->update(['car_token' => time()]);

        Schema::table('cargas', function (Blueprint $table) {
            $table->string('car_token')->nullable(false)->change();
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
            $table->dropColumn('car_token');
        });
    }
}
