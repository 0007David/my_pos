<?php


class ControladorEmpleado{
	
/*========================================================
=                MOSTRAR EMPLEADOS                       =
========================================================*/	

	/**
	 * Description
	 * @param type $valor 
	 * @return type
	 */

	public static function mostrarEmpleados($valor){

		$respuesta = ModeloEmpleado::mostrarEmpleados($valor);

		return $respuesta;


	}

/*========================================================
=                INSERTAR EMPLEADOS                       =
========================================================*/
	/**
	 * Metodo que permite insertar un empleado 
	 * @return type string verificando que la accion se realizo con exito.
	 */
	public static function insertarEmpleado(){


		if( isset($_POST["nuevoCiEmpleado"])){


			$validoEmail = '/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/';
			if(preg_match('/^[0-9]+$/',$_POST["nuevoCiEmpleado"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoNombreEmpleado"]) &&
			   preg_match($validoEmail,$_POST["nuevoCorreoEmpleado"]) && 
			   preg_match('/^[0-9]+$/',$_POST["nuevoTelefonoEmpleado"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ:. ]+$/',$_POST["nuevoDireccionEmpleado"])){

	
				$ruta="";
			   	if(isset($_FILES["nuevaFotoEmpleado"]["tmp_name"])){

			   		list($ancho, $alto) =  getimagesize($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

			   		$nuevoAncho = 500; $nuevoAlto = 500;

			   		//creamos un direcctorio para guardar la imagen del cliente
			   		$rand = mt_rand(100,999);
			   		$directorio = "vistas/img/empleados/".$_POST["nuevoCiEmpleado"];

			   		mkdir($directorio,0755);

			   		//de acuerdo al tipo de imagen se guarda en php
			   		if($_FILES["nuevaFotoEmpleado"]["type"] == "image/jpeg" || $_FILES["nuevaFotoEmpleado"]["type"] == "image/jpg"){
			   			//guardamos la imagen en el directorio


						$ruta =  "vistas/img/empleados/".$_POST["nuevoCiEmpleado"]."/".$rand.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino,$ruta);			   			

			   		}

			   		if($_FILES["nuevaFotoEmpleado"]["type"] == "image/png" ){
			   			//guardamos la imagen en el directorio


						$ruta =  "vistas/img/empleados/".$_POST["nuevoCiEmpleado"]."/".$rand.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino,$ruta);			   			

			   		}   		

			   	}// fin de validar imagen

			   	$estado = '1'; //desactivo
			   	
				$datos =  array("ciEmpleado"=>$_POST["nuevoCiEmpleado"],
								   "nombreEmpleado"=>$_POST["nuevoNombreEmpleado"],
								   "correoEmpleado"=>$_POST["nuevoCorreoEmpleado"],
								   "direccionEmpleado"=>$_POST["nuevoDireccionEmpleado"],
								   "telefonoEmpleado"=>$_POST["nuevoTelefonoEmpleado"],
								   "fotoEmpleado"=> $ruta,
								   "estadoEmpleado"=>$estado);

				$respuesta = ModeloEmpleado::insertarEmpleado($datos);

				if($respuesta == "ok"){

					echo '<script>
							swal({

								type: "success",
								title: "¡El empleado ha sido guardado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "index.php?ruta=empleado";

								}

							});
					</script>';


				}

			}else{//empleado no puede ir vacío o llevar caracteres 


				echo'<script>

						swal({
							  type: "error",
							  title: "¡El empleado no puede ir vacío o llevar caracteres especiales!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
								if (result.value) {

								window.location = "index.php?ruta=empleado";

								}
							})

				  	</script>';

			}

		}

	}
/*========================================================
=                EDITAR EMPLEADOS                       =
========================================================*/
/**
	 * Metodo que permite editar a un empleado
	 * @return type string verificando que la accion se realizo con exito.
	 */	

	public static function editarEmpleado(){

		if(isset($_POST["editarCiEmpleado"])){
		  	//viene los datos cargados
		  	
		  	$validoEmail = '/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/';

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarNombreEmpleado"]) &&
			   preg_match($validoEmail,$_POST["editarCorreoEmpleado"]) && 
			   preg_match('/^[0-9]+$/',$_POST["editarTelefonoEmpleado"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ:. ]+$/',$_POST["editarDireccionEmpleado"])){

			   	// VALIDAR IMAGEN

				$ruta = $_POST["fotoActual"];
			
			
				if(isset($_FILES["editarFotoEmpleado"]["tmp_name"]) &&
				 !empty($_FILES["editarFotoEmpleado"]["tmp_name"])){


					list($ancho, $alto) =  getimagesize($_FILES["editarFotoEmpleado"]["tmp_name"]);

			   		$nuevoAncho = 500; $nuevoAlto = 500;

			   		//ver si ya tenia imagen anterior
			   		$directorio = "vistas/img/empleados/".$_POST["editarCiEmpleado"];

			   		//vemos si existe otra imagen en la base de datos

			   		if(!empty($_POST["fotoActual"])){  

			   			unlink($_POST["fotoActual"]);

			   		}else{

			  			mkdir($directorio,0755);

			   		}
			   		
			   		//creamos un direcctorio para guardar la imagen del cliente
			   		$rand = mt_rand(100,999);
			   		
			   		//de acuerdo al tipo de imagen se guarda en php
			   		if($_FILES["editarFotoEmpleado"]["type"] == "image/jpeg" || 
			   			$_FILES["editarFotoEmpleado"]["type"] == "image/jpg"){
			   			//guardamos la imagen en el directorio


						$ruta =  "vistas/img/empleados/".$_POST["editarCiEmpleado"]."/".$rand.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFotoEmpleado"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino,$ruta);			   			

			   		}

			   		if($_FILES["editarFotoEmpleado"]["type"] == "image/png" ){
			   			//guardamos la imagen en el directorio


						$ruta =  "vistas/img/empleados/".$_POST["editarCiEmpleado"]."/".$rand.".png";

						$origen = imagecreatefrompng($_FILES["editarFotoEmpleado"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino,$ruta);			   			

			   		}   



			   	}// fin de validar imagen
			   	var_dump($ruta);
			   	//pasamos los parametros al modelo para que los inserte en la base de datos
			   	$estado='0'; //desactivo
			   	$datos = array('editarCi' => $_POST["editarCiEmpleado"],
			   				   'editarNombre' => $_POST["editarNombreEmpleado"],
			   				   'editarCorreo' => $_POST["editarCorreoEmpleado"],
			   				   'editarTelefono' => $_POST["editarTelefonoEmpleado"],
			   				   'editarDireccion' => $_POST["editarDireccionEmpleado"], 
			   				   'editarFoto' => $ruta,
			   				   'editarEstado' => $estado
			   				    );

				$respuesta = ModeloEmpleado::editarEmpleado($datos);

			   	// var_dump($respuesta);

				if($respuesta == 'ok'){

					echo '<script>
							swal({

								type: "success",
								title: "¡El empleado ha sido editado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "index.php?ruta=empleado";

								}

							});
					</script>';



				}
				

			 }else{ //caso que el empleado lleva caracteres especiales

				echo'<script>

						swal({
							  type: "error",
							  title: "¡El empleado no puede ir vacío o llevar caracteres especiales!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
								if (result.value) {

								window.location = "index.php?ruta=empleado";

								}
							})

				  	</script>';

			 }
						  	

		  }//fin if isset($_POST[])


	}

/*=========================================================
=            METODO QUE ACTUALIZA UNA COLUMMNA            =
=========================================================*/
/**
 *Este metodo es usado para cambiar el estado de un empleado de activo a *desactivo y viceversa.
 *Se usa para relizar una eliminacion logica del empleado donde estado = 2  
 * 
 */

	public static function eliminarEmpleado(){

		if(isset($_GET["idEmpleado"])){


			$item1 = "idpersona";

			$valor1 = $_GET["idEmpleado"];

			$item2 = "estado";

			$valor2 = "2";

	   		$respuesta = ModeloEmpleado::actualizarUnaColumna($item1, $valor1, $item2, $valor2);

	   	    if($respuesta == 'ok'){
				echo '<script>
							swal({
								// position: "top-end",
								type: "success",
				                title: "Eliminado",
								text: "El empleado ha sido eliminado",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then((result) =>{
								   if (result.value) {

										window.location = "index.php?ruta=empleado";

									}
							})
				        </script> ';
			
			}


		}
		

	}




}// end of class