/*=============================================
=            Activando plugins datables           =
=============================================*/

	$(".mitable").DataTable({

		"language": {
			"decimal": "",
			"emptyTable": "La tabla esta vacía",
			"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
			"infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
			"infoFiltered": "(Filtrado de _MAX_ Entradas)",
			"infoPostFix": "",
			"thousands": ",",
			"lengthMenu": "Mostrar _MENU_ Entradas",
			"loadingRecords": "Cargando...",
			"processing": "Procesando...",
			"search": "Buscar:",
			"zeroRecords": "Sin resultados encontrados",
			"paginate": {
				"first": "Primero",
				"last": "Último",
				"next": "Siguiente",
				"previous": "Anterior"
			},
			"aria": {
				"sortAscending": ": active para ordenar la columna ascendente",
				"sortDescending": ": active para ordenar la columna descendente"
			}

		}

	});

/*==============================================================
=            Proceso para EDITAR CLIENTE           =
==============================================================*/
// $(document).ready(function(){

   $(".mitable").on('click','.btnEditarCliente',function(){

		var ciCliente = $(this).attr('ciCliente');
		var datos = new FormData();
    	datos.append("ciCliente", ciCliente);

		$.ajax({
			url: "ajax/cliente.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
      		contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta){

				$("#editarCi").val(respuesta["ci"]);
				$("#editarCi").attr('readonly',true);
				$("#editarNombre").val(respuesta["nombre"]);
				$("#editarCorreo").val(respuesta["correo"]);
				$("#editarTelefono").val(respuesta["telefono"]);

			}
		})       

   });
// });


/*==============================================================
=            Proceso para ELIMINAR CLIENTE           =
==============================================================*/
// $(document).ready(function(){
$(".mitable").on('click','.btnEliminarCliente',function(){

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

			var idCliente = $(this).attr('idCliente');
			
			window.location = "index.php?ruta=cliente&idCliente="+idCliente;

					
		}
    })

   });

// });

/*==============================================================
=            CAMBIAR EL ESTADO DE UN CLIENTE                  =
==============================================================*/

$(".mitable").on('click','.btnEstado', function(){

	var idEstado = $(this).attr('estado');
	var idCliente = $(this).attr('idEstadoCliente');
	
	var datos = new FormData();
	datos.append('idEstadoCliente', idCliente);
	datos.append('estado', idEstado);


	$.ajax({

		url: "ajax/cliente.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
      	contentType: false,
		processData: false,
		success: function(respuesta){
			
		}

	})

	if(idEstado == 0){

		$(this).removeClass('btn-warning');
		$(this).addClass('btn-success');
		$(this).html('Activo');
		$(this).attr('estado', '1');


	} else {//estado == 1
	    
    	$(this).removeClass('btn-success');
		$(this).addClass('btn-warning');
		$(this).html('Desactivo');
		$(this).attr('estado', '0');

	}

});

/*==============================================================
=            Validar CLIENTE NO REPETIDOS           			=
==============================================================*/

$('#insertarCi').change(function(){

	$(".alert").remove();

	var validarCi = $(this).val();

	var dato = new FormData();

	dato.append('validarCi',validarCi );

	$.ajax({
		url: "ajax/cliente.ajax.php",
		method: "POST",
		data: dato,
		cache: false, //almacenar en cache la page solicitada
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			if( respuesta ){
				
				if(respuesta["estado"] != '2' &&  respuesta["tipoCli"] == 0){
				
					$("#insertarCi").after('<div style="margin:0;" class="col-sm-12 alert alert-warning"><i class="fa fa-warning"></i>  Este Cliente ya existe en el sistema</div>');
		    		$("#insertarCi").val("");
		    	}
		    	

			}

		}


	})


})




