<?php

require_once "../controladores/cliente.controlador.php";
require_once "../modelos/cliente.modelo.php";

class AjaxCliente{

	public $idCliente;

	public $ci;

	public $estado;


	/*===============================================
	=            EDITAR CLIENTE             =
	===============================================*/
	
	public function editarCliente(){

		$ciCliente = $this->ci;

		$respuesta = ControladorCliente::mostrarClientes($ciCliente);

		echo json_encode($respuesta);

	}

	/*===============================================
	=            CAMBIAR ESTADO CLIENTE             =
	===============================================*/

	
	public function  cambiarEstado(){

		$item1 = "idpersona";

		$valor1 = $this->idCliente;

		$item2 = "estado";

		$valor2 = $this->estado;


		$respuesta = ModeloCliente::actualizarUnaColumna($item1, $valor1, $item2, $valor2);


	}

	/*===============================================
	=        VALIDAR CI  REPETIDOS CLIENTE          =
	===============================================*/

	public function validarCi(){

		$valor= $this->ci;

		$respuesta = ControladorCliente::mostrarClientes($valor);

		echo json_encode($respuesta);

	}

	
}

	/*===============================================
	=            DECLARACION DE OBJETOS             =
	===============================================*/

	//EDITAR CLIENTE
	
	if(isset($_POST["ciCliente"])){

	    $obj = new AjaxCliente();
		$obj->ci = $_POST["ciCliente"];
		$obj->editarCliente();

	}

	//CAMBIAR ESTADO DE CLIENTE

	if(isset($_POST["idEstadoCliente"])){

	    $obj = new AjaxCliente();
		$obj->idCliente = $_POST["idEstadoCliente"];
		$obj->estado = $_POST["estado"];
		$obj->cambiarEstado();

	}

	//CAMBIAR ESTADO DE CLIENTE

	if(isset($_POST["validarCi"])){

	    $obj = new AjaxCliente();
		$obj->ci = $_POST["validarCi"];
		$obj->validarCi();

	}