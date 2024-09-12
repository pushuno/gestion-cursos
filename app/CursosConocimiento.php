<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursosConocimiento extends Model
{
    protected $table = 'cursos_conocimientos';


    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function conocimiento(){
        return $this->belongsTo(Conocimiento::class);
    }
}
