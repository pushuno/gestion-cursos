<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Curso;
use App\Metodologia;
use Faker\Generator as Faker;

$factory->define(Curso::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'descripcion' => $faker->text,
        'metodologia_id' => Metodologia::first()->id,
        'duracion_leyenda' => '6 clases de 2hs',
        'duracion_horas' => $faker->biasedNumberBetween(4,18)
    ];
});
