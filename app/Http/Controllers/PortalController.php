<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catedra;
use App\Fecha;
use App\Contenido;
use App\Cursante;
use App\Inscripcion;

class PortalController extends Controller
{
    public function index(){
        return view('portal.index');
    }

    public function ayuda(){
        return view('portal.ayuda');
    }

    public function capacitaciones(){
        $arreglo = array("nombre"=> "Pepe Lopez","documento"=> "33597840");
        session(['usuario_actual'=> $arreglo,"login_das_salud"=>true]);

        $documento = session('usuario_actual')['documento'];
        $cursante = Cursante::where('numero_documento',$documento)->first();

        $inscripciones = $cursante->inscripciones->pluck('id')->toArray();

        $catedras = Inscripcion::whereIn('inscripciones.id', $inscripciones)
            ->join('catedras', 'inscripciones.catedra_id', '=', 'catedras.id')
            ->where('catedras.eliminado',false)
            ->where(function($query){
                $query->whereDate('fecha_fin','>=',date("Y-m-d"))
                ->orWhere('fecha_fin',NULL);
            })->get();


        return view('portal.capacitaciones')
            ->with('catedras' , $catedras);
    }


    public function fechas(Catedra $catedra){ //muestra las fechas de una catedra
        $fecha = Fecha::where('catedra_id',$catedra->id)
            ->orderBy('fecha','ASC')
            ->first();
        if($fecha){
            return redirect()->route('portal.contenido',['catedra'=>$catedra,'fecha'=>$fecha]);
        }else{
            return redirect()->route('portal.capacitaciones');
        }
    }


    public function contenido(Catedra $catedra,Fecha $fecha){ //devuelve el contenido de una fecha
        $contenidos = Contenido::where('fecha_id',$fecha->id)
        ->orderBy('orden', 'ASC')
        ->get();

        $fechas = Fecha::where('catedra_id',$catedra->id)
        ->orderBy('fecha','ASC')
            ->get();

        return view('portal.contenido')
            ->with('catedra',$fecha->catedra)
            ->with('fechas',$fechas)
            ->with('fecha',$fecha)
            ->with('contenidos',$contenidos);

    }
}
