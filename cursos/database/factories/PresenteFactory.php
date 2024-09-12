<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cursante;
use App\Presente;
use App\Fecha;
use Faker\Generator as Faker;

$factory->define(Presente::class, function (Faker $faker) {
    return [
       'fecha_id' => Fecha::first()->id,
       'cursante_id' => Cursante::first()->id
    ];
});
