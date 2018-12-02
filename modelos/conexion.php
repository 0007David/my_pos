<?php


class Conexion{

	static public function conectar(){

		try{

			$link = new PDO("mysql:host=localhost;dbname=my_pos",
			            "root",
			            "");

			$link->exec("set names utf8");

			return $link;

		}catch(PDOException $e){

			print "¡Error!: " . $e->getMessage(). "<br/>";
			die();

		}

	}

	public static function desconectar($conexion){

		$conexion -> close();

		$conexion = null;

	}

}
