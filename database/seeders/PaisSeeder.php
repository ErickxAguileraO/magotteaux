<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::insert([
            ['pai_nombre' => 'Chile', 'pai_estado' => 1],
            ['pai_nombre' => 'Argentina', 'pai_estado' => 1],
            ['pai_nombre' => 'Perú', 'pai_estado' => 1],
        ]);
    }
}
