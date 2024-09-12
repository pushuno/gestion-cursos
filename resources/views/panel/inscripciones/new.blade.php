@extends('layouts.panel')

@section('title',"Inscripciones")

@section('seccion','Inscripciones')


@section('content')
     <div class="row">
        <div class="col-md-6">
            <div class="card" id="catedras">
                <div class="card-header">
                    <h3 class="card-title">Cursos Disponibles</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="list-group">
                        @forelse($catedras as $catedra)
                            <div class="justify-content-between list-group-item list-group-item-action catedras" data-id="{{ $catedra->id }}" id="catedrabox{{ $catedra->id }}" onclick="seleccionar_catedra({{ $catedra->id }})" style="cursor:pointer" >
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="far fa-calendar-check fa-3x"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1" id="catedra{{ $catedra->id }}">{{ ucfirst($catedra->curso->nombre) }}</h5>
                                            <small>Cupo {{ $catedra->inscripciones->count() }} de {{ $catedra->cupo }}
                                                @if($catedra->inscripciones->count()>=$catedra->cupo)
                                                 <i class="fas fa-exclamation-triangle" style="color:red"></i>
                                                @endif
                                            </small>
                                        </div>
                                        <p class="mb-1">{{ $catedra->curso->metodologia->nombre }}
                                            @if($catedra->fecha_fin)
                                                del {{ $catedra->fecha_inicio().' al '.$catedra->fecha_fin() }}
                                            @else
                                                fechas a convenir
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="justify-content-between list-group-item list-group-item-action alert-warning">
                                No hay cátedras disponibles actualmente
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('inscripciones.index') }}" class="btn btn-link"><i class="fas fa-chevron-left" aria-hidden="true"></i> Volver a Cátedras</a>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6" id="cursantes" style="display:none">
            <div class="card sticky-top">
                <div class="card-header">
                    <h3 class="card-title">Cursantes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" >
                    <div class="form-group">
                        <label for="cursante">Cursante</label>
                        <input type="text" class="form-control" id="cursante_search" onkeyup="buscar_cursante()" name="cursante" placeholder="Nombre / Telefono / Email / Documento">
                    </div>
                    <div class="form-group" id="cursantes_resultados">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function seleccionar_catedra(catedra){
            $(".catedras").removeClass("text-success");
            $("#catedrabox"+catedra).addClass("text-success");
            $("#cursante_search").val('');
            $("#cursantes_resultados").html('');
            $("#cursantes").slideDown();
            $("#cursante_search").focus();
        }
    </script>
    <script>
        function buscar_cursante(){
            var string = $("#cursante_search").val();
            var catedra = $(".text-success").attr('data-id');

            $.ajax({
                url: '{{ route('cursantes.search',['']) }}/'+string,
                method: 'GET',
                success: function(data){
                    if(data){
                        var item,html = '<div class="list-group">';
                        var inscripto = false;
                        if(data.length>0){

                            for(var i=0;i<data.length;i++){
                                inscripto = false;
                                item = data[i];
                                var inscripciones = item.inscripciones;

                                if(inscripciones.length>0){
                                    for(var j=0;j<inscripciones.length;j++){
                                        if(inscripciones[j].catedra_id==catedra){
                                            inscripto = true;
                                        }

                                    }
                                }

                                html += '<div class="justify-content-between list-group-item list-group-item-action" ';
                                if(!inscripto){
                                    html += 'onclick="inscribir('+item.id+')"';
                                }
                                html += '><div class="d-flex justify-content-between">\
											    <h5 class="mt-1" id="cursante'+item.id+'">'+item.nombre+' '+item.apellido;
                                                    if(inscripto){  html += ' <small class="text-success"><i class="far fa-check-square"></i> Ya inscripto</small>';}
                                                html += '</h5>\
                                            </div>';
                                if(item.documento){
                                    html += '<p class="mb-1"><b>Doc</b>: '+item.documento+'</p>';
                                }
                                if(item.telefono){
                                    html += '<p class="mb-1"><b>Tel</b>: '+item.telefono+'</p>';
                                }
                                if(item.email){
                                    html += '<p class="mb-1"><b>Email</b>: '+item.email+'</p>';
                                }

                                html += '</div>';
                            }
                        }
                        html += '</div>';
                        $("#cursantes_resultados").html(html);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    var obj = JSON.parse(XMLHttpRequest.responseText);
                    alert('ocurrio un error al intentar buscar cursantes');
                    console.log(obj.errors);
                }
            });
        }
    </script>
    <script>
        function inscribir(cursante){
            var catedra = $(".text-success").attr('data-id');
            if(!catedra){
                alert('Debe seleccionar una catedra');
                exit();
            }
            var catedra_nombre = $("#catedra"+catedra).html();
            var cursante_nombre = $("#cursante"+cursante).html();
            if(confirm('Desea inscribir a '+cursante_nombre+' en la catedra '+catedra_nombre)){
                $.ajax({
                    url: '{{ route('inscripciones.add',['','']) }}/'+catedra+'/'+cursante+'',
                    method: 'POST',
                    data:{
                        '_token': '{{ csrf_token() }}',
                        'catedra': catedra,
                        'cursante': cursante
                    },
                    success: function(data){
                        if(data){
                            alert('Se registro correctamente la inscripcion');
                            location.href="{{ route('inscripciones.index') }}";
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        var obj = JSON.parse(XMLHttpRequest.responseText);
                        alert('Ocurio un error al intentar guardar la inscripcion');
                        console.log(obj.errors);
                    }
                });
            }
        }
    </script>

@endsection
