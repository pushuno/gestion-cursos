@extends('layouts.panel')

@section('title',"Conocimientos Previos")

@section('seccion','Conocimientos Previos')

@section('content')
     <div class="row">
        <div class="col-md-6">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuevo Conocimiento</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action=" {{ route('conocimientos.add') }} " method="POST">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nombre (*)</label>
                                <input type="text" class="form-control mb-3 {{ $errors->has("nombre")?"is-invalid":'' }}" name="nombre" value="{{ old('nombre') }}" autocomplete="off" >
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <a href=" {{ route('conocimientos.index')}} " class="btn btn-link"><i class="fas fa-chevron-left"></i> Volver a Conocimientos</a>
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection

