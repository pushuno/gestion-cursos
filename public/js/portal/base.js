
	function mostrar(elemento){
		$(elemento).slideDown("slow");
	}

	function ocultar(elemento){
		$(elemento).css("display","none");
	}

	function registrar(){
		ocultar("#login_error_data");

		$("#btn-registro-confirmar").html('<i class="fas fa-circle-notch fa-spin"></i> Procesando');
		$("#btn-registro-confirmar").attr("type","");


		$.ajax({
			url: 'http://salud.das.gob.ar//engine/public_core.php',
			type: 'POST',
			data: $("#form_registro").serialize(),
			success: function(data){
				if(data){
					var obj = JSON.parse(data);
					if(obj.estado){
						$("#registro").modal('hide');
						$("#login").modal('show');

						$("#login_center").html("Se registr&oacute; correctamente, ya puede iniciar.");
						mostrar("#login_center");
						setTimeout(function() {
							ocultar("#login_center");
						}, 2000);
					}else{
						$("#register_error").html(obj.error);
					}
					$("#btn-registro-confirmar").html('Confirmar');
					$("#btn-registro-confirmar").attr("type","submit");
				}
			}
		});
		return false;
	}

	function loading(elemento){
		$(elemento).html('<img src="http://salud.das.gob.ar/images/loading.gif" style="width:10%;min-width:80px" class="mx-auto d-block mt-3" />'); //loading centrado class="mx-auto d-block"
	}

	function validar_afiliado(){
		var afiliado = $("#afiliado").val();
		var afiliado_barra = $("#afiliado_barra").val();
		var dni = $("#dni").val();
		if(afiliado&&afiliado_barra&&dni){
			$.ajax({
				url: 'http://salud.das.gob.ar//engine/public_core.php',
				type: 'POST',
				data: {
					"tipo":"registro",
					"action":"validate",
					"afiliado":afiliado,
					"barra":afiliado_barra,
					"dni":dni
				},
				success: function(data){
					if(data){
						var obj = JSON.parse(data);
						if(obj.estado){
							$("#nombre").html(obj.nombre+' '+obj.apellido);
							mostrar("#nombre_data");
						}else{
							if(obj.error){
								$("#register_error").html(obj.error);
								ocultar("#btn-registro-confirmar");
							}else{
								mostrar("#btn-registro-confirmar");
							}
						}
					}

				}
			});
		}
	}

	function recuperar_clave(){

		var afiliado = $("#forget_afiliado").val();
		var barra = $("#forget_afiliado_barra").val();

		$("#btn-forget").html('<i class="fas fa-circle-notch fa-spin"></i> Aguarde');
		$("#btn-forget").attr("type","");

		$.ajax({
			url: 'http://salud.das.gob.ar//engine/public_core.php',
			type: 'POST',
			data: {
				"tipo":"registro",
				"action":"recuperar",
				"afiliado":afiliado,
				"barra":barra
			},
			success: function(data){
				mostrar("#btn-forget");
				if(data){
					var obj = JSON.parse(data);
					if(obj.estado){
						$("#recupero_data").html("");
						$("#recupero_data").html("Enviamos un mail a tu casilla de correo con instrucciones para recuperar tu clave.<br /> Verific&aacute; en Correo no deseado en caso de no encontrar el mail.");
						$("#btn-forget").html('Entendido');
						$("#btn-forget").attr("data-dismiss","modal");
					}else{
						$("#recupero_head").html(obj.error);
						$("#btn-forget").html('Confirmar');
						$("#btn-forget").attr("type","submit");
					}

				}else{
					$("#recupero_data").html("Ocurrió un inconveniente al intentar enviar el recupero de clave, reintente luego");
				}
			}
		});
		return false;
	}

	function login(){
		ocultar("#btn-forget");

		var afiliado = $("#afi_numero").val();
		var barra = $("#afi_barra").val();
		var pass = $("#pass").val();

		$("#btn-login-confirmar").html('<i class="fas fa-circle-notch fa-spin"></i> Ingresando');
		$("#btn-login-confirmar").attr("type","");

		$.ajax({
			url: 'http://salud.das.gob.ar/engine/public_core.php',
			type: 'POST',
			data: {
				"tipo":"registro",
				"action":"login",
				"afiliado":afiliado,
				"barra":barra,
				"pass":pass
			},
			success: function(data){
				if(data){
					var obj = JSON.parse(data);
					if(obj.estado){
						ocultar("#login_error_data");
						$("#form_data").hide();
						$("#login_center").show();
						$("#login_center").html('<h3>Bienvenido '+obj.nombre+'</h3>');
						$("#btn-login-confirmar").slideUp("slow");

						setTimeout(function() {
							$('#login').modal('hide');
							var destino = $("#destino").val();
							if(destino){
								$(location).attr('href',"http://salud.das.gob.ar/"+destino);
							}else{
								$("#box-account").html('<a href="javascript:" onclick="ver_cuenta()" alt="Editar Datos de Contacto" title="Editar Datos de Contacto" class="c-dark"><i class="fas fa-user-circle"></i> '+obj.nombre+' '+obj.apellido+'</a> <a href="javascript:" onclick="cerrar_sesion()" class="btn btn-lg btn-secondary c-bg-teal3"><i class="fas fa-sign-out-alt"></i> Salir</a>');
								$("#link_turnos").attr("href","turnos.php");
								$("#link_turnos").removeAttr("onclick");
							}
						}, 2000);

					}else{
						$("#login_error_data").html(obj.error);
						mostrar("#login_error_data");
					}
					$("#btn-login-confirmar").html('Confirmar');
					$("#btn-login-confirmar").attr("type","submit");
				}

			}
		});

		return false;
	}

	function cerrar_sesion(){
		ocultar("#btn-forget");

		$.ajax({
			url: 'http://salud.das.gob.ar//engine/public_core.php',
			type: 'POST',
			data: {
				"tipo":"registro",
				"action":"logout"
			},
			success: function(data){
				if(data){
					var obj = JSON.parse(data);
					if(obj.estado){
						$(location).attr('href',"."); //redirecciono
					}
				}

			}
		});
	}

	function register_open(){
		$("#form_registro")[0].reset();
		//$("#btn-register").attr("data-toggle","modal");
		$("#registro").modal('show');
	}

	function login_open(destino = ''){
		$("#form-forget").attr("onsubmit","return recuperar_clave()");
		$("#form_login")[0].reset();
		$("#form_data").show();
		$("#login_center").hide();
		$("#btn-login-confirmar").show();
		$("#destino").val(destino);

		$("#login").modal('show');
	}

