<?php

namespace App\Http\Controllers;

use App\Catedra;
use App\Contenido;
use App\ContenidosItem;
use App\Fecha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

/*


DEPRECADO


*/

class ContenidosController extends Controller
{
    public function fechas(Catedra $catedra){
        $fechas = Fecha::where('catedra_id',$catedra->id)
            ->orderBy('fecha','ASC')
            ->get();

        return view('panel.contenidos.fechas')
            ->with('fechas',$fechas)
            ->with('catedra',$catedra);
    }

    public function edit(Fecha $fecha){
        $contenidos = Contenido::where('fecha_id',$fecha->id)
            ->orderBy('orden', 'ASC')
            ->get();

        return view('panel.contenidos.edit')
            ->with('catedra',$fecha->catedra)
            ->with('fecha',$fecha)
            ->with('contenidos',$contenidos);
    }

    public function add_image(Fecha $fecha){
        //obtenemos el campo file definido en el formulario
        $request = request();
       $file = $request->file('file');

       //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();

       //indicamos que queremos guardar un nuevo archivo en el disco local
       Storage::disk('public')->put($nombre,  File::get($file));


       $url = Storage::url($nombre);
       Factory(Contenido::class)->create([
            'fecha_id' => $fecha->id,
            'orden' => Contenido::where('fecha_id',$fecha->id)->max('id')+1,
            'contenido' => json_encode(array('tipo' => 'imagen','nombre'=>$nombre,'imagen' => $url))
        ]);
        return redirect()->route('contenidos.edit',['fecha' => $fecha->id]);
    }

    public function add_file(Fecha $fecha){
       //obtenemos el campo file definido en el formulario
       $request = request();
       $file = $request->file('file');

       //obtenemos el nombre del archivo
       $nombre = $file->getClientOriginalName();

       //indicamos que queremos guardar un nuevo archivo en el disco local
       Storage::disk('public')->put($nombre,  File::get($file));


       $url = Storage::url($nombre);
       Factory(Contenido::class)->create([
            'fecha_id' => $fecha->id,
            'orden' => Contenido::where('fecha_id',$fecha->id)->max('id')+1,
            'contenido' => json_encode(array('tipo' => 'archivo','nombre'=>$nombre,'ruta' => $url))
        ]);
        return redirect()->route('contenidos.edit',['fecha' => $fecha->id]);
    }

    public function get_file(Contenido $contenido){

        $contenido = json_decode($contenido->contenido);
        $file=Storage::disk('public')->get($contenido->nombre);

        return response()->streamDownload(function () use ($file) {
            echo $file;
        }, $contenido->nombre);
    }

    public function add_title(Fecha $fecha){
        $data = request()->validate([
            'titulo' => 'required',
        ],[
            'titulo.required' => 'El título es obligatorio'
        ]);

        Factory(Contenido::class)->create([
            'fecha_id' => $fecha->id,
            'orden' => Contenido::where('fecha_id',$fecha->id)->max('id')+1,
            'contenido' => json_encode(array('tipo' => 'titulo','texto' => $data['titulo']))
        ]);
        return redirect()->route('contenidos.edit',['fecha' => $fecha->id]);
    }

    public function add_text(Fecha $fecha){
        $data = request()->validate([
            'texto' => 'required',
        ],[
            'texto.required' => 'El texto es obligatorio'
        ]);

        return Factory(Contenido::class)->create([
            'fecha_id' => $fecha->id,
            'orden' => Contenido::where('fecha_id',$fecha->id)->max('id')+1,
            'contenido' => json_encode(array('tipo' => 'texto','texto' => $data['texto']))
        ]);

    }

    public function add_video(Fecha $fecha){
        $data = request()->validate([
            'link' => 'required',
        ],[
            'link.required' => 'El link es obligatorio'
        ]);

        $pos = strpos($data['link'],"v=")+2;
        $id = substr($data['link'],$pos);

        Factory(Contenido::class)->create([
            'fecha_id' => $fecha->id,
            'orden' => Contenido::where('fecha_id',$fecha->id)->max('id')+1,
            'contenido' => json_encode(array('tipo' => 'video','link' => $id))
        ]);
        return redirect()->route('contenidos.edit',['fecha' => $fecha->id]);
    }

    public function delete(Contenido $contenido){
        $fecha = $contenido->fecha_id;
        $tipo = json_decode($contenido->contenido);
        if($tipo->tipo == 'imagen' || $tipo->tipo == 'archivo'){
            Storage::disk('public')->delete($tipo->nombre);
        }
        $contenido->delete();
        return redirect()->route('contenidos.edit',['fecha' => $fecha]);
    }

    public function order(Fecha $fecha){
        $request = request();
        $array = json_decode($request->post('array'));
        $pos = 0;
        for($i=0;$i<count($array);$i++){
            $id = $array[$i];
            $pos++;
            Contenido::where('id',$id)
            ->update(['orden' => $pos]);
        }
        return response(true);
    }
}
