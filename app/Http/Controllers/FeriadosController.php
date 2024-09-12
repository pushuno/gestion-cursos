<?php

namespace App\Http\Controllers;
use App\Feriado;
use Illuminate\Http\Request;

class FeriadosController extends Controller
{
    public function index(){
        $meses[] = array('nombre' => 'Enero', 'numero' => 1);
        $meses[] = array('nombre' => 'Febrero', 'numero' => 2);
        $meses[] = array('nombre' => 'Marzo', 'numero' => 3);
        $meses[] = array('nombre' => 'Abril', 'numero' => 4);
        $meses[] = array('nombre' => 'Mayo', 'numero' => 5);
        $meses[] = array('nombre' => 'Junio', 'numero' => 6);
        $meses[] = array('nombre' => 'Julio', 'numero' => 7);
        $meses[] = array('nombre' => 'Agosto', 'numero' => 8);
        $meses[] = array('nombre' => 'Septiembre', 'numero' => 9);
        $meses[] = array('nombre' => 'Octubre', 'numero' => 10);
        $meses[] = array('nombre' => 'Noviembre', 'numero' => 11);
        $meses[] = array('nombre' => 'Diciembre', 'numero' => 12);

        return view('panel.feriados.index')
            ->with('meses',$meses);
    }

    public function data($mes){
       $feriados = Feriado::whereMonth('fecha', $mes)
            ->whereYear('fecha', date("Y"))
            ->orderBy('fecha', 'ASC')->get();
       return $feriados->toJson();
    }

    public function add(){
        $data = request()->validate([
            'fecha' => 'required|unique:feriados,fecha'
        ],[
            'fecha.required' => 'La fecha del feriado es obligatoria',
            'fecha.unique' => 'La fecha ingresada ya fué cargada',
        ]);

        factory(Feriado::class)->create($data);
        return redirect()->route('feriados.index');
    }

    public function delete(Feriado $feriado){
        $feriado->delete();
        return response(true);
    }

}
