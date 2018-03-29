<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>DUSC</title>
	<link rel="stylesheet" href="<?= ASSETS_PATH ?>bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="<?= ASSETS_PATH ?>font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= ASSETS_PATH ?>estilos.css">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="row">
				<div class="navbar-header col-md-4">
					<a href="#" onclick="location.reload(true)" class="navbar-brand" title="De Un Solo Coñazo">DUSC</a>
				</div>
				<div class="col-md-4">
					<p class="navbar-text text-center" id="hora"></p>
				</div>
				<div class="col-md-4">
					<ul class="nav navbar-right">
						<li role="presentation"><a href="?c=HomeController&ac=desconectar" class="btn btn-primary navbar-btn"><i class="fa fa-sign-out"></i> Salir</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	
	<section class="container contenedor">
	
		<?php if(isset($_GET["var"])): ?>
			<div class="alert alert-success" role="alert">
				<p>Se han insertado <b><?php echo $_GET["var"] ?></b> registros.</p>
			</div>
		<?php endif ?>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="text-center">¡De Un Solo Coñazo!</h3><br>
				<ul class="nav nav-pills" role="tablist">
					<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="pill">Inicio</a></li>
					<li role="presentation" class=""><a href="#asd" aria-controls="asd" role="tab" data-toggle="pill">Mes</a></li>
					<li role="presentation" class=""><a href="#dsa" aria-controls="dsa" role="tab" data-toggle="pill">DSA</a></li>
				</ul>	
			</div>
			
			<div class="panel-body">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="home">
						<form action="" method="POST" class="row" >
							<div class="col-md-12">
								<label for="inputFecha">FECHA A TRABAJAR</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="date" id="inputFecha" name="fecha" class="form-control" placeholder="AAAA-MM-DD">
									<span class="input-group-btn">
										<button class="btn btn-primary" type="submit" name="send"><i class="fa fa-search"></i> Buscar</button>
									</span>
								</div>
							</div>
						</form>
						<br><br>
						<div class="row">
							<div class="col-md-2 col-md-offset-1">
								<input type="text" disabled class="form-control" value="<?= $data['A'] ?>">
							</div>
							<div class="col-md-2">
								<label class="a">TURNO A</label>
							</div>
						</div><br>
						<div class="row">
							<div class="col-md-2 col-md-offset-1">
								<input type="text" disabled class="form-control" value="<?= $data['B'] ?>">
							</div>
							<div class="col-md-2">
								<label class="a">TURNO B</label>
							</div>
						</div><br><br>
						<form action="" method="POST">
							<div class="row">
								<div class="col-md-6">
									<label for="inputCant">CANTIDAD DE COMENSALES</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-keyboard-o"></i></span>
										<input type="number" id="inputCant" class="form-control" name="amount" required>
									</div>
								</div>
								<div class="col-md-6">
									<label for="tuen">SELECCIONE EL TURNO</label>
									<select id="tuen" name="turno" class="form-control" required>
										<option>A</option>
										<option>B</option>
									</select>
								</div>
							</div><br><br>
							<div class="row">
								<div class="col-md-3">
									<input class="form-control" type="text" name="fecha" readonly value="<?= $data['fecha'] ?>">
								</div>
								<div class="col-md-2 col-md-offset-7">
									<button class="btn btn-primary" name="sending"><i class="fa fa-flash"></i> DUSC</button>
								</div>
							</div>
						</form>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="asd">
						<form action="" method="POST" class="row" >
							<div class="col-md-12">
								<label for="fechaMes">MES A CONSULTAR</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="month" id="fechaMes" name="mes" class="form-control" placeholder="AAAA-MM">
									<span class="input-group-btn">
										<button class="btn btn-primary" type="submit" name="sendMes"><i class="fa fa-search"></i> Buscar</button>
									</span>
								</div>
							</div>
						</form>
						<br>
						<table class="table table-hover">
							<caption>Noviembre de 2018</caption>
							<thead>
								<th>FECHA</th>
								<th>TURNO A</th>
								<th>TURNO B</th>
								<th>TOTAL</th>
							</thead>
							<tbody>
								<tr>
									<th>2018-05-12</th>
									<td>2988</td>
									<td>1877</td>
									<td>4865</td>
								</tr>
								<tr>
									<th>2018-05-12</th>
									<td>2988</td>
									<td>1877</td>
									<td>4865</td>
								</tr>
							</tbody>
							<tbody>
								<tr>
									<th>2018-05-12</th>
									<td>2988</td>
									<td>1877</td>
									<td>4865</td>
								</tr>
								<tr>
									<th>2018-05-12</th>
									<td>2988</td>
									<td>1877</td>
									<td>4865</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="tab-pane fade" id="dsa">
						dsa
					</div>
				</div>
			</div>
			<div class="panel-footer ">
				<p class="text-center">Esta tecnología es gracias a Gibert Carrera y José López.<br>&copy;  2017 - 2018.</p>
			</div>
		</div>
	</section>
	<script src="<?= ASSETS_PATH ?>jquery-3.2.1.js"></script>
	<script src="<?= ASSETS_PATH ?>bootstrap/bootstrap.min.js"></script>
	<script src="<?= ASSETS_PATH ?>script.js"></script>
</body>
</html>
