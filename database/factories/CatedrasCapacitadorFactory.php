<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CatedrasCapacitador;
use App\Catedra;
use App\Capacitador;
use Faker\Generator as Faker;

$factory->define(CatedrasCapacitador::class, function (Faker $faker) {
    return [
        'catedra_id' => Catedra::first()->id,
        'capacitador_id' => Capacitador::first()->id
    ];
});
