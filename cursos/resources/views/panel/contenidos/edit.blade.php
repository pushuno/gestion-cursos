@extends('layouts.panel')

@section('title',"Contenidos")

@section('seccion','Contenidos')

<!--


DEPRECADO


-->
@section('cabecera')
<link href="{{ asset('css/panel/editor/summernote-bs4.css') }}" rel="stylesheet">
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
  <!--sortable-->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!--fin de sortable-->
@endsection

@section('content')
     <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edición de Contenido</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

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
                                    <label>Cátedra (*)</label>
                                    <h4>{{ $catedra->curso->nombre }}</h4>
                                    <input type="hidden" name="catedra_id" value="{{ $catedra->id }}">
                                </div>
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <h4>{{ $fecha->fecha('d/m/Y') }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Elemento</label>
                                    <select class="custom-select mb-3" id="elemento" onchange="seleccionar_elemento()">
                                        <option value="">Seleccione</option>
                                        <option value="titulo">Titulo</option>
                                        <option value="texto">Texto</option>
                                        <option value="imagen">Imágen</option>
                                        <option value="video">Video</option>
                                        <option value="file">Archivo Descargable</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="elementos" id="titulo" style="display:none">
                            <form method="post" action="{{ route('contenidos.add_titulo',['fecha'=>$fecha]) }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Título (*)</label>
                                    <input type="text" class="form-control mb-3 {{ $errors->has("titulo")?"is-invalid":'' }}" name="titulo" value="{{ old('titulo') }}" autocomplete="off" >
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-plus-square"></i> Agregar</button>
                                </div>
                            </form>
                        </div>
                        <div class="elementos" id="texto" style="display:none">
                                <div class="form-group">
                                    <label>Contenido</label>
                                    <div class="textarea"></div>
                                </div>
                                <div class="form-group">
                                    <button type="button" onclick="guardar_texto()" class="btn btn-success"><i class="fas fa-plus-square"></i> Agregar</button>
                                </div>
                        </div>
                        <div class="elementos" id="file" style="display:none">
                            <form method="post" action="{{ route('contenidos.add_archivo',['fecha'=>$fecha]) }}" enctype='multipart/form-data' accept-charset="UTF-8">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Seleccionar archivo</label>
                                    </div>
                                    <div class="input-group-append">
                                    <button type="submit" class="input-group-text" id="">Subir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="elementos" id="imagen" style="display:none">
                            <form method="post" action="{{ route('contenidos.add_imagen',['fecha'=>$fecha]) }}" enctype='multipart/form-data' accept-charset="UTF-8">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Seleccionar archivo</label>
                                    </div>
                                    <div class="input-group-append">
                                    <button type="submit" class="input-group-text" id="">Subir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="elementos" id="video" style="display:none">
                            <form method="post" action="{{ route('contenidos.add_video',['fecha'=>$fecha]) }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Video</label>
                                    <input type="text" class="form-control mb-3" placeholder="https://www.youtube.com/watch?v=hsgY_IrD3h0" name="link" autocomplete="off" >
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-plus-square"></i> Agregar</button>
                                </div>
                            </form>
                        </div>




                        <!--<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha (*)</label>
                                    <select class="custom-select mb-3 {{ $errors->has("fecha_id")?"is-invalid":'' }}" name="fecha_id">

                                            <option value="{{ $fecha->id }}" >{{ $fecha->fecha('d/m/Y') }}</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">

                            </div>
                        </div>-->

                        <div class="row">
                            <div class="col-md-12">

                            </div>
                        </div>

                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href=" {{ route('contenidos.fechas',['catedra' => $catedra])}} " class="btn btn-link"><i class="fas fa-chevron-left"></i> Volver a Fechas</a>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Vista Previa</h3>
                </div>

                <script>
                $( function() {
                  $( "#sortable" ).sortable();
                  $( "#sortable" ).disableSelection();
                } );
                </script>

                <div class="card-body" id="sortable">
                    @forelse($contenidos as $item)
                      @php
                       $obj = json_decode($item->contenido);
                      @endphp
                        @switch($obj->tipo)
                            @case('titulo')
                                <div class="row ui-state-default mb-4" id="{{ $item->id }}" style="cursor:grab">
                                    <div class="col-11">
                                        <h3>{{ ucfirst($obj->texto) }}</h3>
                                    </div>
                                    <div class="col-1">
                                        <form method="post" action="{{ route('contenidos.delete',['contenido' => $item->id]) }}">
                                            {{ csrf_field() }}
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-link">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @break
                            @case('texto')
                                <div class="row ui-state-default mb-4" id="{{ $item->id }}" style="cursor:grab">
                                    <div class="col-11">
                                        {!! $obj->texto !!}
                                    </div>
                                    <div class="col-1">
                                        <form method="post" action="{{ route('contenidos.delete',['contenido' => $item->id]) }}">
                                            {{ csrf_field() }}
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-link">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @break
                            @case('imagen')
                                <div class="row ui-state-default mb-4" id="{{ $item->id }}" style="cursor:grab">
                                    <div class="col-11">
                                        <img src="{{ asset($obj->imagen) }}" style="width:100%" />
                                    </div>
                                    <div class="col-1">
                                        <form method="post" action="{{ route('contenidos.delete',['contenido' => $item->id]) }}">
                                            {{ csrf_field() }}
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-link">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            @break
                            @case('archivo')
                                <div class="row ui-state-default mb-4" id="{{ $item->id }}" style="cursor:grab">
                                    <div class="col-11">
                                        <a href="{{ route('contenidos.getfile', $item->id) }}" class="btn float-center"><i class="fas fa-download"></i> Descargar Archivo</a>
                                    </div>
                                    <div class="col-1">
                                        <form method="post" action="{{ route('contenidos.delete',['contenido' => $item->id]) }}">
                                            {{ csrf_field() }}
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-link">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            @break
                            @case('video')
                                <div class="row ui-state-default mb-4" id="{{ $item->id }}" style="cursor:grab">
                                    <div class="col-11">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $obj->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <div class="col-1">
                                        <form method="post" action="{{ route('contenidos.delete',['contenido' => $item->id]) }}">
                                            {{ csrf_field() }}
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-link">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @break

                            @default

                        @endswitch

                    @empty
                        No hay contenido cargado aún
                    @endforelse
                </div>
                <div class="card-footer clearfix">
                    @if(count($contenidos)>1)
                        <a href="javascript:guardar_orden()" class="btn btn-info float-right"><i class="far fa-save"></i> Guardar Orden</a>
                    @endif
                </div>
            </div>
        </div>




    </div>

@endsection

@section('scripts')


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
    function guardar_orden(){
        var idsInOrder = $("#sortable").sortable("toArray");
          $.ajax({
            url: '{{ route('contenidos.order',['fecha'=>$fecha]) }}',
            type: "POST",
            data: {'_token': '{{ csrf_token() }}',
            "array":JSON.stringify(idsInOrder)},
            success: function(data){
              if(data){
                alert('Se guardó el orden correctamente');
              }else{
                alert('No se pudo guardar el orden');
              }
            }
          });
    }
</script>
<script>
    function seleccionar_elemento(){
        var elemento = $("#elemento").val();
        $(".elementos").hide();
        $("#"+elemento).slideDown("slow");
    }
</script>
<script>
    function guardar_texto(){
        var texto = $(".note-editable").html();
        $.ajax({
            'url': '{{ route('contenidos.add_texto',['fecha'=>$fecha])}}',
            type: 'POST',
            data: {
                '_token': '{{ csrf_token() }}',
                'texto': texto
            },
            success: function (data){
                window.location = '{{ route('contenidos.edit',['fecha'=> $fecha]) }}';
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
                alert('Ocurrio un error al intentar guardar el texto');
            }
        });
    }
</script>
@endsection
