<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Conocimiento;
use App\Curso;
use App\CursosConocimiento;
use Faker\Generator as Faker;

$factory->define(CursosConocimiento::class, function (Faker $faker) {
    return [
        'curso_id' => Curso::first()->id,
        'conocimiento_id' => Conocimiento::first()->id
    ];
});
