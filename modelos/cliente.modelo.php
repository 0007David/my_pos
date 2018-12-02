<?php

require_once "conexion.php";

class ModeloCliente{

	/**
	 * METODO QUE ME MUESTRA UNO O TODOS LOS CLIENTE
	 * 	si el parametro es == null muestra a todos los clientes
	 */

	public static function mostrarClientes($valor){

		$conexion = Conexion::conectar();

		if($valor == null){

			$stmt = $conexion->prepare("CALL mostrarClientes();");

			$stmt->execute();

			return $stmt->fetchAll();

		}else{

			$stmt = $conexion->prepare("CALL mostrar1Cliente(:ci);");

			$stmt->bindParam(":ci", $valor,PDO::PARAM_STR);

			$stmt->execute();

			$respuesta = $stmt->fetch();

			return $respuesta;

		}

		Conexion::desconectar($conexion);
		unset($stmt);
		
	
	}

	/**
	 * METODO QUE INSERTA UN CLIENTE 
	 */

	public static function insertarCliente($datos){

		$conexion = Conexion::conectar();

		$stmt = $conexion->prepare("CALL insert_Cliente(:ci,:nombre,:correo,:telefono,:estado);");

		$estado="0";

		$stmt->bindParam(":ci", $datos["ci"],PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"],PDO::PARAM_STR);
		$stmt->bindParam(":estado", $estado,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return 'error';

		}
			
		Conexion::desconectar($conexion);
		unset($stmt);


	}

	/**
	 * METODO QUE EDITA UN CLIENTE
	 */

	public static function editarCliente($datos){

		$conexion = Conexion::conectar();

		$stmt = $conexion->prepare("CALL insert_Cliente(:ci,:nombre,:correo,:telefono,:estado);");

		$stmt->bindParam(":ci", $datos["ci"],PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"],PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"],PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return 'error';

		}
			
		Conexion::desconectar($conexion);
		unset($stmt);

	}

	/**
	 * METODO QUE ACTUALIZA UN COLUMNA EN PARTICAULAR
	 * 		Es usado para eliminar un cliente
	 *   	Es usado para cambiar el estado de un cliente
	 */

	public static function actualizarUnaColumna($item1, $valor1, $item2, $valor2){
	
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