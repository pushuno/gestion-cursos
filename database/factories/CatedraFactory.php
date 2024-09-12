<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Catedra;
use App\Curso;
use Faker\Generator as Faker;

$factory->define(Catedra::class, function (Faker $faker) {
    return [
        'curso_id' => Curso::first(),
        'fecha_inicio' => $faker->date(),
        'fecha_fin' => $faker->date(),
        'cupo' => $faker->biasedNumberBetween(1,30),
        'clases_minimas' => $faker->biasedNumberBetween(1,13)
    ];
});
