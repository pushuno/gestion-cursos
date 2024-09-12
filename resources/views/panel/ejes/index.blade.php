@extends('layouts.panel')

@section('title',"Ejes")

@section('seccion','Ejes')

@section('content')
     <div class="row">
        <div class="col-md-4">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ejes</h3>
                <div class="card-tools">
                    <a class="btn btn-link" href=" {{ route('ejes.new') }} "><i class="far fa-plus-square"></i> Agregar Nuevo</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @if(count($ejes)>0)
                    <table class="table">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ejes as $eje)
                            <tr>
                                <td>{{ $eje->id }}</td>
                                <td>{{ $eje->nombre }}</td>
                                <td>
                                    <form method="post" action="{{ route('ejes.delete',['eje'=>$eje]) }}">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <a href=" {{ route('ejes.edit',['eje'=>$eje]) }} " class="btn btn-link"><i class="far fa-edit"></i></a>
                                        @if($eje->cursos->count()==0)
                                            <button type="submit" class="btn btn-link"><i class="far fa-trash-alt text-danger"></i></button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                @else
                    <p>No hay ejes cargados en la base</p>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $ejes->links() }}
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection


