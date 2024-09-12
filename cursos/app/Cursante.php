<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursante extends Model
{
    protected $guarded = ['id'];

    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    public function nivel_estudio(){
        return $this->belongsTo(NivelEstudio::class);
    }

    public function fecha_nacimiento($formato = 'd/m/Y'){
        return date($formato,strtotime($this->fecha_nacimiento));
    }

    public function fecha_ingreso($formato = 'd/m/Y'){
        return date($formato,strtotime($this->fecha_ingreso));
    }

    public function inscripciones(){
        return $this->hasMany(Inscripcion::class);
    }

    public function edad(){
        return \Carbon\Carbon::parse($this->fecha_nacimiento)->age;
    }

    public function creacion($formato = 'd/m/Y H:i:s'){
        return date($formato,strtotime($this->created_at));
    }

    public function presentes(){
        return $this->hasMany(Presente::class);
    }

}
