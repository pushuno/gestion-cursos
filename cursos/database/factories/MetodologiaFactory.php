<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Metodologia;
use Faker\Generator as Faker;

$factory->define(Metodologia::class, function (Faker $faker) {
    return [
        'nombre'=> $faker->name
    ];
});
