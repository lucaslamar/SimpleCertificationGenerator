<!--
Author: Colorlib
Author URL: https://colorlib.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Gerador de Certificado</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>ASSINAR CERTIFICADO</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form enctype="multipart/form-data" action="imprimirCertificadoAnexo.php" method="post">
					<input class="text email" type="text" name="nome-certificando" placeholder="Nome Certificando" required="">
					<input class="text" type="text" name="tamanho-fonte" placeholder="Tamanho Fonte">
					<input class="text w3lpass" type="text" name="eixo-x" placeholder="Eixo X">
					<input class="text w3lpass" type="text" name="eixo-y" placeholder="Eixo Y">
					<div class="wthree-text">
						<div class="clear"> </div>
					</div>
					<input type="file" name="anexo" value="Anexo">
					<input type="submit" value="Gerar Certificado">
					
				</form>
				
			</div>
		</div>
		<!-- copyright -->
		<div class="colorlibcopy-agile">
			<p>© 2018 Colorlib Signup Form. All rights reserved | Design by <a href="https://colorlib.com/" target="_blank">Colorlib</a></p>
		</div>
		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->
</body>
</html>