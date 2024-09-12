@extends('layouts.panel')

@section('title',"Contenidos")

@section('seccion','Contenidos')

<!--


DEPRECADO


-->

@section('cabecera')
<link href="{{ asset('css/panel/editor/summernote-bs4.css') }}" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
@endsection

@section('content')
     <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Cátedra {{ $catedra->curso->nombre }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="form-group">
                        <label>Cátedra</label>
                        <h4>{{ $catedra->curso->nombre }}</h4>
                        <p></p>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <a href="{{ route('catedras.vigentes') }}" class="btn btn-link"><i class="fas fa-chevron-left"></i> Volver a Cátedras</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fechas de la cátedra {{ $catedra->curso->nombre }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="list-group">
                        @php
                            $clase = 0;
                        @endphp
                        @forelse($fechas as $fecha_item)
                            @php
                                $clase++;
                            @endphp

                            <a href="{{ route('contenidos.edit',['fecha'=>$fecha_item]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Clase {{ $clase }}</h5>
                                    <small>Desde {{ $fecha_item->fecha('d/m/Y') }}</small>
                                </div>
                                <p class="mb-1">
                                    @if($fecha_item->contenidos()->count()>0)
                                    {{ $fecha_item->contenidos()->count() }} elementos
                                    @endif
                                </p>
                                <small></small>
                            </a>
                        @empty
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">No hay fechas cargadas para esta Cátedra</a>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')



<script src="{{ asset('js/panel/editor/summernote-bs4.min.js') }}"></script>
<script>
     $(function () {
        // Summernote
        $('.textarea').summernote({
            height: 200
        })
    })
</script>
<script>
    function seleccionar_elemento(){
        var elemento = $("#elemento").val();
        $(".elementos").hide();
        $("#"+elemento).slideDown("slow");
    }
</script>
@endsection
