<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capacitador extends Model
{
    protected $table = 'capacitadores';
    protected $guarded = ['id'];//no permito modificar, contrario a fillable



    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    public function nivel_estudio(){
        return $this->belongsTo(NivelEstudio::class);
    }

    public function fecha_nacimiento($formato = 'd/m/Y'){
        return date($formato,strtotime($this->fecha_nacimiento));
    }

    public function catedras(){
        return $this->hasMany(CatedrasCapacitador::class);
    }

    public function creacion($formato = 'd/m/Y H:i:s'){
        return date($formato,strtotime($this->created_at));
    }

    public function mayuscula($elemento){
        return ucwords($this->$elemento);
    }

}
