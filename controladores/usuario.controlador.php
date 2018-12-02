<?php

class ControladorUsuario{


/*========================================================
=            MOSTAR USUARIOS                             =
========================================================*/
	/**
	 * Metodo que muesta todos los usuario
	 * @param type $valor define si muestra un usuario o todos si es null 
	 * @return type array con todos o un usuario
	 */

	public static function mostrarUsuarios($valor){

		$respuesta = ModeloUsuario::mostrarUsuarios($valor);

		return $respuesta;

	}




}//end of class
