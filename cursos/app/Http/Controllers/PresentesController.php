<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fecha;
use App\Inscripcion;
use App\Presente;
use Illuminate\Support\Facades\Auth;

class PresentesController extends Controller
{
    public function index($fecha = ''){
        $fecha_formato = '';

        if(!$fecha){
          $fecha = date("Y-m-d");
        }

        $fechas = Fecha::whereDate('fecha',$fecha)->paginate(10);
        $fecha_formato = date("d/m/Y",strtotime($fecha));

        return view('panel.presentes.index')
            ->with('fechas',$fechas)
            ->with('fecha_formato',$fecha_formato);
    }

    public function edit(Fecha $fecha){
        if($fecha->fecha<=date('Y-m-d')){
            return view('panel.presentes.edit')
                ->with('fecha',$fecha);
        }else{
            return redirect(route('presentes.index'));
        }
    }

    public function add(Fecha $fecha){
        Presente::where('fecha_id',$fecha->id)->delete();
        foreach($fecha->catedra->inscripciones as $inscripto){

            $data = request()->post('check'.$inscripto->id);

            if($data=='true'){
                factory(Presente::class)->create([
                    'fecha_id' => $fecha->id,
                    'cursante_id' => $inscripto->cursante->id,
                    'users_id' => Auth::user()->id
                ]);
            }

        }


        return response(true);
    }
}
