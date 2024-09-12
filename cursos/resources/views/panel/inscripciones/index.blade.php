@extends('layouts.panel')

@section('title',"Inscripciones")

@section('seccion','Inscripciones')

@section('content')
     <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Inscripción</h3>
                <div class="card-tools">
                    <a class="btn btn-link" href=" {{ route('inscripciones.new') }} "><i class="far fa-plus-square"></i> Inscribir</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if(count($inscripciones)>0)
                    <table class="table">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Cursante</th>
                        <th>Curso</th>
                        <th>Fechas</th>
                        <th>Cupos</th>
                        <th>Inscripción</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inscripciones as $inscripcion)
                            <tr id="{{ $inscripcion->id }}">
                                <td>{{ $inscripcion->id }}</td>
                                <td>{{ $inscripcion->cursante->nombre.' '.$inscripcion->cursante->apellido }}</td>
                                <td>{{ ucfirst($inscripcion->catedra->curso->nombre) }}</td>
                                <td>
                                    @if($inscripcion->catedra->fecha_inicio()&&$inscripcion->catedra->fecha_fin())
                                        {{ $inscripcion->catedra->fecha_inicio()." al ".$inscripcion->catedra->fecha_fin() }}
                                    @else
                                        A convenir
                                    @endif
                                </td>
                                <td>{{ $inscripcion->catedra->inscripciones->count()." de ".$inscripcion->catedra->cupo }}
                                    <div class="progress mb-3">
                                        <div class="progress-bar progress-bar-striped @if($inscripcion->catedra->inscripciones->count()<=$inscripcion->catedra->cupo) bg-success @else bg-danger @endif" role="progressbar" aria-valuenow="{{ $inscripcion->catedra->inscripciones->count() }}" aria-valuemin="0" aria-valuemax="{{ $inscripcion->catedra->cupo }}" style="width: {{ ($inscripcion->catedra->inscripciones->count()/$inscripcion->catedra->cupo)*100 }}%">
                                        </div>
                                      </div>
                                </td>
                                <td>{{ $inscripcion->creacion() }}</td>
                                <td>
                                    <form method="post" action="{{ route('inscripciones.delete',['inscripcion'=>$inscripcion]) }}">
                                        {{ csrf_field() }}
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-link"><i class="far fa-trash-alt text-danger"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                @else
                    <p>No hay inscripciones cargadas en la base</p>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $inscripciones->links() }}
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection


