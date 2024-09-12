<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feriado;
use Faker\Generator as Faker;

$factory->define(Feriado::class, function (Faker $faker) {
    return [
        'fecha' => $faker->unique()->date()
    ];
});
