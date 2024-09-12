<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatedrasCapacitador extends Model
{
    protected $table = "catedras_capacitadores";

    public function capacitador(){
        return $this->belongsTo(Capacitador::class);
    }

    public function catedra(){
        return $this->belongsTo(Catedra::class);
    }
}
