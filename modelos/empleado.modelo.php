<?php

require_once "conexion.php";


class ModeloEmpleado{


/*========================================================
=                MOSTRAR EMPLEADOS                       =
========================================================*/
/**
 * Description
 * @param type $valor  determina si hay que mostrar un empleado o todos
 * @return filas retornas todas filas
 */

	public static function mostrarEmpleados($valor){

		if(is_null($valor)){
			//mostrar todo los empleados
			$conexion = Conexion::conectar();

			$stmt = $conexion->prepare("CALL mostrarEmpleados();");

			$stmt->execute() ;

			return $stmt->fetchAll();

			Conexion::desconectar($conexion);
			unset($stmt);
			
		}
		else{
			//mostrar un empleado  CALL `mostrar1Empleado`(@p0);
			$conexion = Conexion::conectar();

			$stmt = $conexion->prepare("CALL mostrar1Empleado(:ci);");

			$stmt->bindParam(":ci", $valor,PDO::PARAM_STR);

			$stmt->execute() ;

			return $stmt->fetch();

			Conexion::desconectar($conexion);
			unset($stmt);
			
			
		}
	}

/*========================================================
=                INSERTAR EMPLEADOS                       =
========================================================*/
/**//**
 * Description
 * @param type $datos todos los datos a insertar
 * @return type string verifica si se realizo con exito la accion
 */

	public static function insertarEmpleado($datos){

		$conexion = Conexion::conectar();

		$stmt = $conexion->prepare("CALL insert_Empleado(:ci,:nombre,:correo,:telefono,:estado,:foto,:direccion);");

		$stmt->bindParam(":ci", $datos["ciEmpleado"],PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombreEmpleado"],PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correoEmpleado"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefonoEmpleado"],PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estadoEmpleado"],PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["fotoEmpleado"],PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccionEmpleado"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return 'error';

		}
			
		Conexion::desconectar($conexion);
		unset($stmt);

	}
/*========================================================
=                EDITAR EMPLEADO EMPLEADOS               =
========================================================*/
/**
 * Description
 * @param type $datos viene todos los datos a editar
 * @return type string verifica si se realizo con exito la accion
 */
	public static function editarEmpleado($datos){

		$conexion = Conexion::conectar();

		$stmt = $conexion->prepare("CALL insert_Empleado(:ci,:nombre,:correo,:telefono,:estado,:foto,:direccion);");

		$stmt->bindParam(":ci", $datos["editarCi"],PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["editarNombre"],PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["editarCorreo"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["editarTelefono"],PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["editarEstado"],PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["editarFoto"],PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["editarDireccion"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return 'error';

		}
			
		Conexion::desconectar($conexion);
		unset($stmt);

	}
/*========================================================
=    ACTUALIZAR UNA COLUMNA DEL LA TABLA  EMPLEADOS      =
========================================================*/
/**
 * /
 * @param  [type] $item1  criterio de busqueda ejemplo (idEmpleado,idpersona,ci)
 * @param  [type] $valor1 valor del criterio de busqueda
 * @param  [type] $item2  columna a modificar ejemplo(estado)
 * @param  [type] $valor2 nuevo valor a reemplazar
 * @return [type] string vefica si la accion se realizo con exito o no.
 */
	public static function actualizarUnaColumna($item1, $valor1, $item2, $valor2){

		// UPDATE `persona` SET `estado` = '1' WHERE `persona`.`idpersona` = 60;
		$conexion = Conexion::conectar();

		$stmt = $conexion->prepare("UPDATE persona SET $item2 = :$item2 WHERE $item1 = :$item1 ;");

		$stmt->bindParam(":".$item2, $valor2,PDO::PARAM_STR);
		$stmt->bindParam(":".$item1, $valor1,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return 'error';

		}
			
		Conexion::desconectar($conexion);
		unset($stmt);

	}



}