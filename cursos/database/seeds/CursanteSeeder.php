<?php

use App\Cursante;
use Illuminate\Database\Seeder;

class CursanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cursante::class,7)->create();
    }
}
