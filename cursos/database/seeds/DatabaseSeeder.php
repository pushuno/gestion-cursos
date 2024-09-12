<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->clear_db([
            'metodologias',
            'nivel_estudios',
            'organizadores',
            'sectores',
            'capacitadores',
            'cursantes',
            'conocimientos'
        ]);



        $this->call(MetodologiaSeeder::class);
        $this->call(NivelEstudioSeeder::class);
        $this->call(OrganizadorSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(CursanteSeeder::class);
        $this->call(CapacitadorSeeder::class);
        $this->call(ConocimientoSeeder::class);
    }

    public function clear_db($array){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach($array as $item){
            DB::table($item)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
