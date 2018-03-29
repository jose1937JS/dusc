<?php

spl_autoload_register(function($class){
	if (is_file(CORE . "$class.php")){
		require CORE . "$class.php";
	}
	else {
		if (is_file(MODELS_PATH . "$class.php")){
			require MODELS_PATH . "$class.php";
		}
		else {
			$msg = "No se encontro el archivo/clase <code>$class</code>. ";
			View::render("error", compact("msg"));
		}
		
	}
});
