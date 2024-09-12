@extends('layouts.panel')

@section('title',"Catedras")

@section('seccion','Cátedras')

@section('cabecera')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('js/panel/select2-bootstrap4.css')}}" rel="stylesheet" />
@endsection


@section('content')
     <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-detalle-tab" data-toggle="pill" href="#custom-tabs-four-detalle" role="tab" aria-controls="custom-tabs-four-detalle" aria-selected="false">Detalle de la cátedra</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-fechas-tab" data-toggle="pill" href="#custom-tabs-four-fechas" role="tab" aria-controls="custom-tabs-four-fechas" aria-selected="false">Fechas</a>
                      </li>
                      <!--<li class="nav-item">
                        <a class="nav-link" href="{{ route('contenidos.fechas',['catedra' => $catedra]) }}" role="tab"> Gestionar contenido</a>
                      </li>-->
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                      <div class="tab-pane fade active show" id="custom-tabs-four-detalle" role="tabpanel" aria-labelledby="custom-tabs-four-detalle-tab">
                        <div class="invoice p-3 mb-3">
                            <div class="row">
                              <div class="col-12">
                                <h4>
                                    <i class="fas fa-graduation-cap"></i> {{ ucwords(strtolower($catedra->curso->nombre)) }}
                                </h4>
                              </div>
                            </div>

                            <div class="row invoice-info">
                              <div class="col-sm-3 invoice-col">
                                <address>
                                  <h5>Curso</h5>
                                  <b>Metodología:</b> {{ $catedra->curso->metodologia->nombre }}<br>
                                  <b>Duración:</b> {{ $catedra->curso->duracion_horas }}hs<br>
                                  {{ $catedra->curso->duracion_leyenda }}<br>
                                  <b>Creación:</b> {{ $catedra->curso->creacion() }}
                                </address>
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-3 invoice-col">
                                <address>
                                  <h5>Cátedra</h5>
                                  @if($catedra->fecha_inicio != NULL && $catedra->fecha_fin != NULL)
                                    <b>Inicio:</b> {{ $catedra->fecha_inicio() }}<br>
                                    <b>Fin:</b> {{ $catedra->fecha_fin() }}<br>
                                  @else
                                    <b>Fechas a convenir</b><br />
                                  @endif
                                  <b>Asistencia mínima para aprobar:</b> {{ $catedra->clases_minimas }} clase/s<br>
                                  <b>Inscriptos:</b> {{ $catedra->inscripciones->count()}} / {{ $catedra->cupo }} personas<br>
                                  <div class="progress mb-3">
                                    <div class="progress-bar progress-bar-striped @if($catedra->inscripciones->count()<=$catedra->cupo) bg-success @else bg-danger @endif" role="progressbar" aria-valuenow="{{ $catedra->inscripciones->count() }}" aria-valuemin="0" aria-valuemax="{{ $catedra->cupo }}" style="width: {{ ($catedra->inscripciones->count()/$catedra->cupo)*100 }}%">
                                    </div>
                                  </div>

                                </address>
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-3 invoice-col">
                                <address>
                                    <h5>Capacitadores</h5>
                                    @forelse($catedra->capacitadores as $capacitador)
                                        {{ $capacitador->capacitador->nombre }} <b>{{ $capacitador->capacitador->apellido }}</b><br />
                                    @empty
                                        <b>Sin capacitadores asignados aún</b><br />
                                    @endforelse
                                </address>
                              </div>
                              <div class="col-sm-3 invoice-col">
                                <address>
                                    <h5>Fechas</h5>
                                    @forelse($catedra->fechas as $fecha)
                                        <b>{{ ucwords($fecha->nombre_dia()) }}</b> {{ $fecha->fecha() }}
                                        @if($fecha->hora_inicio && $fecha->hora_fin)
                                            {{ $fecha->hora_inicio('H:i',' hs') }} - {{ $fecha->hora_fin('H:i',' hs') }}
                                        @endif
                                            <br />
                                    @empty
                                        <b>Sin fechas asignadas</b><br />
                                    @endforelse
                                </address>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-12 table-responsive">
                                @if(count($catedra->inscripciones)>0)
                                <table class="table table-striped">
                                  <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Sector</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th></th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($catedra->inscripciones as $inscripto)
                                  <tr>
                                    <td>{{ $inscripto->cursante->id }}</td>
                                    <td>{{ ucwords($inscripto->cursante->nombre.' '.$inscripto->cursante->apellido) }} <small>({{ $inscripto->cursante->edad() }})</small></td>
                                    <td>{{ $inscripto->cursante->numero_documento }}</td>
                                    <td>{{ $inscripto->cursante->sector->nombre }}</td>
                                    <td>{{ $inscripto->cursante->email }}</td>
                                    <td>{{ $inscripto->cursante->telefono }}</td>
                                    <td>
                                        <form method="post" action="{{ route('inscripciones.delete',['inscripcion'=>$inscripto]) }}">
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
                                    <p>No hay cursantes anotados aún</p>
                                @endif
                              </div>
                            </div>
                        </div>

                    </div> <!--Fin de detalle de la catedra-->
                    <div class="tab-pane fade" id="custom-tabs-four-fechas" role="tabpanel" aria-labelledby="custom-tabs-four-fechas-tab">
                        <div class="row">
                            <div class="col-12 table-responsive">
                              @if($catedra->fechas)
                              <table class="table table-striped">
                                <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Fecha</th>
                                  <th>Horarios</th>
                                  <th>Presentes</th>
                                  <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($catedra->fechas as $fecha)
                                    <tr>
                                        <td>{{ $fecha->id }}</td>
                                        <td>{{ $fecha->nombre_dia() }} {{ $fecha->fecha() }}</td>
                                        <td>
                                            @if($fecha->hora_inicio && $fecha->hora_fin)
                                                {{ $fecha->hora_inicio('H:i',' hs') }} - {{ $fecha->hora_fin('H:i',' hs') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($fecha->fecha>date("Y-m-d"))
                                                Pendiente
                                            @else
                                                {{ count($fecha->presentes) }} / {{ count($catedra->inscripciones) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($fecha->fecha<=date("Y-m-d"))
                                                <a href="{{ route('presentes.edit',['fecha'=>$fecha]) }}"><i class="fas fa-child"></i> Controlar</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                              </table>
                              @else
                                  <p>No hay fechas para la cátedra</p>
                              @endif
                            </div>
                        </div>

                    </div> <!--Fin de fechas de la catedra-->
                </div>
                </div>



































                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href=" {{ route('catedras.vigentes')}} " class="btn btn-link"><i class="fas fa-chevron-left"></i> Volver a Cátedras</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


@endsection
