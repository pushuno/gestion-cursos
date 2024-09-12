<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Catedra;
use App\Fecha;
use Faker\Generator as Faker;

$factory->define(Fecha::class, function (Faker $faker) {
    return [
        'fecha' => $faker->date(),
        'hora_inicio' => '01:00',
        'hora_fin' => '02:00',
        'catedra_id' => Catedra::first()->id
    ];
});
