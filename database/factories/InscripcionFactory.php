<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Inscripcion;
use Faker\Generator as Faker;
use App\Cursante;
use App\Catedra;

$factory->define(Inscripcion::class, function (Faker $faker) {
    return [
       'catedra_id' => Catedra::first()->id,
       'cursante_id' => Cursante::first()->id
    ];
});
