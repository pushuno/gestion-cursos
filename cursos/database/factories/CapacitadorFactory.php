<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Capacitador;
use App\NivelEstudio;
use App\Sector;
use Faker\Generator as Faker;

$factory->define(Capacitador::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'fecha_nacimiento' => $faker->date(),
        'numero_documento' => '33597840',
        'nivel_estudio_id' => NivelEstudio::first()->id,
        'titulo' => $faker->jobTitle,
        'email' => $faker->email,
        'telefono' => '45454545',
        'sector_id' => Sector::first()->id,
        'legajo' => $faker->biasedNumberBetween(300000,400000),
        'oficina' => $faker->jobTitle,
        'categoria' => $faker->biasedNumberBetween(1,14),
        'afiliado' => $faker->biasedNumberBetween(13000,36000),
        'afiliado_barra' => $faker->randomElement($array = array ('1','2','10','20','30','31','11','21','6'))
    ];
});
