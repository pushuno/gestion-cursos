<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Cursante;
use App\NivelEstudio;
use App\Sector;

use App\Catedra;
use App\Inscripcion;
use Illuminate\Http\Request;

class CursantesController extends Controller
{
    public function index(){
        $capacitadores = Cursante::paginate(10);

        return view('panel.cursantes.index')
            ->with('cursantes',$capacitadores);
    }

    public function new(){
        return view('panel.cursantes.new')
            ->with('sectores',Sector::all())
            ->with('nivel_estudios',NivelEstudio::all());
    }

    public function add(){
        $data = request()->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'fecha_nacimiento' => 'required',
            'fecha_ingreso' => 'required',
            'numero_documento' => 'required',
            'nivel_estudio_id' => 'required',
            'titulo' => '',
            'email' => '',
            'telefono' => 'nullable|integer',
            'sector_id' => 'required',
            'direccion' => '',
            'categoria' => '',
            'afiliado' => '',
            'afiliado_barra' => '',
            'legajo' => ''
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'email.required' => 'El email es obligatorio',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria',
            'numero_documento.required' => 'Debe ingresar el número de documento',
            'nivel_estudio_id.required' => 'El nivel de estudio alcanzado es obligatorio',
            'sector_id.required' => 'Debe especificar el sector al que pertenece el capacitador',
            'telefono.integer' => 'El numero de telefono unicamente puede contener numeros'
        ]);

        $fecha = explode("/",$data['fecha_nacimiento']);
        $data['fecha_nacimiento'] = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        $fecha = explode("/",$data['fecha_ingreso']);
        $data['fecha_ingreso'] = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];

        factory(Cursante::class)->create($data);
        return redirect()->route('cursantes.index');
    }

    public function edit(Cursante $cursante){
        return view('panel.cursantes.edit')
            ->with('cursante',$cursante)
            ->with('sectores',Sector::all())
            ->with('nivel_estudios',NivelEstudio::all());
    }

    public function update(Cursante $cursante){
        $data = request()->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'fecha_nacimiento' => 'required',
            'fecha_ingreso' => 'required',
            'numero_documento' => 'required',
            'nivel_estudio_id' => 'required',
            'titulo' => '',
            'email' => '',
            'telefono' => 'nullable|integer',
            'sector_id' => 'required',
            'direccion' => '',
            'categoria' => '',
            'afiliado' => '',
            'afiliado_barra' => '',
            'legajo' => ''
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'email.required' => 'El email es obligatorio',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria',
            'numero_documento.required' => 'Debe ingresar el número de documento',
            'nivel_estudio_id.required' => 'El nivel de estudio alcanzado es obligatorio',
            'sector_id.required' => 'Debe especificar el sector al que pertenece el capacitador',
            'telefono.integer' => 'El numero de telefono unicamente puede contener numeros'
        ]);

        $fecha = explode("/",$data['fecha_nacimiento']);
        $data['fecha_nacimiento'] = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
        $fecha = explode("/",$data['fecha_ingreso']);
        $data['fecha_ingreso'] = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];

        $cursante->update($data);
        return redirect()->route('cursantes.index');
    }

    public function delete(Cursante $cursante){
        $cursante->delete();
        return redirect()->route('cursantes.index');
    }

    public function search($string = ' qqq'){
        $cursantes = Cursante::where('nombre','like','%'.$string.'%')
            ->orwhere('apellido','like','%'.$string.'%')
            ->orwhere('numero_documento','like','%'.$string.'%')
            ->orWhere(DB::raw("CONCAT(nombre,' ', apellido)"),'like','%'.$string.'%')
            ->orWhere(DB::raw("CONCAT(apellido,' ', nombre)"),'like','%'.$string.'%')
            ->orwhere('email','like','%'.$string.'%')
            ->orwhere('telefono','like','%'.$string.'%')
            ->orwhere('legajo','like','%'.$string.'%')
            ->with('inscripciones')
            ->limit(5)
            ->get();

        return $cursantes;
    }

    public function show(Cursante $cursante){
        $cursante = Cursante::find($cursante->id);

        $inscripciones = Inscripcion::join('catedras','inscripciones.catedra_id', '=', 'catedras.id')
            ->where('cursante_id',$cursante->id)
            ->orderBy('catedras.fecha_fin','DESC')
            ->get();

        return view('panel.cursantes.show')
            ->with('cursante',$cursante)
            ->with('inscripciones',$inscripciones);
    }
}
