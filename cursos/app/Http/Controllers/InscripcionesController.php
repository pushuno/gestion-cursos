<?php

namespace App\Http\Controllers;
use App\Catedra;
use App\Inscripcion;
use Illuminate\Http\Request;

class InscripcionesController extends Controller
{
    public function new(){
        $catedras = Catedra::join('cursos','cursos.id','catedras.curso_id')
            ->where('cursos.eliminado',false)
            ->leftJoin('fechas', 'catedras.id', '=', 'fechas.catedra_id')
            ->where( function ($query){
                $query->whereDate('fecha_fin','>=',date("Y-m-d"))
                ->orWhere('fecha_fin',NULL);
            })
            ->distinct()
            ->get(['catedras.id','curso_id','fecha_inicio','fecha_fin','cupo']);
        return view('panel.inscripciones.new')
            ->with('catedras',$catedras);
    }

    public function index(){
        $inscripciones = Inscripcion::select('inscripciones.*', 'catedras.fecha_inicio','catedras.fecha_fin')
            ->join('catedras', 'inscripciones.catedra_id', '=', 'catedras.id')
            ->whereDate('fecha_fin','>=',date("Y-m-d"))->orWhere('fecha_fin',NULL)->paginate(10);
        return view('panel.inscripciones.index')
            ->with('inscripciones',$inscripciones);
    }

    public function add(){
        $data = request()->validate([
           'catedra' => 'required',
           'cursante' => 'required'
        ],[
            'catedra.required' => 'Debe especificar una cátedra',
            'cursante.required' => 'Debe especificar un cursante'
        ]);


        factory(Inscripcion::class)->create([
            'catedra_id' => $data['catedra'],
            'cursante_id' => $data['cursante']
        ]);

        return response(true);
    }

    public function delete(Inscripcion $inscripcion){
        $inscripcion->delete();
        //return redirect()->route('inscripciones.index');
        return back();
    }
}
