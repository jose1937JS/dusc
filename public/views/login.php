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
	<div class="panel panel-primary login">
		<div class="panel-heading">
			<h4 class="text-center">INICIO DE SESIÓN</h4>
		</div>
		<p class="bg-danger text-center error">
			<?php !empty($data['error']) ? print($data['error']) : '' ?>
		</p>
		<div class="panel-body">
			<form action="" method="post">
				<div class="form-group">
					<label for="user">Usuario</label>
					<div class="input-group">
						<label class="input-group-addon"><i class="fa fa-user"></i></label>
						<input type="text" class="form-control" name="user" id="user">
					</div>
					<br>
					<label for="clave">Contraseña</label>
					<div class="input-group">
						<label class="input-group-addon"><i class="fa fa-lock"></i></label>
						<input type="password" class="form-control" name="pass" id="clave">
					</div>
				</div>
				<div class="b">
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in"></i> Entrar</button>
				</div>
			</form>
		</body>
	</div>
</body>
</html>
