<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MetodologiaSeeder;

class Curso extends Model
{
    protected $guarded = ['id'];

    public function catedra(){
        return $this->hasMany(Catedra::class);
    }

    public function metodologia(){
        return $this->belongsTo(Metodologia::class);
    }

    public function conocimientos(){
        return $this->hasMany(CursosConocimiento::class);
    }

    public function creacion($formato = 'd/m/Y H:i:s'){
        return date($formato,strtotime($this->created_at));
    }

    public function eje(){
        return $this->belongsTo(Eje::class);
    }
}
