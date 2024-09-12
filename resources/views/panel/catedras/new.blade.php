@extends('layouts.panel')

@section('title',"Catedras")

@section('seccion','Cátedras')

@section('cabecera')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('js/panel/select2-bootstrap4.css')}}" rel="stylesheet" />
@endsection


@section('content')
     <div class="row">
        <div class="col-md-6">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuevo Cátedra</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action=" {{ route('catedras.add') }} " method="POST">
                    {{ csrf_field() }}

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <p>Debe revisar los siguientes errores:</p>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Curso (*)</label>

                                <select class="custom-select mb-3 {{ $errors->has("curso_id")?"is-invalid":'' }}" name="curso_id">
                                    @forelse($cursos as $curso)
                                        <option value="{{ $curso->id }}">{{ ucwords($curso->nombre) }}</option>
                                    @empty
                                        <option>No hay cursos cargados</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha de Inicio</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("fecha_inicio")?"is-invalid":'' }}" name="fecha_inicio" value="{{ old('fecha_inicio') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha de Fin</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("fecha_fin")?"is-invalid":'' }}" name="fecha_fin" value="{{ old('fecha_fin') }}" autocomplete="off" >
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cupo (*)</label>
                                <input type="number" min="1" class="form-control mb-3 {{ $errors->has("cupo")?"is-invalid":'' }}" name="cupo" value="{{ old('cupo') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Clases mínimas (*)</label>
                                <input type="number" min="1" name="clases_minimas" class="form-control mb-3 {{ $errors->has("clases_minimas")?"is-invalid":'' }}" value="{{ old('clases_minimas') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Capacitadores (*)</label>
                                <select class="form-control select2 select2-hidden-accessible"  multiple="" name="capacitadores[]"  style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    @foreach($capacitadores as $capacitador)
                                        <option value="{{ $capacitador->id }}">{{ $capacitador->nombre." ".$capacitador->apellido  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @if(count($cursos)>0)
                        <button type="submit" class="btn btn-success">Guardar</button>
                    @else
                        <i>Debe cargar cursos antes de cargar una cátedra</i>
                    @endif
                </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js" integrity="sha256-K5G+7qV0tjuHL0LlhCU0TqQKR+7QwT8MfEUe2UgpmRY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $("[name='fecha_inicio']").datepicker({
            maxViewMode: 1,
            language: "es",
            todayHighlight: true,
            dateFormat: 'yy-mm-dd',
        });

        $("[name='fecha_fin']").datepicker({
            maxViewMode: 1,
            language: "es",
            todayHighlight: true,
            dateFormat: 'yy-mm-dd',
        });
    </script>
@endsection
