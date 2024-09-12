<?php

namespace App\Http\Controllers;
use App\Curso;
use App\CursosConocimiento;
use App\Conocimiento;
use App\Eje;
use Illuminate\Http\Request;
use App\Metodologia;

class CursosController extends Controller
{
    public function index(){
        $cursos = Curso::where('eliminado',false)
            ->whereYear('updated_at',date("Y"))
            ->paginate(10);

        return view('panel.cursos.index')
            ->with('cursos',$cursos);
    }

    public function new(){
        $ejes = Eje::all();

        return view('panel.cursos.new')
            ->with('metodologias',Metodologia::all())
            ->with('conocimientos',Conocimiento::all())
            ->with('ejes',$ejes);
    }

    public function add(){
        $data = request()->validate([
            'nombre' => 'required',
            'eje_id' => 'required',
            'descripcion' => '',
            'metodologia_id' => 'required',
            'duracion_leyenda' => 'required',
            'duracion_horas' => 'required|integer',
            'conocimientos' => ''
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'eje_id.required' => 'El eje es obligatorio',
            'metodologia_id.required' => 'La metodología es obligatoria',
            'duracion_leyenda.required' => 'La descripción de la duracion es obligatoria',
            'duracion_horas.required' => 'La cantidad de horas del curso es obligatoria',
            'duracion_horas.integer' => 'La duración debe ser un numero entero de horas'
        ]);

        $data['nombre'] = ucwords(mb_strtolower($data['nombre'],'UTF-8'));

        if(isset($data['conocimientos'])){
            $conocimientos = $data['conocimientos'];
            unset($data['conocimientos']);
        }


        factory(Curso::class)->create($data);

        if(isset($conocimientos)){
            for($i=0;$i<count($conocimientos);$i++){
                factory(CursosConocimiento::class)->create([
                    'curso_id' => Curso::latest()->first()->id,
                    'conocimiento_id' => $conocimientos[$i]
                ]);
            }
        }

        return redirect()->route('cursos.index');
    }

    public function edit(Curso $curso){
        $ejes = Eje::all();

        return view('panel.cursos.edit')
            ->with('curso',$curso)
            ->with('metodologias',Metodologia::all())
            ->with('conocimientos',Conocimiento::all())
            ->with('ejes',Eje::all());
    }

    public function update(Curso $curso){
        $data = request()->validate([
            'nombre' => 'required',
            'descripcion' => '',
            'eje_id' => 'required',
            'metodologia_id' => 'required',
            'duracion_leyenda' => 'required',
            'duracion_horas' => 'required|integer',
            'conocimientos' => ''
        ],[
            'nombre.required' => 'El nombre es obligatorio',
            'eje_id.required' => 'El eje es obligatorio',
            'metodologia_id.required' => 'La metodología es obligatoria',
            'duracion_leyenda.required' => 'La descripción de la duracion es obligatoria',
            'duracion_horas.required' => 'La cantidad de horas del curso es obligatoria',
            'duracion_horas.integer' => 'La duración debe ser un numero entero de horas'
        ]);

        $data['nombre'] = ucwords(mb_strtolower($data['nombre'],'UTF-8'));

        if(isset($data['conocimientos'])){
            $conocimientos = $data['conocimientos'];
            unset($data['conocimientos']);
        }


        CursosConocimiento::where('curso_id',$curso->id)->delete();

        if(isset($conocimientos)){
            for($i=0;$i<count($conocimientos);$i++){
                factory(CursosConocimiento::class)->create([
                    'curso_id' => $curso->id,
                    'conocimiento_id' => $conocimientos[$i]
                ]);
            }
        }

        $curso->update($data);

        return redirect()->route('cursos.index');
    }

    public function delete(Curso $curso){
        $inscriptos=0;
        foreach($curso->catedra as $catedra){
            $inscriptos += $catedra->inscriptos->count();
        }
        if($inscriptos==0){
            $curso->delete();
            return redirect()->route('cursos.index');
        }
        $curso->eliminado = true;
        $curso->update();
        return redirect()->route('cursos.index');
    }
}
