@extends('layouts.portal')

@section('contenido')
    <!--FACEBOOK-->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v7.0&appId=269339924328771&autoLogAppEvents=1" nonce="UH67ZNRi"></script>
    <!--FIN DE FACEBOOK-->

    <div class="col-md-8">
        <h3 class="mb-3">{{ $catedra->curso->nombre }}</h3>

        @if($fecha->vigente())
            @forelse($contenidos as $item)
                    @php
                    $obj = json_decode($item->contenido);
                    @endphp
                        @switch($obj->tipo)
                            @case('titulo')
                                    <div class="col-12 mb-4">
                                        <h3>{{ $obj->texto }}</h3>
                                    </div>
                            @break
                            @case('texto')
                                    <div class="col-12 mb-4">
                                        {!! $obj->texto !!}
                                    </div>
                            @break
                            @case('imagen')
                                    <div class="col-12 mb-4">
                                        <img src="{{ asset($obj->imagen) }}" style="width:100%" />
                                    </div>

                            @break
                            @case('archivo')
                                <div class="col-12 mb-4">
                                    <a href="{{ route('contenidos.getfile', $item->id) }}" class="btn float-center"><i class="fas fa-download"></i> Descargar Archivo</a>
                                </div>
                        @break
                            @case('video')
                                    <div class="col-12 mb-4">
                                        <iframe  style="width:100%;min-height:400px;" src="https://www.youtube.com/embed/{{ $obj->link }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                            @break

                            @default

                        @endswitch
            @empty
                No hay contenido cargado para la clase
            @endforelse

            <!--comentarios facebook-->
            <div class="fb-comments" data-href="http://salud.das.gob.ar/capacitacion" data-numposts="5" data-width=""></div>


        @else
            <div class="card">
                <div class="card-body">
                    <i class="fas fa-lock"></i> Esta clase no está disponible actualmente.
                </div>
            </div>
        @endif

        <div class="row mt-3">
            <div class="col-3">
                @if($fecha->fecha_anterior() && $fecha->fecha_anterior()->vigente())
                    <a href="{{ $fecha->fecha_anterior()->id }}" class="btn btn-md btn-secondary c-bg-teal0"><i class="fas fa-chevron-left"></i> Clase Anterior</a>
                @endif
            </div>
            <div class="col-6">
            </div>
            <div class="col-3">
            @if($fecha->fecha_proxima() && $fecha->fecha_proxima()->vigente())
                    <a href="{{ $fecha->fecha_proxima()->id }}" class="btn btn-md btn-secondary c-bg-teal0">Próxima Clase <i class="fas fa-chevron-right"></i></a>
                @endif
            </div>
        </div>

    </div>
    <div class="col-md-4 mt-3">
        @php
            $clase = 0;
        @endphp
        <div class="list-group">
            @forelse($fechas as $fecha_item)
                @php
                    $clase++;
                @endphp

                <a href="@if(!$fecha_item->vigente()) # @else {{ route('portal.contenido',['catedra'=>$catedra,'fecha'=>$fecha_item]) }} @endif" class="list-group-item list-group-item-action flex-column align-items-start @if($fecha_item->id == $fecha->id) active @endif">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Clase {{ $clase }}</h5>
                        <small>{{ ((!$fecha_item->vigente())?'Desde '.$fecha_item->fecha('d/m/Y'):'') }}</small>
                    </div>
                    <p class="mb-1"></p>
                    <small></small>
                </a>


            @empty
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">No hay fechas cargadas para esta Cátedra</a>
            @endforelse
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        /*$(document).ready(function() {
            $.ajaxSetup({ cache: true });
            $.getScript('https://connect.facebook.net/en_US/sdk.js', function(){
            FB.init({
                appId: '269339924328771',
                version: 'v2.7' // or v2.1, v2.2, v2.3, ...
            });
            $('#loginbutton,#feedbutton').removeAttr('disabled');
            FB.getLoginStatus(updateStatusCallback);
            });
        });*/
    </script>
@endsection
