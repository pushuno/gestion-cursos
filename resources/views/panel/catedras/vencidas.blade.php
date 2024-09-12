@extends('layouts.panel')

@section('title',"Cátedras")

@section('seccion','Cátedras')

@section('content')
     <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex p-0">
                      <h3 class="card-title p-3">Cátedras</h3>
                      <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item"><a class="nav-link" href="{{ route('catedras.vigentes') }}">Vigentes</a></li>
                        <li class="nav-item"><a class="nav-link active" href="{{ route('catedras.vencidas') }}">Vencidas</a></li>
                        <li class="nav-item"><a class="btn btn-link" href="{{ route('catedras.new') }}"><i class="far fa-plus-square"></i> Agregar Nuevo</a></li>
                      </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="tab-pane active" id="vigentes">
                            @if(count($catedras)>0)
                                <table class="table ">
                                <thead>
                                    <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Curso</th>
                                    <th>Capacitadores</th>
                                    <th>Fechas</th>
                                    <th>Cupo</th>
                                    <th>Fechas</th>
                                    <th>Creación</th>
                                    <th>Estado</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($catedras as $catedra)
                                        <tr @if($catedra->fecha_fin<date("Y-m-d")) class="bg-light" @endif>
                                            <td>{{ $catedra->id }}</td>
                                            <td>{{ ucfirst($catedra->curso->nombre) }}</td>
                                            <td>
                                                @forelse($catedra->capacitadores as $capacitador)
                                                    {{ $capacitador->capacitador->nombre }} <b>{{ $capacitador->capacitador->apellido }}</b><br />
                                                @empty
                                                    Sin capacitadores asignados
                                                @endforelse
                                            </td>
                                            <td>@if($catedra->fecha_fin<date("Y-m-d"))<s>@endif <b>{{ $catedra->fecha_inicio() }}</b> a <b>{{ $catedra->fecha_fin() }}</b> @if($catedra->fecha_fin<date("Y-m-d"))</s>@endif</td>
                                            <td>{{ $catedra->cupo }} Personas</td>
                                            <td> @if($catedra->fechas->count()>0)
                                                {{ $catedra->fechas->count() }} fechas asignadas
                                            @else
                                                Sin fechas asignadas
                                            @endif
                                            <td>{{ $catedra->creacion() }}</td>
                                            <td>
                                                @if($catedra->eliminado)
                                                    @if($catedra->fecha_fin < date("Y-m-d") && $catedra->fecha_fin != NULL)
                                                        Eliminada y Vencida
                                                    @else
                                                        Eliminada
                                                    @endif
                                                @else
                                                    Vencida
                                                @endif
                                            </td>
                                            <td>
                                                <form method="post" action="{{ route('catedras.restore',['catedra'=>$catedra]) }}" onsubmit="return confirm('Seguro que deseas reactivar esta cátedra?')">
                                                    @if($catedra->eliminado)
                                                        @if($catedra->fecha_fin >= date("Y-m-d") && $catedra->fecha_fin != NULL)
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-link"><i class="fas fa-trash-restore"></i></button>

                                                        @endif
                                                    @endif
                                                    <a href=" {{ route('catedras.edit',['catedra'=>$catedra]) }} " class="btn btn-link"><i class="far fa-edit"></i></a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            @else
                                <p>No hay cátedras cargadas en la base</p>
                            @endif
                        </div>
                        <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->

            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $catedras->links() }}
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection



