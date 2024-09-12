<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NivelEstudio;
use Faker\Generator as Faker;

$factory->define(NivelEstudio::class, function (Faker $faker) {
    return [
        'nombre'=> $faker->name
    ];
});
