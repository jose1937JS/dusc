<html>
<head>
	<title>404</title>
	<link rel="stylesheet" href="<?= ASSETS_PATH ?>bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="<?= ASSETS_PATH ?>bootstrap/mdb.min2.css">
	<link rel="stylesheet" href="<?= ASSETS_PATH ?>font-awesome/css/font-awesome.min.css">
</head>
<body class="rgba-grey-slight">
	<div class="container">
		<div class="jumbotron mt-3">
			<h3 class="pb-3"><span class="fa fa-bug"></span> Ups! algo salió mal.</h3>
			<p class="lead pt-3"><?php echo $data['msg'] ?></p>
		</div>
	</div>
</body>
</html>
