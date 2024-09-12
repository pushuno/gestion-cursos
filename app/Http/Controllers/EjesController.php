<?php

namespace App\Http\Controllers;
use App\Eje;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EjesController extends Controller
{
    public function index(){
        $ejes = Eje::paginate(10);

        return view('panel.ejes.index')
            ->with('ejes',$ejes);
    }

    public function new(){
        return view('panel.ejes.new');
    }

    public function add(){
        $data = request()->validate([
            'nombre' => 'required|unique:ejes,nombre',
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'El nombre ingresado ya existe en la base'
        ]);

        $data['nombre'] = ucwords(mb_strtolower($data['nombre'],'UTF-8'));

        factory(Eje::class)->create($data);
        return redirect()->route('ejes.index');
    }

    public function edit(Eje $eje){
        return view('panel.ejes.edit')
            ->with('eje',$eje);
    }

    public function update(Eje $eje){
        $data = request()->validate([
            'nombre' => ['required',
            Rule::unique('ejes')->ignore($eje->id)],
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'El nombre ingresado ya existe en la base'
        ]);

        $data['nombre'] = ucwords(mb_strtolower($data['nombre'],'UTF-8'));

        $eje->update($data);
        return redirect()->route('ejes.index');
    }

    public function delete(Eje $eje){
        $eje->delete();
        return redirect()->route('ejes.index');
    }
}
