@extends('layouts.portal')

@section('contenido')

    <div class="col-md-12">
        <h2 class="mb-3">Capacitaciones Disponibles</h2>
        @php
            //session(['login_das_salud'=> 9]);
            //$arreglo = array("nombre"=> "Pepe Lopez","documento"=> "33597840");
            //session(['usuario_actual'=> $arreglo]);
            //array("nombre"=>$nombre_completo,"id"=>$id_afiliado,"telefono"=>$telefono,"email"=>$email,"afiliado"=>$afiliado,"barra"=>$barra,"turnos_mes"=>$turnos_mes,"familiares"=>$familiares);
            //echo "login_salud: ".session('login_das_salud');
        @endphp
        @forelse($catedras as $catedra)
            @php
                $item = $catedra->catedra;
            @endphp
            <div class="card mb-3">
                <div class="card-header pl-3">
                    <h3 class="card-title">{{ $item->curso->nombre }}</h3> <span class="badge badge-secondary">{{ $item->curso->metodologia->nombre }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h5 class="card-title">{{ $item->curso->duracion_leyenda }}</h5>
                            <p class="card-text">{{ $item->curso->descripcion }}</p>
                        </div>
                        <div class="col-md-3">
                            <a class="btn"><i class="fas fa-lock"></i> Inscripción Requerida</a>
                            @if($item->fechas()->count()>0)
                                <a href="{{ route('portal.catedra',['catedra' => $item]) }}" class="btn btn-success btn-block"><i class="fas fa-lock-open"></i> Ir al curso</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        @empty
            No hay cursos actualmente disponibles
        @endforelse
    </div>
    <div class="col-md-4">

    </div>

@endsection
