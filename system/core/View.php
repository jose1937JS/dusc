<?php
/*mmap() failed: [12] Cannot allocate memory
			[Mon Mar 12 22:24:02 2018] PHP Fatal error:  Out of memory (allocated 3013607424) (tried to allocate 471040 bytes) in /var/www/html/DeUnSoloConiazo/app/core/Views.php on line 5
			[Mon Mar 12 22:24:05 2018] 127.0.0.1:50254 [200]: / - Out of memory (allocated 3013607424) (tried to allocate 471040 bytes) in /var/www/html/DeUnSoloConiazo/app/core/Views.php on line 5*/

			//new Views("La vista <code>$view</code> no fue encontrada");



class View
{
	public function __construct()
	{
		// for something
	}
	
	public static function render($view, $data = null)
	{
		if(file_exists(VIEWS_PATH."$view.php")) {
			require(VIEWS_PATH."$view.php");
			die();
		}
		else {
			$data['msg'] = "La vista <code>$view</code> no pudo ser encontrada en: <code>" . __FILE__ ."(".__LINE__.")</code> <-- err";
			require(VIEWS_PATH."error.php");
			die();
		}
	}
	
	public static function redirectToController($c="HomeController", $a="index", $dat = null)
	{	
		$datEnc = password_hash($dat, PASSWORD_BCRYPT);
		header("Location: ?c=$c&ac=$a&dat=$datEnc");		
	}

}
