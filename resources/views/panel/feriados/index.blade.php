@extends('layouts.panel')

@section('title',"Feriados")

@section('seccion','Feriados')

@section('content')
    <style>
        .datepicker.dropdown-menu {
            z-index: 9999 !important;
        }
    </style>
     <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Feriados</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" name="formulario">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="text" class="form-control" name="fecha_busqueda">
                            <input type="hidden" name="fecha">
                        </div>
                        <div class="form-group">
                            <a href="javascript:agregar()" class="btn btn-primary"><i class="fas fa-plus"></i> Agregar</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Feriados</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                    <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                          @foreach($meses as $mes)
                          <a onclick="cargar({{ $mes['numero'] }})" class="nav-link @if($mes['numero']==1) active show @endif tab" data-number="{{ $mes['numero'] }}" id="vert-tabs-{{ $mes['nombre'] }}-tab" data-toggle="pill" href="#vert-tabs-{{ $mes['nombre'] }}" role="tab" aria-controls="vert-tabs-home" aria-selected=" @if($mes['numero']==1) true @else false @endif">{{ $mes['nombre'] }}</a>
                          @endforeach
                        </div>
                    </div>
                    <div class="col-7 col-sm-9">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            @foreach($meses as $mes)
                                <div class="tab-pane text-left fade @if($mes['numero']==1) active show @endif" id="vert-tabs-{{ $mes['nombre'] }}" role="tabpanel" aria-labelledby="vert-tabs-{{ $mes['nombre'] }}-tab">
                                    <div class="list-group" id="mes{{ $mes['numero'] }}">
                                        <div class="justify-content-between list-group-item list-group-item-action">
                                            <i class="fas fa-circle-notch fa-spin"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js" integrity="sha256-K5G+7qV0tjuHL0LlhCU0TqQKR+7QwT8MfEUe2UgpmRY=" crossorigin="anonymous"></script>

    <script>
        $("[name='fecha_busqueda']").datepicker({
            maxViewMode: 1,
            language: "es",
            todayHighlight: true,
            dateFormat: 'yy-mm-dd',
            autoclose: true,
            widgetPositioning: {
                horizontal: 'right',
                vertical: 'top'
            }
        });
    </script>
    <script>
        function cargar(mes){
            $.ajax({
                url: '{{ route('feriados.data',['']) }}/'+mes,
                method: "GET",
                success: function(data){
                    if(data){
                        var obj = JSON.parse(data);
                        var item,html = '';
                        if(obj.length>0){
                            for(var i=0;i<obj.length;i++){
                                item = obj[i];
                                html += '<div class="justify-content-between list-group-item list-group-item-action">\
                                            <div class="d-flex w-100 justify-content-between">\
											    <h5 class="mt-1">'+item.fecha+'</h5>\
											    <small>\
                                                    <a href="javascript:eliminar('+item.id+')" class="btn btn-link"><i class="far fa-trash-alt text-danger"></i></a>\
                                                </small>\
											</div>\
                                        </div>';
                            }
                        }else{
                            html = '<div class="justify-content-between list-group-item list-group-item-action">\
                                        <p class="mb-1">No hay feriados este mes</p>\
                                    </div>';
                        }
                        $("#mes"+mes).html(html);
                    }else{
                        alert('Ocurrio un inconveniente al intentar cargar datos, reintente');
                    }
                }
            });
        }
        window.addEventListener('load', cargar(1), false);
    </script>
    <script>
        function agregar(){
            var mes = $(".nav-link.tab.active").attr('data-number');
            var fecha = $("[name='fecha_busqueda']").val();
            var fecha_split = fecha.split('/');
            $("[name='fecha']").val(fecha_split[2]+'-'+fecha_split[1]+'-'+fecha_split[0]);
            $.ajax({
                url: '{{ route('feriados.add') }}',
                method: "POST",
                data: $("[name='formulario']").serialize(),
                success: function(data){
                    cargar(mes);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var obj = JSON.parse(XMLHttpRequest.responseText);
                    alert(obj.errors.fecha[0]);
                }
            });
            $("[name='fecha_busqueda']").val('');
        }
    </script>
    <script>
        function eliminar(id){
            var mes = $(".nav-link.tab.active").attr('data-number');
            if(confirm('Desea eliminar este feriado?')){
                $.ajax({
                    url: '{{ route('feriados.delete',['']) }}/'+id,
                    method: "DELETE",
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data){
                        cargar(mes);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        var obj = JSON.parse(XMLHttpRequest.responseText);
                        alert(obj.errors.fecha[0]);
                    }
                });
            }
        }
    </script>
@endsection
