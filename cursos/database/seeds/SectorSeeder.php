<?php

use Illuminate\Database\Seeder;
use App\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Sector::class)->create([
            'nombre' => 'Das'
        ]);

        factory(Sector::class)->create([
            'nombre' => 'Diputados'
        ]);

        factory(Sector::class)->create([
            'nombre' => 'Senado'
        ]);

        factory(Sector::class)->create([
            'nombre' => 'Biblioteca'
        ]);

        factory(Sector::class)->create([
            'nombre' => 'Imprenta'
        ]);

        factory(Sector::class)->create([
            'nombre' => 'Voluntario'
        ]);

        factory(Sector::class)->create([
            'nombre' => 'Familiar'
        ]);
    }
}
