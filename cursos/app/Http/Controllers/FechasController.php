<?php

namespace App\Http\Controllers;
use App\Catedra;
use App\Fecha;
use App\Feriado;
use Illuminate\Http\Request;

class FechasController extends Controller
{
    public function data($mes){
       $feriados = Feriado::whereMonth('fecha', $mes)
            ->whereYear('fecha', date("Y"))
            ->orderBy('fecha', 'ASC')->get();
       return $feriados->toJson();
    }

    public function new(Catedra $catedra){
        setlocale(LC_TIME, "es_ES");
        $inicio = $catedra->fecha_inicio;
        $fin = $catedra->fecha_fin;
        $pos = 0;
        $fechas = Array();
        for($i=$inicio;$i<=$fin;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
            $nombre = strftime("%A",strtotime($i));
            if($nombre!='sábado'&&$nombre!='domingo'){
                $formato = date("d/m/Y", strtotime($i));
                $sin_formato = date("Y-m-d", strtotime($i));

                $datos = Fecha::where('fecha','=',$i)
                    ->where('catedra_id','=',$catedra->id)->first();

                $inicio_hora = NULL;
                $fin_hora = NULL;
                $presentes = 0;
                if($datos){
                    $inicio_hora = $datos->hora_inicio;
                    $fin_hora = $datos->hora_fin;
                    $presentes = count($datos->presentes);
                }
                $fechas[] = array("pos"=>$pos,"presentes"=>$presentes,"formato"=>$formato,"sin_formato"=>$sin_formato,"nombre"=>$nombre,"feriado"=>Feriado::where('fecha',$i)->count(),"seleccionado"=>Fecha::where(['fecha'=>$i,'catedra_id'=>$catedra->id])->count(),"hora_inicio"=>$inicio_hora,"hora_fin"=>$fin_hora);
                $pos++;
            }
        }




        return view('panel.fechas.new')
            ->with('catedra',$catedra)
            ->with('fechas',$fechas);
    }

    public function update($catedra){ //guarda la hora en los dias seleccionados
        //setlocale(LC_TIME, "es_ES");
        $data = request()->validate([
            'inicio' => 'required',
            'fin' => 'required',
        ],[
            'inicio.required' => 'La hora de inicio es requerida',
            'fin.required' => 'La hora de fin es requerida'
        ]);



        $hora_inicio = $data['inicio'];
        $hora_fin = $data['fin'];

   
        return response(Fecha::where('catedra_id','=',$catedra)->update(['hora_inicio' => $hora_inicio,'hora_fin' => $hora_fin]));
    }

    public function add(Catedra $catedra){
        setlocale(LC_TIME, "es_ES");

        $data = request()->post('check');
        $fecha = request()->post('fecha');
        $inicio_hora = request()->post('inicio');
        $fin_hora = request()->post('fin');

        $fecha_encontrada = Fecha::where('catedra_id',$catedra->id)->whereFecha($fecha)->first();
        if($fecha_encontrada){
            if($data == 'true'){
                if($inicio_hora){
                    $inicio_hora = date("H:i:s",strtotime($inicio_hora));
                }

                if($fin_hora){
                    $fin_hora = date("H:i:s",strtotime($fin_hora));
                }

                $data = array("hora_inicio"=>$inicio_hora,"hora_fin"=>$fin_hora);
                $fecha_encontrada->update($data);
            }else{
                $fecha_encontrada->delete();
            }

        }else{
            if($data == 'true'){
                if($inicio_hora){
                    $inicio_hora = date("H:i:s",strtotime($inicio_hora));
                }

                if($fin_hora){
                    $fin_hora = date("H:i:s",strtotime($fin_hora));
                }

                factory(Fecha::class)->create([
                    'fecha' => $fecha,
                    'hora_inicio' => $inicio_hora,
                    'hora_fin' => $fin_hora,
                    'catedra_id' => $catedra->id
                ]);
            }
        }

        return response(true);
    }

    public function delete(Feriado $feriado){
        return $feriado->delete();
    }
}
