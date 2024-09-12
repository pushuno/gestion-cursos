@extends('layouts.panel')

@section('title',"Cursantes")

@section('seccion','Cursantes')

@section('cabecera')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('js/panel/select2-bootstrap4.css')}}" rel="stylesheet" />
@endsection


@section('content')
     <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalle del Cursante</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if($cursante)
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                          <div class="col-12">
                            <h4>
                                <i class="fas fa-user-graduate"></i> {{ ucwords($cursante->nombre.' '.$cursante->apellido) }}
                              <!--<small class="float-right">Date: 2/10/2014</small>-->
                            </h4>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                          <div class="col-sm-4 invoice-col">
                            <address>
                                <h5>Personal</h5>
                                <b>Fecha de nacimiento:</b> {{ $cursante->fecha_nacimiento() }}<br>
                                <b>Documento:</b> {{ $cursante->numero_documento }}<br>
                                <b>Nivel de estudio:</b>
                                @if($cursante->titulo)
                                    {{ $cursante->titulo }} -
                                @endif
                                {{ $cursante->nivel_estudio->nombre }}<br>
                                <b>Fecha de Ingreso:</b> {{ $cursante->fecha_ingreso() }}<br>
                                <b>Alta:</b> {{ $cursante->creacion() }}
                            </address>
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 invoice-col">
                            <address>
                              <h5>Laboral</h5>
                              <b>Fecha de ingreso:</b> {{ $cursante->fecha_ingreso() }}<br>
                              <b>Sector:</b> {{ $cursante->sector->nombre }}<br>
                                @if($cursante->direccion)
                                    <b>Direcci&oacute;n:</b> {{ $cursante->direccion }}<br>
                                @endif
                                @if($cursante->categoria)
                                    <b>Categoría:</b> {{ $cursante->categoria }}<br>
                                @endif
                                @if($cursante->afiliado)
                                    <b>N&uacute;mero de Afiliado:</b> {{ $cursante->afiliado }}
                                    @if($cursante->afiliado_barra)
                                        / {{ $cursante->afiliado_barra }}
                                    @endif
                                    <br>
                                @endif
                                @if($cursante->legajo)
                                    <b>Legajo:</b> {{ $cursante->legajo }}<br>
                                @endif

                            </address>
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 invoice-col">
                            <address>
                                <h5>Contacto</h5>
                                @if($cursante->email)
                                    <b>Email:</b> <a href="mailto:{{ $cursante->email }}">{{ $cursante->email }}</a> <br />
                                @endif
                                @if($cursante->telefono)
                                    <b>Teléfono:</b> {{ $cursante->telefono }} <br />
                                @endif
                            </address>
                          </div>

                          <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <h4>
                                Inscripciones
                            </h4>
                          <div class="col-12 table-responsive">
                            @if(count($inscripciones)>0)
                            <table class="table table-striped">
                              <thead>
                              <tr>
                                <th>#</th>
                                <th>Curso</th>
                                <th>Metodología</th>
                                <th>Cupo</th>
                                <th>Fechas</th>
                                <th>Asistencia</th>
                                <th>Progreso</th>
                                <th>Estado</th>
                                <th style="width:20px"></th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($inscripciones as $inscripcion)
                                @php
                                    $pendientes = 0;
                                @endphp
                                @if($inscripcion->catedra->fechas_pendientes())
                                    @php
                                        $pendientes = count($inscripcion->catedra->fechas_pendientes());
                                    @endphp
                                @endif
                              <tr>
                                <td>{{ $inscripcion->catedra->id }}</td>
                                <td>{{ ucwords($inscripcion->catedra->curso->nombre) }}</td>
                                <td>{{ $inscripcion->catedra->curso->metodologia->nombre }}</td>
                                <td>{{ $inscripcion->catedra->inscripciones->count() }} / {{ $inscripcion->catedra->cupo }}</td>
                                <td>{{ $inscripcion->catedra->fecha_inicio() }} al {{ $inscripcion->catedra->fecha_fin() }}</td>
                                <td>{{ count($inscripcion->cursante->presentes) }} / {{ $pendientes }} Clases</td>
                                <td>{{ $pendientes }} / {{ count($inscripcion->catedra->fechas) }} Clases</td>
                                <td>
                                    @if($inscripcion->catedra->eliminado)
                                        Cátedra eliminada
                                        @php
                                            $color = "bg-danger";
                                        @endphp
                                    @else
                                        @if( $pendientes < count($inscripcion->catedra->fechas))
                                            Iniciado
                                            @php
                                                $color = "bg-primary";
                                            @endphp
                                        @elseif( $pendientes ==0)
                                            Finalizado
                                            @php
                                                $color = "bg-success";
                                            @endphp
                                        @else
                                            Pendiente
                                            @php
                                                $color = "bg-default";
                                            @endphp
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <form method="post" action="{{ route('inscripciones.delete',['inscripcion'=>$inscripcion]) }}">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link"><i class="far fa-trash-alt text-danger"></i></button>
                                    </form>
                                </td>
                                <td class="{{ $color }}">
                                </td>
                              </tr>
                              @endforeach
                              </tbody>
                            </table>
                            @else
                                <p>El cursante no se inscribió a ninguna cátedra aún</p>
                            @endif
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!--<div class="row">
                          <div class="col-6">
                            <p class="lead">Payment Methods:</p>
                            <img src="../../dist/img/credit/visa.png" alt="Visa">
                            <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                            <img src="../../dist/img/credit/american-express.png" alt="American Express">
                            <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                              Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                              plugg
                              dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                            </p>
                          </div>
                          <div class="col-6">
                            <p class="lead">Amount Due 2/22/2014</p>

                            <div class="table-responsive">
                              <table class="table">
                                <tbody><tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td>$250.30</td>
                                </tr>
                                <tr>
                                  <th>Tax (9.3%)</th>
                                  <td>$10.34</td>
                                </tr>
                                <tr>
                                  <th>Shipping:</th>
                                  <td>$5.80</td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>$265.24</td>
                                </tr>
                              </tbody></table>
                            </div>
                          </div>
                        </div>-->

                        <!--<div class="row no-print">
                          <div class="col-12">
                            <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                            <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                              Payment
                            </button>
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                              <i class="fas fa-download"></i> Generate PDF
                            </button>
                          </div>
                        </div>-->
                      </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href=" {{ route('cursantes.index')}} " class="btn btn-link"><i class="fas fa-chevron-left"></i> Volver a Cursantes</a>
                </div>
            @else
                <p>No se encontró el cursante</p>
            @endif
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
