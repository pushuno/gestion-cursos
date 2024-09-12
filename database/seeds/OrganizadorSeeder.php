<?php

use App\Organizador;
use Illuminate\Database\Seeder;

class OrganizadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Organizador::class)->create([
            'nombre' => 'Cecadi'
        ]);

        factory(Organizador::class)->create([
            'nombre' => 'Das'
        ]);

        factory(Organizador::class)->create([
            'nombre' => 'Diputados'
        ]);

        factory(Organizador::class)->create([
            'nombre' => 'Senado'
        ]);

        factory(Organizador::class)->create([
            'nombre' => 'Biblioteca'
        ]);

        factory(Organizador::class)->create([
            'nombre' => 'Imprenta'
        ]);
    }
}
