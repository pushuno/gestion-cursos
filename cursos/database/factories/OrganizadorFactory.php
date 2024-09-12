<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Organizador;
use Faker\Generator as Faker;

$factory->define(Organizador::class, function (Faker $faker) {
    return [
        'nombre' => $faker->randomElement($array = array ('Diputados','Senado','Externo','Biblioteca','Imprenta'))
    ];
});
