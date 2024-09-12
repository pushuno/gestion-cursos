<?php

namespace App\Http\Controllers;
use App\Sector;
use App\Capacitador;
use App\NivelEstudio;
use CapacitadorSeeder;
use Illuminate\Http\Request;

class CapacitadoresController extends Controller
{

    public function index(){
        $capacitadores = Capacitador::paginate(10);

        return view('panel.capacitadores.index')
            ->with('capacitadores',$capacitadores);
    }

    public function new(){
        return view('panel.capacitadores.new')
            ->with('sectores',Sector::all())
            ->with('nivel_estudios',NivelEstudio::all());
    }

    public function add(){
        $data = request()->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'fecha_nacimiento' => 'required',
            'numero_documento' => '',
            'nivel_estudio_id' => 'required',
            'titulo' => '',
            'email' => '',
            'telefono' => 'nullable|integer',
            'sector_id' => 'required',
            'legajo' => '',
            'oficina' => '',
            'categoria' => '',
            'afiliado' => '',
            'afiliado_barra' => ''
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'email.required' => 'El email es obligatorio',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'nivel_estudio_id.required' => 'El nivel de estudio alcanzado es obligatorio',
            'sector_id.required' => 'Debe especificar el sector al que pertenece el capacitador',
            'telefono.integer' => 'El numero de telefono unicamente puede contener numeros'
        ]);

        $fecha = explode("/",$data['fecha_nacimiento']);
        $data['fecha_nacimiento'] = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];


        factory(Capacitador::class)->create($data);
        return redirect()->route('capacitadores.index');
    }

    public function edit(Capacitador $capacitador){
        return view('panel.capacitadores.edit')
            ->with('capacitador',$capacitador)
            ->with('sectores',Sector::all())
            ->with('nivel_estudios',NivelEstudio::all());
    }

    public function update(Capacitador $capacitador){
        $data = request()->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'fecha_nacimiento' => 'required',
            'numero_documento' => '',
            'nivel_estudio_id' => 'required',
            'titulo' => '',
            'email' => '',
            'telefono' => 'nullable|integer',
            'sector_id' => 'required',
            'legajo' => '',
            'oficina' => '',
            'categoria' => '',
            'afiliado' => '',
            'afiliado_barra' => ''
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'email.required' => 'El email es obligatorio',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria',
            'nivel_estudio_id.required' => 'El nivel de estudio alcanzado es obligatorio',
            'sector_id.required' => 'Debe especificar el sector al que pertenece el capacitador',
            'telefono.integer' => 'El numero de telefono unicamente puede contener numeros'
        ]);

        $fecha = explode("/",$data['fecha_nacimiento']);
        $data['fecha_nacimiento'] = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];

        $capacitador->update($data);
        return redirect()->route('capacitadores.index');
    }

    public function delete(Capacitador $capacitador){
        $capacitador->delete();
        return redirect()->route('capacitadores.index');
    }

    public function show(Capacitador $capacitador){
        $capacitador = Capacitador::find($capacitador->id);

        return view('panel.capacitadores.show')
            ->with('capacitador',$capacitador);
    }
}
