<?php

namespace Database\Seeders;

use App\Models\Destino;
use Illuminate\Database\Seeder;

class DestinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Destino::insert([
            ['des_nombre' => 'Minera A','des_cliente_id' => 1, 'des_estado' => 1],
            ['des_nombre' => 'Minera B','des_cliente_id' => 2, 'des_estado' => 1],
            ['des_nombre' => 'Minera C','des_cliente_id' => 2, 'des_estado' => 1],
            ['des_nombre' => 'Minera D','des_cliente_id' => 3, 'des_estado' => 1],
            ['des_nombre' => 'Minera E','des_cliente_id' => 4, 'des_estado' => 1],
        ]);
    }
}
