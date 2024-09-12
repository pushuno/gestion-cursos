@extends('layouts.panel')

@section('title',"Cursantes")

@section('seccion','Cursantes')

@section('content')
     <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cursantes</h3>
                <div class="card-tools">
                    <a class="btn btn-link" href=" {{ route('cursantes.new') }} "><i class="far fa-plus-square"></i> Agregar Nuevo</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @if(count($cursantes)>0)
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
                        @foreach($cursantes as $cursante)
                            <tr>
                                <td>{{ $cursante->id }}</td>
                                <td>{{ $cursante->nombre." ".$cursante->apellido }} <small>({{ $cursante->edad() }})</small></td>
                                <td>{{ $cursante->numero_documento }}</td>
                                <td>{{ $cursante->sector->nombre }}</td>
                                <td>{{ $cursante->email }}</td>
                                <td>{{ $cursante->telefono }}</td>
                                <td>
                                    <form method="post" action="{{ route('cursantes.delete',['cursante'=>$cursante]) }}">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <a href=" {{ route('cursantes.show',['cursante'=>$cursante]) }} " class="btn btn-link"><i class="far fa-eye"></i></a>
                                        <a href=" {{ route('cursantes.edit',['cursante'=>$cursante]) }} " class="btn btn-link"><i class="far fa-edit"></i></a>
                                        <button type="submit" class="btn btn-link"><i class="far fa-trash-alt text-danger"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                @else
                    <p>No hay cursantes cargados en la base</p>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $cursantes->links() }}
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection


