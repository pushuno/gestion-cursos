<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Conocimiento;
use Faker\Generator as Faker;

$factory->define(Conocimiento::class, function (Faker $faker) {
    return [
        'nombre' => $faker->jobTitle
    ];
});
