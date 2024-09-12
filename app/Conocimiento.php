<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conocimiento extends Model
{
    public function creacion($formato = 'd/m/Y H:i:s'){
        return date($formato,strtotime($this->created_at));
    }

    public function cursos(){
        return $this->hasMany(CursosConocimiento::class);
    }
}
