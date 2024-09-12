@extends('layouts.panel')

@section('title',"Presentismo")

@section('seccion','Presentismo')

@section('content')
     <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Presentismo</h3>
                <div class="card-tools">

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="fecha_busqueda" value="{{ old('fecha_busqueda',$fecha_formato) }}" placeholder="Filtrar fecha">
                        <div class="input-group-append">
                          <span class="input-group-text"><a href="{{ route('presentes.index',['']) }}" title="Quitar Filtro"><i class="far fa-calendar-alt"></i></a></span>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if(count($fechas)>0)
                    <table class="table">
                    <thead>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Curso</th>
                        <th>Presentes</th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fechas as $fecha)
                            <tr>
                                <td>{{ $fecha->id }}</td>
                                <td>{{ $fecha->fecha() }}</td>
                                <td>{{ $fecha->hora_inicio('H:i').'hs a '.$fecha->hora_fin('H:i') }}hs</td>
                                <td>{{ ucwords($fecha->catedra->curso->nombre) }}</td>
                                <td>
                                    @if($fecha->fecha>date("Y-m-d"))
                                        Pendiente
                                    @else
                                        {{ $fecha->presentes->count() }} / {{ $fecha->catedra->inscripciones->count() }}
                                    @endif
                                </td>
                                <td>
                                    @if($fecha->fecha<=date("Y-m-d"))
                                        <a href=" {{ route('presentes.edit',['fecha'=>$fecha]) }} " class="btn btn-link"><i class="far fa-edit"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                @else
                    <p>No hay cátedras en la fecha seleccionada</p>
                @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                {{ $fechas->links() }}
            </div>
            </div>
            <!-- /.card -->
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
        }).on('changeDate', function(dateText){
            var dateTime = new Date($("[name='fecha_busqueda']").datepicker("getDate"));
            var fecha = dateTime.toISOString().substr(0, 10);
            location.href="{{ route('presentes.index',['']) }}/"+fecha;
    });

    </script>



@endsection

