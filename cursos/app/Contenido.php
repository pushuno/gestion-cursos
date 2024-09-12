<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*


DEPRECADO


*/

class Contenido extends Model
{
    public function fecha(){
        return $this->belongsTo(Fecha::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tipo(){
        return json_decode($this->contenido)->tipo;
    }

    public function texto(){
        return json_decode($this->contenido)->texto;
    }
}
