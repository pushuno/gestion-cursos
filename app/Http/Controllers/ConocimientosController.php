<?php

namespace App\Http\Controllers;
use App\Conocimiento;
use Illuminate\Http\Request;

class ConocimientosController extends Controller
{
    public function index(){
        $conocimientos = Conocimiento::paginate(10);

        return view('panel.conocimientos.index')
            ->with('conocimientos',$conocimientos);
    }

    public function delete(Conocimiento $conocimiento){
        $conocimiento->delete();

        $conocimientos = Conocimiento::paginate(10);
        return view('panel.conocimientos.index')
            ->with('conocimientos',$conocimientos);
    }

    public function new(){
        return view('panel.conocimientos.new');
    }

    public function add(){
        $data = request()->validate([
            'nombre' => 'required|unique:conocimientos,nombre'
        ],[
            'nombre.required' => 'Debe ingresar el nombre del conocimiento',
            'nombre.unique' => 'El nombre de la experiencia ya existe'
        ]);

        factory(Conocimiento::class)->create([
            'nombre' => $data['nombre']
        ]);

        $conocimientos = Conocimiento::paginate(10);
        return view('panel.conocimientos.index')
            ->with('conocimientos',$conocimientos);
    }

}
