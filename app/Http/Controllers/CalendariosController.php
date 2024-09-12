<?php

namespace App\Http\Controllers;

use App\Catedra;
use App\Fecha;
use App\Feriado;
use Illuminate\Http\Request;

class CalendariosController extends Controller
{
    public function __invoke()
    {
        $fechas = Fecha::whereYear('fecha',date("Y"))->get();

        $feriados = Feriado::whereYear('fecha',date("Y"))->get();

        return view('panel.calendarios.index')
            ->with('fechas',$fechas)
            ->with('feriados',$feriados);
    }
}
