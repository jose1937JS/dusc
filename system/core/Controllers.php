<?php

class Controllers
{	
	public function __construct()
	{
		if(isset($_GET["ac"])) {
			$action = $_GET["ac"];
			if (method_exists($this, $action)){
				$this->$action();
			}
			else {
				//Throw new error("Acción $action no encontrada en el controlador $_GET[c]");
				$msg = "Acción $action no encontrada en el controlador $_GET[c]";
				View::render("error", compact("msg"));
			}
		}
		else{
			if (method_exists($this, "index")){
				$this->index();
			}
			else {
				$msg = "Método <code>index</code> del controlador $_GET[c] no encontrado.";
				View::render("error", compact("msg"));
			}
		}
	}	
}










































#	function __construct()
#	{
#		$router = new Router();
#		
#		$control = $router->get('controller');
#		$accion = $router->get('method');
#		$param = $router->get('param');
#	
#		$control .= "Controller";
#		
#		if(is_file(CONTROLERS_PATH."$control.php"))
#		{
#			require CONTROLERS_PATH . "$control.php";
#			
#			$controlador = new $control();
#			
#			if(method_exists($controlador, $controlador->$accion($param))) {
#				$controlador->$accion($param);
#			}
#			else {
#				$msg = "La acción solicitada <code>$accion</code> para el controlador <code>".$router->get('controller')."</code> no existe.";
#				View::render("error", compact("msg"));
#			}
#		}
#		else
#		{
#			$msg = "El controlador solicitado <code>".$router->get('controller')."</code> no existe.";
#			View::render("error", compact("msg"));
#		}
#		
#	}