//foco en modales
$(".modal").on('shown.bs.modal', function () {
    $(this).find("input:visible:first").focus();
});

	$("#afi_numero").validate({
	  rules: {
		amount: {
		  required: true,
		  digits: true
		}
	  }
	});

	function popup(titulo,contenido,tiempo = 2000,destino){
		$("#modal_title").html(titulo);
		$("#modal_data").html(contenido);
		$("#modal").modal("show");

		if(tiempo>0){
			setTimeout(function() {
				$('#modal').modal('hide');
				if(destino){
					$(location).attr('href',destino);
				}
			}, tiempo);
		}
	}

	function ver_cuenta(){
		$.ajax({
			url: 'http://salud.das.gob.ar//engine/public_core.php',
			type: 'POST',
			data: {
				"tipo":"registro",
				"action":"get_user_data"
			},
			success: function(data){

				if(data){
					var obj = JSON.parse(data);
					popup('Datos de Contacto','<form method="post" class="" id="form_userdata" onsubmit="return save_userdata()"> \
							<p class="fs12">Utilizaremos estos datos unicamente para confirmar sus turnos.</p>\
							<p class="fs20 fw300 c-dark3 psh-none" id="user_error_data" style="color:red"></p>\
							<div class="row">\
								<label class="col-6">Tel&eacute;fono</label>\
								<input type="text" class="form-control col-6" id="telefono" required autocomplete="off" value="'+obj.telefono+'">\
							</div>\
							<div class="row">\
								<label class="col-6">Email</label>\
								<input type="email" class="form-control col-6" id="email" required autocomplete="off" value="'+obj.email+'">\
							</div>\
						<div class="modal-footer text-center" id="btn-modal-box">\
							<button type="submit" id="btn-userdata-guardar" class="btn btn-secondary text-uppercase c-bg-teal2 mx-auto"><i class="far fa-save"></i> Guardar</button>\
							<p id="btn-userdata-guardado" class="btn btn-md mx-auto btn-info psh-none"><i class="far fa-check-circle"></i> Guardado Correcto</p>\
						</div>\
					</form>',0);

					$("#btn-userdata-guardar").show();
					$("#btn-userdata-guardado").hide();

				}

			}
		});
	}

	function save_userdata(){
		var telefono = $("#telefono").val();
		var email = $("#email").val();

		$("#btn-userdata-guardar").html('<i class="fas fa-circle-notch fa-spin"></i> Guardando');
		$("#btn-userdata-guardar").attr("type","");

		$.ajax({
			url: 'http://salud.das.gob.ar//engine/public_core.php',
			type: 'POST',
			data: {
				"tipo":"registro",
				"action":"set_user_data",
				"telefono":telefono,
				"email":email
			},
			success: function(data){
				if(data){
					ocultar("#user_error_data");
					$("#btn-userdata-guardar").hide();
					$("#btn-userdata-guardado").slideDown("slow");
					setTimeout(function() {$('#modal').modal('hide');}, 2000);
				}else{
					$("#user_error_data").html("No se modificaron los datos");
					mostrar("#user_error_data");
				}
				$("#btn-userdata-guardar").html('<i class="far fa-save" aria-hidden="true"></i> Guardar');
				$("#btn-userdata-guardar").attr("type","submit");
			}
		});
		return false;
	}
