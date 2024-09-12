@extends('layouts.panel')

@section('title',"Cursos")

@section('seccion','Cursos')

@section('cabecera')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('js/panel/select2-bootstrap4.css')}}" rel="stylesheet" />
@endsection

@section('content')
     <div class="row">
        <div class="col-md-6">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edición de Curso</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action=" {{ route('cursos.update',['curso' => $curso]) }} " method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

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
                                <label>Nombre (*)</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("nombre")?"is-invalid":'' }}" name="nombre" value="{{ old('nombre',$curso->nombre) }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Metodología (*)</label>
                                <select class="custom-select mb-3 {{ $errors->has("metodologia_id")?"is-invalid":'' }}" name="metodologia_id">
                                    @foreach($metodologias as $metodologia)
                                        <option value="{{ $metodologia->id }}" @if($metodologia->id==$curso->metodologia_id) selected @endif>{{ $metodologia->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Horas de Duración (*)</label>
                                <input type="number" min="1" class="form-control mb-3 {{ $errors->has("duracion_horas")?"is-invalid":'' }}" name="duracion_horas" value="{{ old('duracion_horas',$curso->duracion_horas) }}" autocomplete="off" >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Eje (*)</label>
                                <select class="custom-select mb-3 {{ $errors->has("eje_id")?"is-invalid":'' }}" name="eje_id">
                                    @foreach($ejes as $eje)
                                        <option value="{{ $eje->id }}" @if($eje->id==$curso->eje_id) selected @endif>{{ $eje->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Conocimientos requeridos</label>
                                <select class="form-control select2 select2-hidden-accessible" multiple="" name="conocimientos[]"  style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    @foreach($conocimientos as $conocimiento)
                                        <option value="{{ $conocimiento->id }}">{{ $conocimiento->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descripción del Curso</label>
                                <textarea name="descripcion" rows="10" cols="40" class="form-control mb-3 {{ $errors->has("descripcion")?"is-invalid":'' }}">{{ old('descripcion',$curso->descripcion) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descripción cantidad de clases (*)</label>
                                <textarea name="duracion_leyenda" rows="10" cols="40" class="form-control mb-3 {{ $errors->has("duracion_leyenda")?"is-invalid":'' }}">{{ old('duracion_leyenda',$curso->duracion_leyenda) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <a href=" {{ route('cursos.index')}} " class="btn btn-link"><i class="fas fa-chevron-left"></i> Volver a Cursos</a>
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

            var selectedValues = new Array();
            {{ $i=0 }}

            @foreach($curso->conocimientos as $conocimiento)

                selectedValues[{{$i}}] = {{ $conocimiento->conocimiento->id }};
                {{ $i++ }}

            @endforeach
            $('.select2').val(selectedValues).trigger('change');
        });
    </script>
    <script>
        $("[name='fecha_ingreso']").datepicker({
            maxViewMode: 1,
            language: "es",
            todayHighlight: true,
            dateFormat: 'yy-mm-dd',
            endDate: "0d"
        });

        $("[name='fecha_nacimiento']").datepicker({
            maxViewMode: 1,
            language: "es",
            todayHighlight: true,
            dateFormat: 'yy-mm-dd',
            endDate: "-12y"
        });
    </script>
@endsection
