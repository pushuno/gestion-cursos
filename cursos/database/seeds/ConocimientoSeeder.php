<?php

use Illuminate\Database\Seeder;
use App\Conocimiento;

class ConocimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Conocimiento::class)->create([
            'nombre' => 'Excel'
        ]);

        factory(Conocimiento::class)->create([
            'nombre' => 'Zoom'
        ]);

        factory(Conocimiento::class)->create([
            'nombre' => 'Word'
        ]);
    }
}
