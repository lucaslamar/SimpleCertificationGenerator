<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Gerador de Certificado</title>
		<link rel="shortcut icon" href="favicon.ico">
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js" integrity="sha384-u/bQvRA/1bobcXlcEYpsEdFVK/vJs3+T+nXLsBYJthmdBuavHvAW6UsmqO2Gd/F9" crossorigin="anonymous"></script>
		<style>
		body {
            background: grey;
		}
		.center {
            margin: auto;
            width: 50%;
            padding: 70px;
}
	</style>
	</head>
	<body>

		<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  			<a class="navbar-brand" href="#">Gerador Online</a>
  			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
  			</button>
		</nav>

		<div class="card bg-dark text-black">
  <img class="card-img" src="http://in-spaces.com/images/detailed/23/CROP_WOODEN_PLANKS-_WHITE_1024x1024.jpg?t=1468185097" alt="Card image cap">
  <div class="card-img-overlay">
			


	<div class="center">
		<div class="card border-dark mb-3">
	<div class="card" >
        <div class="card-body">
		<form action="imprimirCertificado.php" method="POST">
		<div class="form-group">

    		<table align="center">

    			<tr>
    				<td>Nome Certificado:&nbsp;&nbsp;</td>
    				<td><input type ="text" name="nome-certificado" class="form-control-plaintext" placeholder="Nome certificado:" required></td>
    			</tr>

    			<tr>
    				<td>Nome Pessoa:&nbsp;&nbsp;</td>
    				<td><input type="text" name="nome-certificando" class="form-control-plaintext" placeholder="Nome Certificando:" required></td>
				</tr>
    			<tr>
    				<td colspan="2" align="center"><input type="submit" value="Gerar Certificado" name="gerarCertificado" class="btn btn-dark"></td>
    			</tr>
    		</table>
    	</div>
		</form>
    </div>
    </div>
</div>
</div>
</div>
</body>
</html>