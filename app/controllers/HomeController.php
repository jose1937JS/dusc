<?php

class HomeController extends Controllers
{
	use Login;
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(isset($_POST['user']) && isset($_POST['pass'])){
			Login::validarDatos($_POST['user'], $_POST['pass']);
		}
		
		View::render("login");
	}
	
	public function desconectar()
	{
		Login::desconectar();
	}
}
