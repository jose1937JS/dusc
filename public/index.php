<?php

include '../app/models/comedor.php';

$objeto = new Conexion();
$fecha ="";
$var0 ="";
$var1 ="";

if(isset($_POST['send']))
{
	$fecha = $_POST['fecha'];
	$obj = $objeto->almacenados($fecha);
	$var0 = $obj[0];
	$var1 = $obj[1];
}
if(isset($_POST['sending']))
{
	$amount =$_POST['amount'];
	$turno = $_POST['turno'];
	$fechas = $_POST['fechas'];
	$objeto->registros($amount,$fechas,$turno);
}

?>
<style type="text/css">
	.container {
		width: 70% !important;
	}
</style>
<link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
<body>
	

<div class="container">
	<?php 
	if (isset($_GET['var'])) {
		echo "<div class='alert alert-success'>";
		echo "Se Han Insertado ".$_GET['var']." Registros";
		echo "</div>";
	}
	?>
	<form method="POST" action="">
		<div class="form-group row">
			<label for="example-datetime-local-input" class="col-md-2 col-form-label">FECHA DE REGISTRO</label>
			<div class="col-md-10">
				<input class="form-control" name="fecha" type="date" id="example-datetime-local-input" required>        
				<input type="submit" name="send" value="search">
			</div>
		</div>
	</form>
	<div class="form-group row">
		<label for="example-text-input" class="col-sm-2 col-form-label">Registros Del Turno A</label>
		<div class="col-xs-4">
			<input class="form-control" type="text" value="<?php echo $var0;?>" id="example-text-input">
		</div>    
	</div>
	<div class="form-group row">
		<label for="example-text-input2" class="col-sm-2 col-form-label">Registros Del Turno D</label>
		<div class="col-xs-4">
			<input class="form-control" type="text" value="<?php echo $var1;?>" id="example-text-input2">
		</div>
	</div>
	<form method="POST" action="">
		<div class="form-group row">
			<label for="example-number-input" class="col-md-2 col-form-label">Ingrese El Numero De Comensales</label>
			<div class="col-md-10">
				<input class="form-control" type="number" name ="amount" id="example-number-input">
			</div>
		</div>
		<!--<div class="form-group row">
			<label for="example-number-input2" class="col-md-2 col-form-label">Ingrese El Operador</label>
			<div class="col-md-10">
				<select class="form-control" name="operador" id="example-number-input2">
					<option value="Operador1">Operador1</option>
					<option value="Operador2">Operador2</option>
				</select>
			</div>
		</div>-->
		<div class="form-group row">
			<label for="example-number-input" class="col-md-2 col-form-label">Ingrese El Turno</label>
			<div class="col-md-10">
				<select class="form-control" name="turno" id="example-number-input2">
					<option value="A">A</option>
					<option value="B">B</option>
				</select>
			</div>
		</div>
		<input type="disabled" name="fechas" value="<?php echo $fecha; ?>">
		<input type="submit" class="btn btn-primary" name="sending" value="sending">
	</form>
</div>
</body>
