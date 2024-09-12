@extends('layouts.panel')

@section('title',"Presentismo")

@section('seccion','Presentismo')


@section('content')
     <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Control de Presentismo</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                    @if($fecha->catedra->inscripciones->count() > 0)
                        <form method="post" name="formulario">
                            {{ csrf_field() }}
                            <table class="table">
                            <thead>
                                <tr>
                                <th style="width: 10px">#</th>
                                <th>Cursante</th>
                                <th>Curso</th>
                                <th>Presente</th>
                                <th>Auditoría</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fecha->catedra->inscripciones as $inscripto)
                                    @php
                                        $anotado = $fecha->presente($inscripto);
                                    @endphp
                                    <tr>
                                        <td>{{ $inscripto->id }}</td>
                                        <td>{{ $inscripto->cursante->nombre." ".$inscripto->cursante->apellido }}</td>
                                        <td>{{ ucwords($inscripto->catedra->curso->nombre) }}</td>
                                        <td><div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" onchange="presente({{ $inscripto->id }})" type="checkbox" name="check{{ $inscripto->id }}" id="check{{ $inscripto->id }}" value="true" @if($anotado) checked @endif>
                                            <label for="check{{ $inscripto->id }}" class="custom-control-label"></label>
                                        </div>
                                        </td>
                                        <td id="creador{{ $inscripto->id }}">
                                            @if($anotado)
                                                {{ ucwords($anotado->name." ".$anotado->lastname) }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </form>
                    @else
                        <p>No hay inscriptos para la cátedra seleccionada</p>
                    @endif
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fas fa-chevron-left"></i> Volver a Presentismo</a>
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection


@section('scripts')
    <script>
        function presente(id){
            $.ajax({
                url: '{{ route('presentes.add',['']) }}/{{ $fecha->id }}',
                method: 'POST',
                data: $("[name='formulario']").serialize(),
                success: function(data){
                    if(data){
                        if($("#check"+id).prop('checked')){
                            $("#creador"+id).html('{{ ucwords(strtolower(Auth::user()->name.' '.Auth::user()->lastname)) }}');
                        }else{
                            $("#creador"+id).html('');
                        }
                    }else{
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
@endsection


