<?php

class ComedorController extends Controllers
{
	private $model;
	
	use Login;
	
	public function __construct()
	{
		$this->model = new CoreModel();
		parent::__construct();
	}
	
//=======================================================================================

	static function HorasAB($turno)
	{
		$horas = [];

		if ($turno === 'A'){ $horaInicial = 10; $horaFinal = 14; $vcsPrMin = 13; } // 3120 horas
		else { $horaInicial = 16; $horaFinal = 18; $vcsPrMin = 17; } // 2040 hrs.
	
		for ($j=$horaInicial; $j < $horaFinal; $j++) {
			for ($i=0; $i <= 59; $i++) {
				for ($k=0; $k < $vcsPrMin; $k++){
					if ($i < 10)
						{$m2 = '0'.$i;}
					else {$m2 = $i;}
					$total = $j.":".$m2.":00";
					array_push($horas, $total);
				}	
			}
		}		
		return 	$horas;
	}
	
	static function NumsAlea($cantidad)
	{
		$array = []; 
		for($i=0; $i < $cantidad; $i++){
			$array[$i] = rand(0, $cantidad - 1);
			for($j=0; $j < $i; $j++){
				if( $array[$i] == $array[$j])
					$i--;
			}
		}
		return $array;
	}
	
	static function Registros($amount, $fecha, $turno)
	{
		$cedulas= []; // contiene todas las cedulas generadas en la consilta
		$l2= []; // lo mismo q l6
		$l5= []; // cedulas nuevas a ingresar.
		$l6= []; // l6: array con todos los comensale de ese turno.
		$contador = 0; 
		#-----------------------------------------------------------------------------------------
				
		$registros = $this->model->Cantidad($fecha, $turno); // array con resulset y cantidad de comensales en el turno
		
		for ($i=0; $i < $registros['reg']; $i++) { 			
			$l2 = pg_fetch_array($registros['result'], $i);
			array_push($l6, $l2['cedula']);	
		}

		$result = $this->model->GetData("cedula", "estudiantes", 15000); // cantidad d cedulas para escoger. (campo, tabla, cantidd)
		$cantCed = pg_num_rows($result);
		
		for ($i=0; $i < $cantCed; $i++) { 
			$row = pg_fetch_array($result, $i); // vardumpear esta variable.
			array_push($cedulas, $row['cedula']);
		}
		
		shuffle($cedulas);
				
		foreach($cedulas as $indice => $valor) {
			if($indice == $amount){ break; }
			else { if(!in_array($valor, $l6)){ array_push($l5, $valor); } }
		}
		
		$horas = self::HorasAB($turno); 
		
		if(count($l5) >= 0){ if ($amount > count($l5)){ $amount = count($l5); } } // mostrar un mensajito en este punto, con la cantidad de cedulas a ingre	sar
		else { die("No se genero ninguna cedula, intente nuevamente"); }
		
		$var = self::NumsAlea($amount);	
		
		for ($i=0; $i < $amount; $i++) {
			$w = $var[$i];
	
#			if (!array_key_exists($w, $l5))
#				continue;
	
			$this->model->Insertar($l5[$w], $fecha, $horas[$i], $turno);
			
			$contador++;		
		}
		
		if ($contador == $amount) header("location: http://127.0.0.1:1234/index.php?c=ComedorController&ac=index&dat=josepher&var=$contador");
		//else header("location: http://127.0.0.1:1234/index.php?c=ComedorController&ac=index&dat=josepher&var=$contador");

	}
	
	
	static function ByMes($mes){
		$mesx = explode('-', $mes);
		
		function mf($v, $m){
			for($i = 1; $i <= $v; $i++){
				if($i < 10) { $fechas[] =  $m."-0".$i; }
				else { $fechas[] = $m."-".$i; }
			}
			return $fechas;
		}

		switch($mesx[1]){
			case '01':
			case '03':
			case '05':
			case '07':
			case '08':
			case '10':
			case '12':
				$fechas = mf(31, $mes);
				break;
			case '02':
				$fechas = mf(28, $mes);
				break;
			case '04':
			case '06':
			case '09':
			case '11':
				$fechas = mf(30, $mes);
				break;
			default:
				die("pero q carajos!, mes no valido");
		}
				
		for($i = 0; $i < count($fechas); $i++){
			$arrayA = $this->model->Cantidad($fechas[$i], 'A');
			$arrayB = $this->model->Cantidad($fechas[$i], 'B');
		}
	}

//=======================================================================================
	
