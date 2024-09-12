<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Capacitador;
use App\Curso;
use App\CursosOrganizador;
use Faker\Generator as Faker;

$factory->define(CursosOrganizador::class, function (Faker $faker) {
    return [
        'curso_id' => Curso::first()->id,
        'capacitador_id' => Capacitador::first()->id
    ];
});
