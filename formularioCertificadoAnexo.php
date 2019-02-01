<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Gerador de Certificado</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
				<form enctype="multipart/form-data" action="" method="post">
					<input class="text email" type="text" name="nome" required="">
					<input class="text" type="text" name="fonte" placeholder="Tamanho Fonte">
					<input class="text w3lpass" type="text" name="eixoX" placeholder="Eixo X">
					<input class="text w3lpass" type="text" name="eixoY" placeholder="Eixo Y">
					<div class="wthree-text">
						<div class="clear"> </div>
					</div>
					<input type="file" name="anexo" value="Anexo">
					<input type="submit" value="Gerar Certificado">
					
				</form>
			</div>
			<?php
				if (isset($_SESSION['imagem'])){
					echo '<img src="data:image/jpeg;base64,' . $_SESSION['imagem'] . '" />';
					unset($_SESSION['imagem']);
					echo '<a href="'.$_SESSION['salvarPDF'].'" >Salvar PDF</a>';
					echo '<a href="'.$_SESSION['salvarJPEG'].'" >Salvar JPEG</a>';
				}
				?>
		</div>
	</div>
	<!-- //main -->
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	unset($_SESSION['imagem']);
	$uploaddir = 'certificado'. DIRECTORY_SEPARATOR .'';
    $uploadfile = $uploaddir . basename($_FILES['anexo']['name']);
	move_uploaded_file($_FILES['anexo']['tmp_name'], $uploadfile);
$output = shell_exec( "gswin64c -sDEVICE=jpeg -r400 -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile=certificado". DIRECTORY_SEPARATOR ."certificado.jpg ".$uploadfile."");
$imge = imagecreatefromjpeg('certificado'. DIRECTORY_SEPARATOR .'certificado.jpg');
$titleColor = imagecolorallocate($imge, 0, 0, 0);
$gray = imagecolorallocate($imge, 120, 120, 120);

$fonteBevan = __DIR__ . DIRECTORY_SEPARATOR . "fonts" . DIRECTORY_SEPARATOR . "Bevan-Regular.ttf";
$fontePlayBall= __DIR__ . DIRECTORY_SEPARATOR . "fonts" . DIRECTORY_SEPARATOR . "Playball-Regular.ttf";

// Quando for usar uma fonte própria segue a função e parametros necessário - Neste exemplo válido para fontes truetype (ttf)
//imagettftext(image, size, angle, x, y, color, fontfile, text)
//imagettftext($imge, 32, 0, 100, 150, $titleColor, $fonteBevan, $nomeCertificado);
imagettftext($imge, 80, 0, 1400, 1400, $titleColor, $fonteBevan, $_POST['nome']);

//imagestring($imge, 10, 0, 400, 380, $gray, $fontePlayBall, utf8_decode("Concluído em: ").date("d/m/Y"),$titleColor);
//imagestring($imge, 3, 440, 410, utf8_decode("Concluido em : ") . date("d/m/Y"), $titleColor);
ob_start (); 
  imagejpeg($imge);
  $image_data = ob_get_contents (); 
ob_end_clean (); 
$_SESSION['imagem'] = base64_encode ($image_data);
imagejpeg($imge, "certificado".DIRECTORY_SEPARATOR."certificado.jpg",60); 
$output = shell_exec( "magick convert certificado". DIRECTORY_SEPARATOR ."certificado.jpg certificado". DIRECTORY_SEPARATOR ."certificado.pdf");
$_SESSION['salvarPDF'] = "certificado". DIRECTORY_SEPARATOR ."certificado.pdf";
$_SESSION['salvarJPEG'] = "certificado". DIRECTORY_SEPARATOR ."certificado.jpg";
header("Refresh:0");


}
?>
