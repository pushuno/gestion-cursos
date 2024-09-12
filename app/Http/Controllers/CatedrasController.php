<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Catedra;
use App\Fecha;
use App\Capacitador;
use App\CatedrasCapacitador;
use Illuminate\Http\Request;

class CatedrasController extends Controller
{
    public function vigentes(){
        $catedra = Catedra::where('eliminado',false)
            ->where(function($query){
                $query->whereDate('fecha_fin','>=',date("Y-m-d"))
                ->orWhere('fecha_fin',NULL);
            })
            ->paginate(10);

        return view('panel.catedras.vigentes')
            ->with('catedras',$catedra);
    }

    public function vencidas(){
        $catedra = Catedra::where(function($query){
            $query->where('eliminado',true)
                ->orwhereDate('fecha_fin','<',date("Y-m-d"));
        })
        ->paginate(10);

        return view('panel.catedras.vencidas')
            ->with('catedras',$catedra);
    }

    public function new(){

        return view('panel.catedras.new')
            ->with('cursos',Curso::where('eliminado',false)->whereYear('updated_at',date("Y"))->get())
            ->with('capacitadores',Capacitador::all());
    }

    public function add(){
        $data = request()->validate([
            'curso_id' => 'required',
            'fecha_inicio' => '',
            'fecha_fin' => '',
            'cupo' => 'required|integer',
            'clases_minimas' => 'required|integer',
            'capacitadores' => 'required'
        ],[
            'curso_id.required' => 'El curso al que pertenece la cátedra es obligatorio',
            'fecha_inicio.required' => 'La fecha de inicio de la cátedra es obligatoria',
            'fecha_fin.required' => 'La fecha de fin de la cátedra es obligatoria',
            'cupo.required' => 'El cupo de alumnos admitido para curso es obligatoria',
            'cupo.integer' => 'El cupo de alumnos admitido debe ser numerico',
            'clases_minimas.required' => 'La cantidad mínima de clases es obligatoria',
            'clases_minimas.integer' => 'La cantidad mínima de clases debe ser numerica',
            'capacitadores.required' => 'Debe seleccionar al menos un capacitador',
        ]);

        $catedra = new Catedra();

        $catedra->curso_id = $data['curso_id'];
        $catedra->setFechaInicio($data['fecha_inicio']);
        $catedra->setFechaFin($data['fecha_fin']);

        $catedra->cupo = $data['cupo'];
        $catedra->clases_minimas = $data['clases_minimas'];

        $catedra->save();

        $catedra->setCapacitadores($data['capacitadores']);

        return redirect()->route('catedras.vigentes');
    }

    public function edit(Catedra $catedra){
        return view('panel.catedras.edit')
            ->with('catedra',$catedra)
            ->with('cursos',Curso::all())
            ->with('capacitadores',Capacitador::all());
    }

    public function show(Catedra $catedra){
        $catedra = Catedra::find($catedra->id);

        return view('panel.catedras.show')
            ->with('catedra',$catedra);
    }

    public function update(Catedra $catedra){
        $data = request()->validate([
            'curso_id' => 'required',
            'fecha_inicio' => '',
            'fecha_fin' => '',
            'cupo' => 'required|integer',
            'clases_minimas' => 'required|integer',
            'capacitadores' => 'required'
        ],[
            'curso_id.required' => 'El curso al que pertenece la cátedra es obligatorio',
            'cupo.required' => 'El cupo de alumnos admitido para curso es obligatoria',
            'cupo.integer' => 'El cupo de alumnos admitido debe ser numerico',
            'clases_minimas.required' => 'La cantidad mínima de clases es obligatoria',
            'clases_minimas.integer' => 'La cantidad mínima de clases debe ser numerica',
            'capacitadores.required' => 'Debe seleccionar al menos un capacitador',
        ]);

        if($data['fecha_inicio']!=$catedra->fecha_inicio()||$data['fecha_fin']!=$catedra->fecha_fin()){
            Fecha::where('catedra_id',$catedra->id)->delete();
        }

        $catedra->curso_id = $data['curso_id'];
        $catedra->cupo = $data['cupo'];
        $catedra->clases_minimas = $data['clases_minimas'];
        $catedra->setFechaInicio($data['fecha_inicio']);
        $catedra->setFechaFin($data['fecha_fin']);
        $catedra->setCapacitadores($data['capacitadores']);

        $catedra->update();
        return redirect()->route('catedras.vigentes');
    }

    public function delete(Catedra $catedra){


        $inscriptos = $catedra->inscripciones->count();

        if($inscriptos==0){
            $catedra->delete();
            return redirect()->route('catedras.vigentes');
        }

        $catedra->eliminado = true;
        $catedra->update();
        return redirect()->route('catedras.vigentes');

    }

    public function restore(Catedra $catedra){
        $catedra->eliminado = false;
        $catedra->update();
        return redirect()->route('catedras.vigentes');
    }
}
