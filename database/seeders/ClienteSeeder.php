<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::insert([
            ['cli_nombre' => 'Aeurus', 'cli_identificacion' => 11111, 'cli_pais_id' => 1, 'cli_estado' => 1],
            ['cli_nombre' => 'BHP Mineral', 'cli_identificacion' => 22222, 'cli_pais_id' => 1, 'cli_estado' => 1],
            ['cli_nombre' => 'Aeurus 2', 'cli_identificacion' => 33333, 'cli_pais_id' => 1, 'cli_estado' => 1],
            ['cli_nombre' => 'Aeurus 3', 'cli_identificacion' => 44444, 'cli_pais_id' => 2, 'cli_estado' => 1],
            ['cli_nombre' => 'Aeurus 4', 'cli_identificacion' => 55555, 'cli_pais_id' => 2, 'cli_estado' => 1],
        ]);
    }
}
