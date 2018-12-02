<?php


class ControladorCliente{


/*==========================================================================
=			            MOSTRAR CLIENTES                                  =
==========================================================================*/
	public static function mostrarClientes($valor){

		$respuesta = ModeloCliente::mostrarClientes($valor);

		return $respuesta;
	}

/*==========================================================================
=			            INSERTAR CLIENTE                                   =
==========================================================================*/
	public static function insertarCliente(){

		if(isset($_POST["insertarCi"])){

			$validoEmail = '/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/';
			if(preg_match('/^[0-9]+$/',$_POST["insertarCi"]) &&
		       preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["insertarNombre"]) &&
		   	   preg_match($validoEmail,$_POST["insertarCorreo"]) &&
		   	   preg_match('/^[0-9]+$/',$_POST["insertarTelefono"])){

					$datos = array("ci"=>$_POST["insertarCi"],
									"nombre"=>$_POST["insertarNombre"], 
									"correo" => $_POST["insertarCorreo"],
									 "telefono" => $_POST["insertarTelefono"]);

					$respuesta = ModeloCliente::insertarCliente($datos);
					

					if($respuesta == "ok") {

						echo "<script>

							swal({
								  type: 'success',
								  title: 'El cliente ha sido guardado correctamente',
								  showConfirmButton: true,
								  confirmButtonText: 'Cerrar'
								  }).then((result) =>{

											if (result.value) {

											window.location = 'index.php?ruta=cliente';

											}
										})

							</script>";

				       }

				}else{

					echo'<script>

						swal({
							  type: "error",
							  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
								if (result.value) {

								window.location = "index.php?ruta=cliente";

								}
							})

				  	</script>';

			  }

			

		  }

			

		}
/*==========================================================================
=			            EDITAR CLIENTES                                  =
==========================================================================*/		
		public static function editarCliente(){

		  if(isset($_POST["editarCi"])){

			$validoEmail = '/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/';

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarNombre"]) &&
		   	   preg_match($validoEmail,$_POST["editarCorreo"]) &&
		   	   preg_match('/^[0-9]+$/',$_POST["editarTelefono"])){

		   	   	$estado = '0';
				$datos = array("ci" => $_POST["editarCi"],
					           "nombre" => $_POST["editarNombre"],
					           "correo" => $_POST["editarCorreo"],
					           "telefono" => $_POST["editarTelefono"],
					           "estado" => $estado);

				$respuesta = ModeloCliente::editarCliente($datos);

					if( $respuesta == "ok") {

					echo "<script>
								swal({
									  type: 'success',
									  title: 'El cliente ha sido actualizado correctamente',
									  showConfirmButton: true,
									  confirmButtonText: 'Cerrar'
									  }).then((result) =>{
												if (result.value) {

												window.location = 'index.php?ruta=cliente';

												}
									});

						</script>";

					}

			   }
				else{

					echo '<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puedo ser editado, no debe llevar caracteres especiales o vació!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then((result) => {
							if (result.value) {

							window.location = "index.php?ruta=cliente";

							}
						})

			  	</script>';


				}

		  }

		}
/*==========================================================================
=			            Eliminar CLIENTES                                  =
==========================================================================*/
/**
 *Este metodo hace una eliminacion logica donde cambia el estado de la 
 * persona = 2
 * 		estado=0  : activo
 *   	estado=1  : desactivo
 *    	estado=2  : eliminado 
 */
	public static function eliminarCliente(){

		if(isset($_GET["idCliente"])){

			$item1 = "idpersona";
			
			$valor1= $_GET["idCliente"];

			$item2 = "estado";

			$valor2='2';

		    $respuesta = ModeloCliente::actualizarUnaColumna($item1, $valor1, $item2, $valor2);

			if($respuesta == 'ok'){
				echo '<script>
							swal({
								// position: "top-end",
								type: "success",
				                title: "Eliminado",
								text: "El cliente ha sido eliminado",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then((result) =>{
								   if (result.value) {

										window.location = "index.php?ruta=cliente";

									}
							})
				        </script> ';
			}else{

				echo '<script>
							swal({
								position: "top-end",
								type: "error",
				                title: "errro al elimnar",
								text: "El cliente no ha sido eliminado",
								showConfirmButton: false,
								timer: 1500
							})
				        </script> ';
			}


		}

	}


	
}