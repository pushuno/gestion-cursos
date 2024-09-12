@extends('layouts.panel')

@section('title',"Capacitadores")

@section('seccion','Capacitadores')


@section('content')
     <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Capacitadores</h3>
                <div class="card-tools">
                    <a class="btn btn-link" href=" {{ route('capacitadores.new') }} "><i class="far fa-plus-square"></i> Agregar Nuevo</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @if(count($capacitadores)>0)
                    <table class="table">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Sector</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($capacitadores as $capacitador)
                            <tr>
                                <td>{{ $capacitador->id }}</td>
                                <td>{{ ucwords($capacitador->nombre." ".$capacitador->apellido) }}</td>
                                <td>{{ $capacitador->numero_documento }}</td>
                                <td>{{ $capacitador->sector->nombre }}</td>
                                <td>{{ $capacitador->email }}</td>
                                <td>{{ $capacitador->telefono }}</td>
                                <td>
                                    <form method="post" action="{{ route('capacitadores.delete',['capacitador'=>$capacitador]) }}">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <a href=" {{ route('capacitadores.show',['capacitador'=>$capacitador]) }} " class="btn btn-link"><i class="far fa-eye"></i></a>
                                        <a href=" {{ route('capacitadores.edit',['capacitador'=>$capacitador]) }} " class="btn btn-link"><i class="far fa-edit"></i></a>
                                        <button type="submit" class="btn btn-link"><i class="far fa-trash-alt text-danger"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                @else
                    <p>No hay capacitadores cargados en la base</p>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $capacitadores->links() }}
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection


