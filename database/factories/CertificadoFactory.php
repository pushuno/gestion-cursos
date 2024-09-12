<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Certificado;
use App\Inscripcion;
use Faker\Generator as Faker;

$factory->define(Certificado::class, function (Faker $faker) {
    return [
        'inscripcion_id' => Inscripcion::first()->id,
        'entregado' => 0
    ];
});
