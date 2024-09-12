<?php

use App\NivelEstudio;
use Illuminate\Database\Seeder;

class NivelEstudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(NivelEstudio::class)->create([
            'nombre' => 'Primario'
        ]);

        factory(NivelEstudio::class)->create([
            'nombre' => 'Secundario'
        ]);

        factory(NivelEstudio::class)->create([
            'nombre' => 'Terciario'
        ]);

        factory(NivelEstudio::class)->create([
            'nombre' => 'Universitario'
        ]);
    }
}
