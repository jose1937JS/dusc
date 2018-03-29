<?php 

class CoreModel extends Conexion
{
	private $sql;

	public function __construct()
	{
		parent::__construct();
	}

	public function Cantidad(string $fecha, string $turno)
	{
		$this->sql="SELECT cedula FROM comensales WHERE fecha = '$fecha' AND turno = '$turno'";            		
		$result = pg_query($this->link, $this->sql) or die(pg_last_error());
		$registros = pg_num_rows($result);
		
		return array('reg' => $registros, 'result' => $result);
	}
	
	public function GetAll(int $limite)
	{
		$this->sql="SELECT cedula FROM estudiantes limit $limite";
		$result = pg_query($this->link, $this->sql) or die(pg_last_error());
		
		return $result;
	}
	
	public function Insertar($cedulas, $fecha, $horas, $turno)
	{
		$this->sql = "INSERT INTO comensales (cedula, fecha, hora, turno, operador) VALUES ('$cedulas','$fecha','$horas','$turno','operador1')";
		$result = pg_query($this->link, $this->sql) or die(pg_last_error());
		
		return $result;
	}
	
	public function Almacenados(string $fecha)
	{
		$this->sql="SELECT cedula FROM comensales WHERE fecha = '$fecha' AND turno = 'A'";            
		$result = pg_query($this->link, $this->sql) or die('La consulta fallo: ' . pg_last_error());	

		$this->sql="SELECT cedula FROM comensales WHERE fecha = '$fecha' AND turno = 'B'";            
		$result2 = pg_query($this->link,$this->sql) or die('La consulta fallo: ' . pg_last_error());		
		$a = pg_num_rows($result);
		$b = pg_num_rows($result2);
		
		return  array($a, $b);
	}
	
}
