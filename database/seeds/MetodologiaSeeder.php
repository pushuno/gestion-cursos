<?php

use App\Metodologia;
use Illuminate\Database\Seeder;

class MetodologiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Metodologia::class)->create([
            'nombre' => 'Teorico'
        ]);

        factory(Metodologia::class)->create([
            'nombre' => 'Práctico'
        ]);

        factory(Metodologia::class)->create([
            'nombre' => 'Teorico/Práctico'
        ]);

        factory(Metodologia::class)->create([
            'nombre' => 'Online'
        ]);
    }
}
