<?php

use App\Capacitador;
use Illuminate\Database\Seeder;

class CapacitadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Capacitador::class,20)->create();
    }
}
