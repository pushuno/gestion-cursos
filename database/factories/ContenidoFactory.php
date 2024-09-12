<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contenido;
use App\Fecha;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Catedra;
use Faker\Generator as Faker;

$factory->define(Contenido::class, function (Faker $faker) {
    return [
        'fecha_id' => Fecha::first()->id,
        'orden' => 1,
        'contenido' => json_encode(array('tipo'=>'texto','texto'=>'Este es un texto de prueba html')),
        'user_id' => Auth::user()->id
    ];
});
