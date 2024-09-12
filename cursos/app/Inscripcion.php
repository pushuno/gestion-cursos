<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';

    public function cursante(){
        return $this->belongsTo(Cursante::class);
    }

    public function catedra(){
        return $this->belongsTo(Catedra::class);
    }

    public function creacion($formato = 'd/m/Y H:i:s'){
        return date($formato,strtotime($this->created_at));
    }

}
