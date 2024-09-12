@extends('layouts.panel')

@section('title',"Cátedras")

@section('seccion','Cátedras')

@section('cabecera')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css" integrity="sha256-y/nn1YJAT/GwVsHZTooNErdWLjZvqMFJxNRLvigMD4I=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" integrity="sha256-b5ZKCi55IX+24Jqn638cP/q3Nb2nlx+MH/vMMqrId6k=" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/panel/timepicker/bootstrap.css') }}" />

@endsection

@section('content')
     <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Alta de fechas para cátedra</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Info del Curso <a href=" {{ route('cursos.edit',['curso'=>$catedra->curso]) }} " class="btn btn-link"><i class="far fa-edit"></i></a></h5>
                            <p><b>Curso</b>: {{ $catedra->curso->nombre }}</p>
                            <p><b>Metodología</b>: {{ $catedra->curso->metodologia->nombre }}</p>
                            <p><b>Duración</b>: {{ $catedra->curso->duracion_horas }}hs.</p>
                        </div>
                        <div class="col-md-6">
                            <div style="overflow:hidden;">
                                <div class="form-group">
                                    <h5>Hora de Inicio</h5>
                                    <div id="datetimepicker_inicio"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Info de la Cátedra <a href=" {{ route('catedras.edit',['catedra'=>$catedra]) }} " class="btn btn-link"><i class="far fa-edit"></i></a></h5>
                            <p><b>Cupo</b>: {{ $catedra->cupo }} Personas</p>
                            <p><b>Fechas</b>: {{ $catedra->fecha_inicio().' a '.$catedra->fecha_fin() }}</p>
                        </div>
                        <div class="col-md-6">
                            <div style="overflow:hidden;">
                                <div class="form-group">
                                    <h5>Hora de Fin</h5>
                                    <div id="datetimepicker_fin"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('catedras.vigentes') }}" class="btn btn-link"><i class="fas fa-chevron-left" aria-hidden="true"></i> Volver a Cátedras</a>
                    @if($fechas)
                        <a href="javascript:agregar_todas()" id="btn_todas" class="btn btn-primary float-right"><i class="far fa-calendar-plus"></i> Agregar Todas</a>
                    @endif
                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fechas</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="fechas-box">
                    <div class="list-group">
                        <form method="POST"name="formulario">
                        {{ csrf_field() }}

                        @forelse($fechas as $fecha)
                            <div class="justify-content-between list-group-item list-group-item-action @if($fecha['feriado']) alert-warning @endif">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" onchange="agregar('{{ $fecha['pos'] }}','{{ $fecha['sin_formato'] }}')" name="check{{ $fecha['pos'] }}" id="check{{ $fecha['pos'] }}" value="true" @if($fecha['feriado'] || $fecha['presentes']) disabled @endif @if($fecha['seleccionado']) checked @endif>
                                            <label for="check{{ $fecha['pos'] }}" class="custom-control-label">{{ ucfirst($fecha['nombre']) }} {{ $fecha['formato'] }} @if($fecha['feriado']) | <i class="far fa-calendar-times"></i> Feriado @endif</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control hora_inicio" id="time_desde{{ $fecha['pos'] }}" name="hora_inicio{{ $fecha['pos'] }}" autocomplete="off">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control hora_fin" id="time_hasta{{ $fecha['pos'] }}" name="hora_fin{{ $fecha['pos'] }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        @empty
                            Revise las fechas seleccionadas al momento de cargar la cátedra, es posible que no sean correctas
                        @endforelse
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('js/panel/calendario/moment.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>











    <script type="text/javascript">
        $(document).ready(function(){
            ms = Date.parse("2020-01-01 12:00:00");
            var fecha_inicio = new Date(ms);
            ms = Date.parse("2020-01-01 13:00:00");
            var fecha_fin = new Date(ms);

            $('#datetimepicker_inicio').datetimepicker({
                inline: true,
                format: 'LT',
                defaultDate: fecha_inicio
            });
            $('#datetimepicker_fin').datetimepicker({
                inline: true,
                format: 'LT',
                defaultDate: fecha_fin
            });
        });
    </script>
    <script>
        function agregar_todas(){
            $("#btn_todas").attr('href','#');
            $("#btn_todas").html('<i class="fas fa-circle-notch fa-spin"></i> Aguarde');

            for(var i=0;i<{{ count($fechas)}};i++){
                if(!$("#check"+i).attr('disabled')){
                    if($("#check"+i).prop('checked')!=true){
                        $("#check"+i).click();
                    }
                    //$("#check"+i).attr('checked',true);
                }
            }

            $("#btn_todas").slideUp('slow');
        }
    </script>
    <script>
        function agregar(pos,fecha){
            var check = $("#check"+pos).prop('checked');
            var inicio = $("#time_desde"+pos).val();
            var fin = $('#time_hasta'+pos).val();

            $.ajax({
                url: '{{ route('fechas.add',['']) }}/{{ $catedra->id }}',
                method: 'POST',
                data: {
                    "check" : check,
                    "fecha" : fecha,
                    "inicio" : inicio,
                    "fin" : fin,
                    "_token" : '{{ csrf_token() }}'
                },
                success: function(data){
                    if(!data){
                        alert('Ocurrio un inconveniente al intentar guardar datos, reintente');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var obj = JSON.parse(XMLHttpRequest.responseText);
                    console.log(obj);
                    alert('Ocurrio un error');
                }
            });
        }
    </script>
    <script>
        function update(){

            var inicio = $('#datetimepicker_inicio').data("DateTimePicker");
            var fin = $('#datetimepicker_fin').data("DateTimePicker");

            var inicio  = (inicio.date()._d.getHours() < 10 ? '0':'')+inicio.date()._d.getHours()+':'+(inicio.date()._d.getMinutes() < 10 ? '0' : '')+inicio.date()._d.getMinutes();
            var fin  = (fin.date()._d.getHours() < 10 ? '0':'')+fin.date()._d.getHours()+':'+(fin.date()._d.getMinutes() < 10 ? '0' : '')+fin.date()._d.getMinutes();

            $.ajax({
                url: '{{ route('fechas.update',['']) }}/{{ $catedra->id }}',
                method: 'PUT',
                data: {
                    "inicio" : inicio,
                    "fin" : fin,
                    "_token" : '{{ csrf_token() }}'
                },
                success: function(data){
                    if(!data){
                        alert('Ocurrio un inconveniente al intentar guardar datos, reintente');
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var obj = JSON.parse(XMLHttpRequest.responseText);
                    console.log(obj);
                    alert('Ocurrio un error');
                }
            });
        }
    </script>
    @foreach($fechas as $fecha)
        <script type="text/javascript">
             $(document).ready(function(){
                var hora_inicio = "2020-01-01 12:00:00";

                @if($fecha['hora_inicio'])
                    hora_inicio = '2020-01-01 {{ $fecha['hora_inicio'] }}';
                @endif

                ms = Date.parse(hora_inicio);
                hora_inicio = new Date(ms);
                $('#time_desde{{ $fecha['pos'] }}').datetimepicker({
                    format: 'LT',
                    defaultDate: hora_inicio
                });

                var hora_fin = "2020-01-01 13:00:00";

                @if($fecha['hora_fin'])
                    hora_fin = '2020-01-01 {{ $fecha['hora_fin'] }}';
                @endif

                ms = Date.parse(hora_fin);
                hora_fin = new Date(ms);
                $('#time_hasta{{ $fecha['pos'] }}').datetimepicker({
                    format: 'LT',
                    defaultDate: hora_fin
                });
            });
        </script>


    @endforeach
    <script>
        $( document ).ready(function() {
            @foreach($fechas as $fecha)
                $('#time_hasta{{ $fecha['pos'] }}').on('dp.change', function(fecha){
                    agregar('{{ $fecha['pos'] }}','{{ $fecha['sin_formato'] }}');
                });
                $('#time_desde{{ $fecha['pos'] }}').on('dp.change', function(fecha){
                    agregar('{{ $fecha['pos'] }}','{{ $fecha['sin_formato'] }}');
                });
            @endforeach

            $('#datetimepicker_inicio').on('dp.change', function(fecha){
                var horas = fecha.date._d.getMinutes();
                $(".hora_inicio").val(((fecha.date._d.getHours() + 11) % 12 + 1)+':'+((horas < 10 ? '0' : '') + horas)+' '+((fecha.date._d.getHours() < 12 ? 'AM' : 'PM')));
                update();
            });

            $('#datetimepicker_fin').on('dp.change', function(fecha){
                var horas = fecha.date._d.getMinutes();
                $(".hora_fin").val(((fecha.date._d.getHours() + 11) % 12 + 1)+':'+((horas < 10 ? '0' : '') + horas)+' '+((fecha.date._d.getHours() < 12 ? 'AM' : 'PM')));
                update();
            });
        });
    </script>
@endsection
