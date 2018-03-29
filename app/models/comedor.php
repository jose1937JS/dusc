<?php 

class Conexion 
{
	private $sql;
	private $link;
	
	public function __construct()
	{
		$conn_str = "host=localhost dbname=comedor user=josef password=";
		$this->link = pg_connect($conn_str) or die('failed'.pg_connection_status());
	}
	
	public function HorasAB($turno)
	{
		$horas = [];
	
		if ($turno === 'A'){ $horaInicial = 10; $horaFinal = 14; $vcsPrMin = 13; }
		else { $horaInicial = 16; $horaFinal = 18; $vcsPrMin = 17; }
		
		for ($j=$horaInicial; $j < $horaFinal; $j++) { // 14 es la hora de cierre. probar con j = 10. $j = $h
			for ($i=0; $i <= 59; $i++) { // 59 el ultimo minuto, deveria de ser <=, probar con i = 0. $i = $m
				for ($k=0; $k < $vcsPrMin; $k++){ // 10 es la cantidad de veces q se va a repetir un minuto
					if ($i < 10)  // si el minuto es menor a 10. le agraga un cero a la izquierda
						{$m2 = '0'.$i;}
					else {$m2 = $i;}
					$total = $j.":".$m2.":00";
					array_push($horas, $total);
				}	
			}
		}		
		// en el turno A, con 13 por min, se estarian generando 3120 horas disponibles. para almacenar en la bd, con 12 serian 2880
		// en el B se generarian con 17 por min, 2040 hrs. 	
		return 	$horas; // array de 900 pos, con una hora en particular (la q se paso por parametro) y todos sus minutos.
		// ahora horas es un array de 2000 y pico pos con todas las horas de 10:00 a 13:59 con todos sus minutos, cada min se rep 10 veces
	}

	public function jose($cantidad)
	{
		$array = []; 
		for($i=0; $i < $cantidad; $i++){ // pasarle el numero por parametro para no sobrecargar el equipo. el num puede ser el monto a introducir
			$array[$i] = rand(0, $cantidad);
			for($j=0; $j < $i; $j++){
				if( $array[$i] == $array[$j])
					$i--;
			}
		}
		return $array;
	}
	
	public function registros($amount,$fecha,$turno)
	{		
		$l1= []; 
		$l3= [];
		$l4= [];
		$l2= [];	
		$l5= [];
		$l6= [];
		$contador = 0; 
		#-----------------------------------
		$this->sql="SELECT cedula FROM comensales WHERE fecha = '$fecha' AND turno = '$turno'";            		
		$result = pg_query($this->link,$this->sql) or die(pg_last_error());
		$registros= pg_num_rows($result); // cantidad de comensales en el turno
	
		for ($i=0; $i < $registros; $i++) { 			
			$l2 =pg_fetch_array($result,$i); // 
			array_push($l6, $l2['cedula']);	// l6: array con todos los comensale de ese turno.
		}

		$this->sql="SELECT cedula FROM estudiantes limit 15000"; // opcional! tabla personalizada con los comensales necesarios. (los q van todos los dias) llenar los reportes con personas q si coman alla.
		$result = pg_query($this->link,$this->sql) or die(pg_last_error());
		$registros= pg_num_rows($result);
		
		for ($i=0; $i < $registros; $i++) { 
			$row = pg_fetch_array($result, $i); // buscar una manera de reordenar las cedulas de l1, q son las q genero la consulta de 4200
			array_push($l1, $row['cedula']); // l1 contiene todas las cedulas generadas en la consilta, reordenarlas!!
		}
		shuffle($l1); // funcion q reordena los elementos de array aleatoriamente
		#-----------------------------------	
		// PEQUEÑO DETALLE, EN L5, Q METE TODO LO Q VENGA, SIN IMPORTAR EL MONTO, CONDICIONAR PARA Q META LA CANTIDAD DEL MONTO
	
		foreach($l1 as $key => $valor) // aqui esta preguntando si las cedulas generadas el la consulta no estan dentro del array de comensales, generara un nuevo array con los comensales y las nuevas cedulas
		{
			if($key == $amount){ break; } // de acuerdo con el monto introducido va a ingresar las cedulas disponibles con esa cant.
			else { if(!in_array($valor, $l6)){ array_push($l5, $valor); } }
		} // l5 es el array cn las cedulas nuevas a ingrasar, q no estaban antes, 
	// el numero disparejo de acuerdo a lo q se ingresa sinifica q la direferencia entre esos numeros, son la cantidad de cedulas q ya estan registradas		
		#-----------------------------------------------
		$horas = $this->HorasAB($turno); 
		#-----------------------------------------------
		
		if(count($l5) > 0)
			if ($amount > count($l5)){ $amount = count($l5); } // mostrar un mensajito en este punto, con la cantidad de cedulas a ingresar
		else
			die("No se genero ninguna cedula, intente nuevamente");
		
		$var = $this->jose($amount);
		
		for ($i=0; $i < $amount; $i++) { // amount es la cantidad de comensales a ingresar
			$w = $var[$i]; // w cotiene un numero, q obtiene del array de aleatorios
	
			if (!array_key_exists($w, $l5))
				continue;
	
			$this->sql ="INSERT INTO comensales (cedula,fecha,hora,turno,operador) VALUES ('$l5[$w]','$fecha','$horas[$i]','$turno','operador1')";
			
			$result = pg_query($this->link, $this->sql) or die(pg_last_error());
			
			$contador++;		
		}
		
		if ($contador == $amount) header("location:index.php?var=$contador");
		else header("location:index.php?var=$contador");

	}
	
	public function almacenados($fecha)
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
