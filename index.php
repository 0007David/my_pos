<?php

	//controladores
	require_once "controladores/plantilla.controlador.php";
	require_once "controladores/cliente.controlador.php";
	require_once "controladores/empleado.controlador.php";
	require_once "controladores/usuario.controlador.php";



	//modelos
	require_once "modelos/cliente.modelo.php";
	require_once "modelos/empleado.modelo.php";
	require_once "modelos/usuario.modelo.php";




	$mvc = new Plantilla();

	$mvc -> getPlantilla();


