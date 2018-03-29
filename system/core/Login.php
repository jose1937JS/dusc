<?php

trait Login
{
	public function validarDatos($user, $pass)
	{
		$conex = new Conexion();
		$result = $conex->getData("*", "dusc");
		$d = pg_fetch_array($result);
		
		if($user == $d['usuario'] && $pass == $d['clave']){
			$_POST['usuario'] = $d['usuario'];
			View::redirectToController("ComedorController", "index", $_POST['usuario']);
		}
		else {
			$error = "<i class='fa fa-info'></i> Usuario o contraseña incorrectos.";
			View::render("login", compact("error"));
		}
	}
	
	public function inicioSesion($usuario)
	{
		session_start();
		return $_SESSION['usuario'] = $usuario;
	}
	
	public function desconectar()
	{
		session_start();
		unset($_SESSION['usuario']);
		View::redirectToController();
	}
}
