<?php
session_start();
    // verificando se o diretorio existe e criando se nescessario

    $diretorioCertificado = "../certificado/";
    if (!file_exists($diretorioCertificado)){
        mkdir($diretorioCertificado, 0700);
        }
	$diretorioFonte = "fontes";
    if (!file_exists($diretorioFonte)){
        mkdir($diretorioFonte, 0700);
		copy('../fontes/DancingScript-Regular.ttf', $diretorioFonte .'/DancingScript-Regular.ttf');
        }
	if (!file_exists($diretorioFonte .'/DancingScript-Regular.ttf')){
	copy('../fontes/DancingScript-Regular.ttf', $diretorioFonte .'/DancingScript-Regular.ttf');
	}
		
// recebendo parametros formulario
    $nomeCertificando = $_POST['nome-certificando'];
    $tamanhoFonte = (int)$_POST['tamanho-fonte'];
    $eixoX = (int)$_POST['eixo-x'];
    $eixoY = (int)$_POST['eixo-y'];
	
    // fonte padrão
    $fontePadrao = 'fontes/DancingScript-Regular.ttf';

    // upload do certificado 
    if( in_array( $_FILES['certificadoAnexo']['type'], array("application/pdf") ) && $_FILES['certificadoAnexo']['size'] <= 4e+6 ){
    unset($_SESSION['imagem']);
    $uploadfile = $diretorioCertificado . basename($_FILES['certificadoAnexo']['name']);
    move_uploaded_file($_FILES['certificadoAnexo']['tmp_name'], $uploadfile);
    $nomeArquivo = $_FILES['certificadoAnexo']['name'];
    }
    else{

    }
	
    //uploadFonte

    $uploadfontefile = $diretorioFonte.'/'. basename($_FILES['fonteAnexo']['name']);
    move_uploaded_file($_FILES['fonteAnexo']['tmp_name'], $uploadfontefile);
	
      // tratando parametros passados vazios
      if (empty($tamanhoFonte)) $tamanhoFonte ?: $tamanhoFonte = 22;
      if (empty($eixoX)) $eixoX ?: $eixoX = 480;
      if (empty($eixoY)) $eixoY ?: $eixoY = 320;
	  if ($uploadfontefile != 'fontes/'){
		  $fonte =  __DIR__ .'/'. $uploadfontefile;
	  }
	  else{
	  $fonte = __DIR__ .'/'. $fontePadrao;
	  }
	  //echo $fonte;
	  // exit;
	  

    $output = shell_exec( 'gswin64c -sDEVICE=jpeg -r300 -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile=../certificado/certificado.jpg ../certificado/'.$nomeArquivo.'');
    $imge = imagecreatefromjpeg('../certificado/certificado.jpg');
    $titleColor = imagecolorallocate($imge, 0, 0, 0);
    $gray = imagecolorallocate($imge, 120, 120, 120);

                
    //Quando for usar uma fonte própria segue a função e parametros necessário - Neste exemplo válido para fontes truetype (ttf)
    //imagettftext(image, size, angle, x, y, color, fontfile, text)
    //imagettftext($imge, 32, 0, 100, 150, $titleColor, $fonteBevan, $nomeCertificado);
    
    imagettftext($imge, $tamanhoFonte, 0, $eixoX, $eixoY, $titleColor, $fonte, $nomeCertificando);
    // imprime data atual se preciso        
    //imagestring($imge, 10, 0, 400, 380, $gray, $fontePlayBall, utf8_decode("Concluído em: ").date("d/m/Y"),$titleColor);
    //imagestring($imge, 3, 440, 410, utf8_decode("Concluido em : ") . date("d/m/Y"), $titleColor);
    
    ob_start (); 
    imagejpeg($imge);
    $image_data = ob_get_contents (); 
    ob_end_clean (); 
    $_SESSION['imagem'] = base64_encode ($image_data);
	echo $_SESSION['imagem'];
    imagejpeg($imge, "../certificado".DIRECTORY_SEPARATOR."certificado.jpg",60); 
    $output = shell_exec( "magick convert ../certificado". DIRECTORY_SEPARATOR ."certificado.jpg ../certificado". DIRECTORY_SEPARATOR ."certificado.pdf");
    $_SESSION['salvarPDF'] = "../certificado". DIRECTORY_SEPARATOR ."certificado.pdf";
    $_SESSION['salvarJPEG'] = "../certificado". DIRECTORY_SEPARATOR ."certificado.jpg";
?>