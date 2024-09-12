<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    protected $fillable = ['hora_inicio','hora_fin'];

    public function fecha($formato = 'd/m/Y'){
        return date($formato,strtotime($this->fecha));
    }

    public function nombre_dia(){
        setlocale(LC_TIME, "es_ES");
        return strftime("%A",strtotime($this->fecha));
    }

    public function hora_inicio($formato, $pos = NULL){
        if($this->hora_inicio){
            return date($formato,strtotime($this->hora_inicio)).$pos;
        }
        return NULL;
    }

    public function fecha_proxima(){
        return Fecha::where(['catedra_id'=>$this->catedra_id])
            ->where('fecha','>',$this->fecha)
            ->orderBy('fecha', 'ASC')
            ->first();
    }

    public function fecha_anterior(){
        return Fecha::where(['catedra_id'=>$this->catedra_id])
            ->where('fecha','<',$this->fecha)
            ->orderBy('fecha', 'DESC')
            ->first();
    }

    public function vigente(){
        return ($this->fecha<=date("Y-m-d"));
    }

    public function hora_fin($formato,$pos = NULL){
        if($this->hora_fin){
            return date($formato,strtotime($this->hora_fin)).$pos;
        }
        return NULL;
    }

    public function catedra(){
        return $this->belongsTo(Catedra::class);
    }

    public function presentes(){
        return $this->hasMany(Presente::class);
    }

    public function contenidos(){
        return $this->hasMany(Contenido::class);
    }

    public function presente(Inscripcion $inscripto){

        return Presente::join('users','users_id','=','users.id')
            ->where('cursante_id',$inscripto->cursante_id)
            ->where('fecha_id',$this->id)
            ->get(['users.id','users.name','users.lastname'])
            ->first();

    }
}
