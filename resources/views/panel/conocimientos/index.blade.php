@extends('layouts.panel')

@section('title',"Conocimientos Previos")

@section('seccion','Conocimientos Previos')

@section('content')
     <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Conocimientos Previos</h3>
                <div class="card-tools">
                    <a class="btn btn-link" href=" {{ route('conocimientos.new') }} "><i class="far fa-plus-square"></i> Agregar Nuevo</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @if(count($conocimientos)>0)
                    <table class="table">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Nombre</th>
                        <th>Creación</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($conocimientos as $conocimiento)
                            <tr>
                                <td>{{ $conocimiento->id }}</td>
                                <td>{{ $conocimiento->nombre }}</td>
                                <td>{{ $conocimiento->creacion() }}</td>
                                <td>
                                    <form method="post" action="{{ route('conocimientos.delete',['conocimiento'=>$conocimiento]) }}">
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
                    <p>No hay conocimientos previos cargadas en la base</p>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $conocimientos->links() }}
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection


