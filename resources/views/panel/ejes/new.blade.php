@extends('layouts.panel')

@section('title',"Ejes")

@section('seccion','Ejes')

@section('content')
     <div class="row">
        <div class="col-md-4">
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nuevo Eje</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action=" {{ route('ejes.add') }} " method="POST">
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

                    <div class="form-group">
                        <label>Nombre (*)</label>
                        <input type="text" class="form-control mb-3 {{ $errors->has("nombre")?"is-invalid":'' }}" name="nombre" value="{{ old('nombre') }}" autocomplete="off" >
                    </div>


                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
                <a href=" {{ route('ejes.index')}} " class="btn btn-link"><i class="fas fa-chevron-left"></i> Volver a Ejes</a>
            </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
