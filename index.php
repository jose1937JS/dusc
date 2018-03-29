<?php

// front - controller

require("system/core/config.php");
require(CORE. "autoload.php");

$default_controller = "HomeController";

if (isset($_GET["c"]))
{
	$default_controller = $_GET['c'];
	if(file_exists(CONTROLLERS_PATH.$default_controller.".php")){
		require(CONTROLLERS_PATH.$default_controller.".php");
	}
	else {
		Throw new Error("NO existe el archivo " .$default_controller.".php");
	}
}
else
{
	if(file_exists(CONTROLLERS_PATH.$default_controller.".php")){
		require(CONTROLLERS_PATH.$default_controller.".php");
	}
	else {
		Throw new Error("NO existe el archivo " .$default_controller.".php");
	}
}

new $default_controller();

// $router = new Router();

// $controlador = $router->get('controller');
// $accion = $router->get('method');
// $param = $router->get('param');

// $controlador = new $controlador();
// $controlador->$accion($param);

#$default_controller = "IndexController";

#if(isset($_GET["controller"]))
#{
#	$default_controller = $_GET["controller"];
#	if(file_exists("app/controllers/$default_controller.php")){
#		require("app/controllers/$default_controller.php");
#	}
#	else {
#		$msg = "Controlador <code>$_GET[controller]</code> no encontrado.";
#		View::render("error", compact("msg"));
#	}
#}
#else
#{
#	if(file_exists("app/controllers/$default_controller.php"))
#	{
#		require("app/controllers/$default_controller.php");
#	}
#	else
#	{
#		$msg = "Controlador <code>$_GET[controller]</code> no encontrado.";
#		View::render("error", compact("msg"));
#	}
#}

#new $default_controller();