	public function index()
	{	
		if(!empty($_GET['dat']) && password_verify("josepher", $_GET['dat']) ){
			Login::inicioSesion($_GET['dat']);
		}
		
		if(isset($_SESSION['usuario'])){
			
			$A = '';
			$B = '';
			$fecha = '';
			
			if(isset($_POST['send'])){
				$fecha = $_POST['fecha'];

				$almacenados = $this->model->Almacenados($fecha);
				$A = $almacenados[0];
				$B = $almacenados[1];
			}
			
			if(isset($_POST['sending'])){
				self::Registros($_POST['amount'], $_POST['fecha'], $_POST['turno'] );
			}
			
			if(isset($_POST['sendMes'])){
				self::ByMes($_POST['mes']);
			}
			
			View::render("index", compact("A", "B", "fecha"));
		}
		else{
			die('No existe la sesion');
		}
	}
	
}



QUE QUIERO SER CUANDO SEA GRANDE?, ES UNA PREGUNTA BASTANTE AMPLIA Y DEPENDERA NO TANTO DE UNO COMO PERSONA SI NO TAMBIEN DE OTROS FACTORES EXTERNOS. (MADURO ES UN PUTO FACTOR EXTERNO), SIENDOTE SINCERO NO TENGO UN OBJETIVO PRINCIPAL PARA ALCANZAR PORQUE LA VIDA DA MUCHAS VUELTAS, PERO SI Q TENGO UN SENTIDO DE HACIA DONDE QUISIERA IR, QUISIERA SER UNA PERSONA EXITOSA NO EN EL SENTIDO DE TENER MUCHO DINERO SINO, EN EL SENTIDO ESPIRITUAL, DE UNA PERSONA SABIA, QUISIERA SER LA LUZ,PARA QUIENES ANDAN EN LA ZONA DE LA IGNORANCIA, SER LA SONRISA PARA KAS PERSONAS QUE ANDEN TRISTES, QUISIERA SER LAS PALABRAS DE ALIENTO PARA QUIENES QUIEREN DARSE POR VENCIDOS, SER LA MANO AMIGA QUE LEVANTA A ALGIEN CAIDO, EN FIN SER MAS HUMANO, MAS AGRADECIDO CON LO Q TENGO Y LUCHAR POR LO Q QUISIERA TENER. EXISTEN MUCHAS MANERA DE LUCHAR PERO DE ALGUNA MANERA LA FORMA Q MAS ME GSTA ES PROGRAMANDO, HACER ESA COSA DIFICIL DE EXPLICAR Q NO CUALQUIERA PUEDE HACER, AUNQUE ESO ES SOLO EL PRIMER PASO, COMO YA TE DIJE ANTES NO QUISIERA PROGRAMAR POR EL RESTO DE MI VIDA, AUNQUE SI PENSAR COMO UN PROGRAMADOR. PROGRAMAR ES SOLO UN PASO QUE HE DE DAR PRA LLEGAR A SER "ESA" COSA Q NO SE (PORQUE LA VIDA DA MUCHAS VUELTAS), A LO MEJOR LLEGUE A SER UN EMPRESARIO EXITOSO DUEÑO DE UNA EMPRESA IMPORTANTE O TRABAJAR PARA ALGUIEN MAS GANANDO SUELDO MINIMO, ESA ASPIRACION ES UNA VARIABLE PERO ME ESFORAZARE EN QUE LLEGUE A SER LO MAS CERCANO POSIBLE A LA PRIMERA CON PNL. SERA UN TRAYECTO BASTANTE DURO Y COMPLICADO, ES CASI UN HECHO QUE PUEDA QUERER RENUNCIAR, PERO AHI ES DONDE ENTRAS TU, JULIO, PADRINO, Y DEMAS PERSONAS Q LES IMPORTO PARA AUDARNOS A SALIR ADELANTE Y DEJAR DE SER UNOS HUMANOS MEDIOCRES, SIMPLES COMUNES Y SILVESTRES.
