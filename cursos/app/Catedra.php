<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Fecha;

class Catedra extends Model
{
    protected $guarded = ['id'];
    protected $colors = ['3c8dbc','6f42c1','dc3545','fd7e14','ffc107','28a745','17a2b8','6c757d'];

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function color(){
        $pos = round($this->id/count($this->colors),0);
        if($this->id < count($this->colors)){
            $pos = $this->id;
        }

        return $this->colors[$pos];
    }

    public function fechas(){
        return $this->hasMany(Fecha::class)->orderBy('fechas.fecha', 'asc');
    }

    public function fechas_pendientes(){
        $fecha = NULL;
        foreach($this->fechas as $item){
            if($item->fecha<date('Y-m-d')){
                $fecha[] = $item;
            }
        }
        return $fecha;
    }

    public function capacitadores(){
        return $this->hasMany(CatedrasCapacitador::class);
    }

    public function fecha_inicio($formato = 'd/m/Y'){
        if($this->fecha_inicio){
            return date($formato,strtotime($this->fecha_inicio));
        }
        return null;
    }

    public function fecha_fin($formato = 'd/m/Y'){
        if($this->fecha_inicio){
            return date($formato,strtotime($this->fecha_fin));
        }
        return null;
    }

    public function creacion($formato = 'd/m/Y H:i:s'){
        return date($formato,strtotime($this->created_at));
    }


    public function inscripciones(){
        return $this->hasMany(Inscripcion::class);
    }

    public function setFechaInicio($fecha){
        if($fecha){
            $fecha = explode("/",$fecha);
            $fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        }
        $this->fecha_inicio = $fecha;
    }

    public function setFechaFin($fecha){
        if($fecha){
           $fecha = explode("/",$fecha);
           $fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        }
        $this->fecha_fin = $fecha;
    }

    public function setCapacitadores($capacitadores){
        CatedrasCapacitador::where('catedra_id',$this->id)->delete();
        for($i=0;$i<count($capacitadores);$i++){
            factory(CatedrasCapacitador::class)->create([
                'catedra_id' => $this->id,
                'capacitador_id' => $capacitadores[$i]
            ]);
        }
    }

    public function presentes(){
        return Presente::join('fechas','fechas.id','presentes.fecha_id')
            ->where('fechas.catedra_id',$this->id)->get();
    }

    /*public function contenidos(){
        return $this->hasMany(Contenido::class);
    }*/
}
