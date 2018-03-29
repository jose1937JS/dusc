<?php

class Conexion
{
	public $db = null;
	public $link;
	
	private $opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
	
	function __construct()
	{
	
		$conn_str = "host=localhost dbname=comedor user=josef password=";
		$this->link = pg_connect($conn_str) or die('failed'.pg_connection_status());
	
#		try {
#			$this->db = new pdo("pgsql:host=".HOST.";dbname=".DBNAME, USER, DBPASS, $this->opt);
#		}
#		catch(PDOException $e){
#			$msg = "No se pudo conectar a la Base de Datos: $e->getMessage()";
#			View::render("error", compact("msg")) ;
#		}
	}
	
	public function getData($campo, $tabla, $limite = 1)
	{
		$sql = "select $campo from $tabla limit $limite";
		//$result = $this->db->query($sql);
		//return $result->fetchAll();
	
		$result = pg_query($this->link, $sql) or die(pg_last_error());
		
		return $result;
	}

}
