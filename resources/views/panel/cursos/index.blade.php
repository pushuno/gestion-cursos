@extends('layouts.panel')

@section('title',"Cursos")

@section('seccion','Cursos')

@section('content')
     <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cursos</h3>
                <div class="card-tools">
                    <a class="btn btn-link" href=" {{ route('cursos.new') }} "><i class="far fa-plus-square"></i> Agregar Nuevo</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @if(count($cursos)>0)
                    <table class="table">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Nombre</th>
                        <th>Metodología</th>
                        <th>Eje</th>
                        <th>Duración</th>
                        <th>Conocimientos Requeridos</th>
                        <th>Creación</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cursos as $curso)
                            <tr>
                                <td>{{ $curso->id }}</td>
                                <td>{{ ucwords($curso->nombre) }}</td>
                                <td>{{ ucwords($curso->metodologia->nombre) }}</td>
                                <td>{{ $curso->eje->nombre }}</td>
                                <td>{{ $curso->duracion_horas }}hs</td>
                                <td>
                                    @forelse($curso->conocimientos as $conocimiento)
                                        <span class="right badge badge-primary">{{ $conocimiento->conocimiento->nombre }}</span>
                                    @empty
                                        No requiere experiencias previas
                                    @endforelse
                                </td>
                                <td>{{ $curso->creacion() }}</td>
                                <td>
                                    <form method="post" action="{{ route('cursos.delete',['curso'=>$curso]) }}" onsubmit="return confirm('Seguro que deseas eliminar este curso?')">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <a href=" {{ route('cursos.edit',['curso'=>$curso]) }} " class="btn btn-link"><i class="far fa-edit"></i></a>
                                        <button type="submit" class="btn btn-link"><i class="far fa-trash-alt text-danger"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                @else
                    <p>No hay cursos cargados en la base</p>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $cursos->links() }}
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection


