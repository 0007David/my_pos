
/*=========================================================
=            PREVISIALIZAR IMAGEN DEL EMPLEADO            =
=========================================================*/
$("#nuevaFotoEmpleado").change(function() {

	var imagen = this.files[0];

	// console.log("imagen", imagen);


	// validacion del formato de la imagen sea JPG o PNG [type: "image/png", type: "image/jpg",type: "image/jpeg" ]
	// img attr name,size,type
	if(imagen["type"] !="image/png" && imagen["type"] !="image/jpg" && imagen["type"] !="image/jpeg" ){

		$("#nuevaFotoEmpleado").val("");

		swal({
			position: "top-end",
			title: "¡Error al subir la imagen!",
			text: "¡La imagen debe ser en formato JPG, JPEG o PNG!",
			type: "error",
			showConfirmButton: false,
			timer: 3500
		})


	}else if(imagen["size"] > 2000000){

		$("#nuevaFotoEmpleado").val("");

		swal({
			position: "top-end",
			type: "error",
			title: "¡Error al subir la imagen!",
			text: "¡La imagen no debe ser más de 2MB!",
			showConfirmButton: false,
			timer: 3500
		})

	}else{

		var reader = new FileReader(); // objeto que permite leer archivos en buffer

		//metodo de lectura 
		reader.readAsDataURL(imagen);

		//evento cuando ya cargo el archivo (event load)
		reader.onload = function(event){  // == $(reader).on("load", function(event){ });

			//codifica la imagen en Base64 para previsualizar
			var rutaImagen =  event.target.result; 

			$(".previsualizar").attr("src", rutaImagen);

		}
		
	}


});

/*=========================================================
=                    EDITAR EMPLEADO                      =
=========================================================*/
$(".mitable").on("click", ".btnEditarEmpleado", function(){

	var ciEmpleado = $(this).attr('ciEmpleado');

	var dato = new FormData();
	dato.append('ciEmpleado', ciEmpleado);

	$.ajax({
		url: "ajax/empleado.ajax.php",
		method: "POST",
		data: dato,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			console.log("respuesta", respuesta);

			$("#editarCiEmpleado").val(respuesta["ci"]);
			$("#editarCiEmpleado").attr('readonly','true');
			$("#editarNombreEmpleado").val(respuesta["nombre"]);
			$("#editarCorreoEmpleado").val(respuesta["correo"]);
			$("#editarDireccionEmpleado").val(respuesta["direccion"]);
			$("#editarTelefonoEmpleado").val(respuesta["telefono"]);
			$("#fotoActualEditar").val(respuesta["foto"]);

			if(respuesta["foto"] == null ){

				$(".previsualizar").attr('src', "vistas/img/empleados/default/anonymous.png");
			 }
			 else{

				$(".previsualizar").attr('src',respuesta["foto"]);

			}

		}

	})

});

/*=========================================================
= PREVISIALIZAR IMAGEN DEL EMPLEADO CUANDO SE VA EDITAR   =
=========================================================*/
$("#editarFotoEmpleado").change(function() {

	var imagen = this.files[0];

	// validacion del formato de la imagen sea JPG o PNG [type: "image/png", type: "image/jpg",type: "image/jpeg" ]
	// img attr name,size,type
	if(imagen["type"] !="image/png" && imagen["type"] !="image/jpg" && imagen["type"] !="image/jpeg" ){

		$("#editarFotoEmpleado").val("");

		swal({
			position: "top-end",
			title: "¡Error al subir la imagen!",
			text: "¡La imagen debe ser en formato JPG, JPEG o PNG!",
			type: "error",
			showConfirmButton: false,
			timer: 3500
		})


	}else if(imagen["size"] > 2000000){

		$("#editarFotoEmpleado").val("");

		swal({
			position: "top-end",
			type: "error",
			title: "¡Error al subir la imagen!",
			text: "¡La imagen no debe ser más de 2MB!",
			showConfirmButton: false,
			timer: 3500
		})

	}else{

		var reader = new FileReader(); // objeto que permite leer archivos en buffer

		//metodo de lectura 
		reader.readAsDataURL(imagen);

		//evento cuando ya cargo el archivo (event load)
		reader.onload = function(event){  // == $(reader).on("load", function(event){ });

			//codifica la imagen en Base64 para previsualizar
			var rutaImagen =  event.target.result; 

			$(".previsualizar").attr("src", rutaImagen);

		}
		
	}


});

/*======================================================
=            CAMBIAR EL ESTADO DEL EMPLEADO            =
======================================================*/

$(".mitable").on('click', '.btnEstadoEmpleado', function(){

	var idEmpleado = $(this).attr('idEmpleado');
	// console.log("idEmpleado", idEmpleado);
	var estado = $(this).attr('attrEstado');
	// console.log("estado", estado);

	var datos = new FormData();
	datos.append("idEmpleado" , idEmpleado);
	datos.append("estadoEmpleado", estado);

	$.ajax({
		url: "ajax/empleado.ajax.php",
		method: 'post',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		// beforeSend : function(){
		// 	swal('Solicitando..','Se esta precesando','success');
		// },
		success: function(respuesta){
		
		}

	})

	if(estado == 0){

		$(this).removeClass('btn-danger');
		$(this).addClass('btn-success');
		$(this).attr('attrEstado','1');
		$(this).html('Activo');

	}else{

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).attr('attrEstado','0');
		$(this).html('Desactivo');
	}

});

/*======================================================
=                 ELIMINAR EMPLEADO                  =
======================================================*/


$(".mitable").on('click', '.btnEliminarEmpleado', function(){

	swal({
	   title: "¿Estas seguro de Eliminar al cliente?",
	   text: "Esta accion podras revertirlo",
	   type: "warning",
	   showCancelButton: true,
	   confirmButtonColor: "#3085d6",
	   cancelButtonColor: "#d33",
//	   showConfirmButton: true,
	   confirmButtonText: "Si, eliminar!"
	   }).then((result) => {
		 if (result.value) {

			var idEmpleado = $(this).attr('idEmpleado');
			
			window.location = "index.php?ruta=empleado&idEmpleado="+idEmpleado;


					
		}
    })

});

/*========================================
=            VALIDAR EMPLEADO            =
========================================*/

$("#insertarCI").change(function(){

	$(".alert").remove();

	var valorCi = $(this).val();

	 
	var dato = new FormData();

	dato.append("valorCiEmpleado", valorCi);

	$.ajax({
		url: "ajax/empleado.ajax.php",
		method: "post",
		data: dato,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if(respuesta){
				if(respuesta["estado"] != '2' && (respuesta["tipoEmp"] == 1 || respuesta["tipoCli"] ==0) ){
				
					$("#insertarCI").parent().after('<div class="alert alert-warning"><i class="fa fa-warning"></i>  Este Empleado ya existe en el sistema</div>');
		    		$("#insertarCI").val("");
		    	}

			}


		}

	});






});




