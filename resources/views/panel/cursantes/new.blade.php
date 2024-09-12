@extends('layouts.panel')

@section('title',"Cursantes")

@section('seccion','Cursantes')

@section('content')
     <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuevo Cursante</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action=" {{ route('cursantes.add') }} " method="POST">
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
                                <label>Nombre (*)</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("nombre")?"is-invalid":'' }}" name="nombre" value="{{ old('nombre') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Apellido (*)</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("apellido")?"is-invalid":'' }}" name="apellido" value="{{ old('apellido') }}" autocomplete="off" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha de Nacimiento (*)</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("fecha_nacimiento")?"is-invalid":'' }}" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha de Ingreso (*)</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("fecha_ingreso")?"is-invalid":'' }}" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Núm Documento (*)</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("numero_documento")?"is-invalid":'' }}" name="numero_documento" value="{{ old('numero_documento') }}" autocomplete="off" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nivel de estudio (*)</label>
                                <select class="custom-select mb-3 {{ $errors->has("nivel_estudio_id")?"is-invalid":'' }}" name="nivel_estudio_id">
                                    @foreach($nivel_estudios as $nivel_estudio)
                                        <option value="{{ $nivel_estudio->id }}">{{ $nivel_estudio->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("titulo")?"is-invalid":'' }}" name="titulo" value="{{ old('titulo') }}" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sector (*)</label>
                                <select class="custom-select mb-3 {{ $errors->has("sector_id")?"is-invalid":'' }}" name="sector_id">
                                    @foreach($sectores as $sector)
                                        <option value="{{ $sector->id }}">{{ $sector->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dirección a la que pertenece</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("direccion")?"is-invalid":'' }}" name="direccion" value="{{ old('direccion') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Categoría</label>
                                <select class="custom-select mb-3 {{ $errors->has("categoria")?"is-invalid":'' }}" name="categoria">
                                    <option value="">Seleccione</option>
                                    @for($i=1;$i<15;$i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Afiliado</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("afiliado")?"is-invalid":'' }}" name="afiliado" value="{{ old('afiliado') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Barra</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("afiliado_barra")?"is-invalid":'' }}" name="afiliado_barra" value="{{ old('afiliado_barra') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Legajo</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("legajo")?"is-invalid":'' }}" name="legajo" value="{{ old('legajo') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("email")?"is-invalid":'' }}" name="email" value="{{ old('email') }}" autocomplete="off" >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("telefono")?"is-invalid":'' }}" name="telefono" value="{{ old('telefono') }}" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <a href=" {{ route('cursantes.index')}} " class="btn btn-link"><i class="fas fa-chevron-left"></i> Volver a Cursantes</a>
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
