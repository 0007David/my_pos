<?php

require_once("../controladores/empleado.controlador.php");
require_once("../modelos/empleado.modelo.php");

class AjaxEmpleado{

	/**
	 * @var int identificador del empleado
	 */
	public $idEmpleado;

	/**
	 * @var string cedula de identidad del empleado
	 */
	public $ciEmpleado; 

	/**
	 * @var enum(0,1,2) estado del empleado (activo, desactivo, eliminado )respectivamente
	 */
	public $estadoEmpleado;



/*===================================================
=                AJAX EDITAR EMPLEADO               =
===================================================*/
	/**
	 * Metodo que permite obtener los datos del empleado a editar.
	 * Usado para visualizar los datos que va editar
	 * @return type json retorna los datos del empleado.
	 */
	public function editarEmpleado(){

		$valor = $this->ciEmpleado;

		$respuesta = ControladorEmpleado::mostrarEmpleados($valor);

		echo json_encode($respuesta);


	}

/*===================================================
=         AJAX CAMBIAR ESTADO EMPLEADO               =
===================================================*/

	/**
	 * Metodo usado para actualizar la columna estado en la tabla empleado
	 * @return type 
	 */
	public function cambiarEstadoEmpleado(){

		$item1 = "idpersona";

		$valor1 = $this->idEmpleado;

		$item2 = "estado";

		$valor2 = $this->estadoEmpleado;

		$resp = ModeloEmpleado::actualizarUnaColumna($item1, $valor1, $item2, $valor2);

	
	}

/*===================================================
=         AJAX VALIDA SI EXISTE EMPLEADO            =
===================================================*/
	/**
	 * Devuelve el empleado para validar si ya existe en la BD
	 * @return type
	 */
	public function validarCiEmpleado(){

		$valor = $this->ciEmpleado;

		$respuesta = ControladorEmpleado::mostrarEmpleados($valor);

		echo json_encode($respuesta);

	}


}//FIN  DE LA CLASE




/*===================================================
=             DECLARACION DE OBJETOS                =
===================================================*/

// EJECUTANDO LA ACCION EditarEmpleado

if(isset($_POST["ciEmpleado"])){

	$obj = new AjaxEmpleado();

	$obj->ciEmpleado = $_POST["ciEmpleado"];

	$obj->editarEmpleado();

	unset($obj);

}

// EJECUTANDO LA ACCION CambiarEstado
if(isset($_POST["idEmpleado"])){

	$obj = new AjaxEmpleado();

	$obj->idEmpleado = $_POST["idEmpleado"];
	$obj->estadoEmpleado = $_POST["estadoEmpleado"];

	$obj->cambiarEstadoEmpleado();

	unset($obj);

}

// EJECUTANDO LA ACCION DE VALIDAR UN EMPLEADO AL INSERTARLO
if(isset($_POST["valorCiEmpleado"])){

	$obj=new AjaxEmpleado();

	$obj ->ciEmpleado=$_POST["valorCiEmpleado"];

	$obj->validarCiEmpleado();

	unset($obj);

}






