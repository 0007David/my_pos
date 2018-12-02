<?php

require_once("conexion.php");

class ModeloUsuario{


/*========================================================
=            MOSTAR USUARIOS                             =
========================================================*/
	/**
	 * Metodo que muesta todos los usuario
	 * @param type $valor define si muestra un usuario o todos si es null 
	 * @return type array con todos o un usuario
	 */
	public static function mostrarUsuarios($valor){

		if(is_null($valor)){
			//mostrar todos los usuarios
			
			$conexion = Conexion::conectar();

			$stmt = $conexion->prepare("CALL mostrar_Usuarios();");

			$stmt->execute();

			return $stmt->fetchAll();

			Conexion::desconectar($conexion);
			unset($stmt);

		}else{
			//mostrar un usuario 
			$conexion = Conexion::conectar();

			$stmt = $conexion->prepare("CALL mostrar_Usuarios();");

			$stmt->execute();

			return $stmt->fetchAll();

			Conexion::desconectar($conexion);
			unset($stmt);
		}
	}
}