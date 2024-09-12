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
                        <li class="nav-item"><a class="nav-link active" href="#">Vigentes</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('catedras.vencidas') }}">Vencidas</a></li>
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
                                                    Sin capacitadores asignadas
                                                @endforelse
                                            </td>
                                            <td>
                                                @if($catedra->fecha_inicio != NULL && $catedra->fecha_fin != NULL)
                                                    @if($catedra->fecha_fin<date("Y-m-d"))
                                                        <s>
                                                    @endif
                                                    <b>{{ $catedra->fecha_inicio() }}</b> a <b>{{ $catedra->fecha_fin() }}</b>
                                                    @if($catedra->fecha_fin<date("Y-m-d"))
                                                        </s>
                                                    @endif
                                                @else
                                                    Fechas a convenir
                                                @endif
                                            </td>
                                            <td>{{ $catedra->cupo }} Personas</td>
                                            <td>
                                            @if($catedra->fecha_inicio != NULL && $catedra->fecha_fin != NULL)
                                                @if($catedra->fechas->count()>0)
                                                    {{ $catedra->fechas->count() }} fechas asignadas
                                                @else
                                                    Sin fechas asignadas
                                                @endif
                                                <a href=" {{ route('fechas.new',['catedra'=>$catedra]) }} " class="btn btn-link"><i class="far fa-calendar-plus"></i></a>
                                            @else
                                                Debe especificar un rango de fechas
                                            @endif
                                            </td>
                                            <td>{{ $catedra->creacion() }}</td>
                                            <td><form method="post" action="{{ route('catedras.delete',['catedra'=>$catedra]) }}" onsubmit="return confirm('Seguro que deseas eliminar esta catedra?')">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                    @if($catedra->curso->metodologia->nombre == 'Online')
                                                        <a href="{{ route('contenidos.fechas',['catedra'=>$catedra]) }} " class="btn btn-link"><i class="fas fa-clipboard-list"></i></a>
                                                    @endif
                                                    <a href=" {{ route('catedras.show',['catedra'=>$catedra]) }} " class="btn btn-link"><i class="far fa-eye"></i></a>
                                                    <a href=" {{ route('catedras.edit',['catedra'=>$catedra]) }} " class="btn btn-link"><i class="far fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-link"><i class="far fa-trash-alt text-danger"></i></button>
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



