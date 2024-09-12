<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feriado extends Model
{
    protected $casts = [
        'fecha' => 'datetime:d/m/Y',
    ];

    public function fecha($formato = 'd/m/Y'){
        return date($formato,strtotime($this->fecha));
    }
}
