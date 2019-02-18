<?php
class funcoes{

// Verifica qual a versão do IMAGICK
	function verificaimagick(){
        ob_start()
		$versaoAnterior7 = shell_exec( 'convert -version');
		$versaoSuperior7 = shell_exec( 'magick convert -version');
        ob_end_clean();   
		
		if ($versaoAnterior7 != NULL){
			return 'convert ';
		}
		else if ($versaoSuperior7 != NULL){
			return 'magick convert ';
		}
		else{
			header('HTTP/1.1 415 Por favor instale o ImageImagick para continuar! / Please install ImageImagick to continue! Teste $versaoSuperior7');
			die;
		}
		
	}
    // VERIFICA SE OS DIRETORIOS "certificado e fonte existem, caso eles não existam crios"
	function verificaPastas(){
        $diretorioCertificado = __DIR__.DIRECTORY_SEPARATOR."certificado".DIRECTORY_SEPARATOR; // "../certificado/
        $diretorioFonte = __DIR__.DIRECTORY_SEPARATOR."fontes".DIRECTORY_SEPARATOR; // "../fontes/
        $diretorioFonteArquivo = __DIR__.DIRECTORY_SEPARATOR."fontes".DIRECTORY_SEPARATOR."DancingScript-Regular.ttf"; // "../fontes/
        $diretorioFonteRaiz = dirname(__DIR__, 1).DIRECTORY_SEPARATOR."fontes".DIRECTORY_SEPARATOR."DancingScript-Regular.ttf"; // "../fontes/
        if (!file_exists($diretorioCertificado)){
        	mkdir($diretorioCertificado, 0700);
        }
        if (!file_exists($diretorioFonte)){
        	mkdir($diretorioFonte, 0700);
        }
    }
    
 // Verifica qual a versao do Ghostscript 64 || 32 para Windows ou se trata de um Unix
    function verificaGhostscript(){
    	$win64 = shell_exec( 'gswin64c -version');
    	$win32 = shell_exec( 'gswin32c -version');
    	$unix = shell_exec( 'gs -version');
    	if ($win64 != NULL){
    		return 'gswin64c ';
    	}
    	else if ($win32 != NULL){
    		return 'gswin32c ';
    	}
    	else if ($unix != NULL){
    		return 'gs ';
    	}
    	else{
    		header('HTTP/1.1 415 Por favor, instale o Ghostscript para continuar! / Please Install Ghostscript to continue!');
    		die;
    	}
    }
    // Verifica se o arquivo inserido se trata de um PDF && se o mesmo possiu um tamanho de 4e+6 bytes
    function verificaAnexo($teste){
    $diretorioCertificado = __DIR__.DIRECTORY_SEPARATOR."certificado".DIRECTORY_SEPARATOR; // "../certificado/
    if( in_array( $_FILES['certificadoAnexo']['type'], array("application/pdf") ) && $_FILES['certificadoAnexo']['size'] <= 4e+6 ){
    	$uploadfile = $diretorioCertificado . basename($_FILES['certificadoAnexo']['name']);
    	move_uploaded_file($_FILES['certificadoAnexo']['tmp_name'], $uploadfile);
    	$nomeArquivo = $_FILES['certificadoAnexo']['name'];
    	return $nomeArquivo;
    }
    else{
    	header('HTTP/1.1 415 '.utf8_decode('O arquivo informado não é um arquivo PDF válido! / The requested file is not a valid PDF file!'));
    	die;
    }
}

function verificaFonte($fonte){
    $diretorioFonte = __DIR__.DIRECTORY_SEPARATOR."fontes".DIRECTORY_SEPARATOR; // "../fontes/
    $abrirArquivoFonteUploadFile = fopen($fonte, "r");
    $cincoBytes = fread($abrirArquivoFonteUploadFile, 5);
    fclose($abrirArquivoFonteUploadFile);
    $verificaFonte = bin2hex ($cincoBytes);

    if( in_array( $_FILES['fonteAnexo']['type'], array("application/octet-stream") ) && $verificaFonte == "0001000000" || $verificaFonte == "4f54544f00" || $verificaFonte == "774f464600" || $verificaFonte == "774f463200" || $verificaFonte == "3c3f786d6c" ){
    	$uploadfontefile = $diretorioFonte . basename($_FILES['fonteAnexo']['name']);
    	move_uploaded_file($_FILES['fonteAnexo']['tmp_name'], $uploadfontefile);  
    	$nomeFonte = $_FILES['fonteAnexo']['name'];
    	return $nomeFonte;
    }
    else{
    	header('HTTP/1.1 415 '.utf8_decode('O arquivo informado não é um arquivo de fonte válido! / The requested file is not a valid font file!').'');
    	die;     
    }
}

function geraPDF($versao){
	$output = shell_exec($versao .__DIR__ . DIRECTORY_SEPARATOR ."certificado". DIRECTORY_SEPARATOR ."certificado.jpg ". __DIR__. DIRECTORY_SEPARATOR ."certificado". DIRECTORY_SEPARATOR ."certificado.pdf");

}

function escreveJPEG($dados){
	$output = shell_exec($dados[5] .' -sDEVICE=jpeg -r300 -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile='.__DIR__.DIRECTORY_SEPARATOR.'certificado'.DIRECTORY_SEPARATOR.'certificado.jpg ' .__DIR__.DIRECTORY_SEPARATOR.'certificado'.DIRECTORY_SEPARATOR.$dados[6].'');
    $imge = imagecreatefromjpeg(__DIR__.DIRECTORY_SEPARATOR."certificado".DIRECTORY_SEPARATOR."certificado.jpg"); //../certificado/certificado.jpg
    $titleColor = imagecolorallocate($imge, 0, 0, 0);
    $gray = imagecolorallocate($imge, 120, 120, 120);

    
    //Quando for usar uma fonte própria segue a função e parametros necessário - Neste exemplo válido para fontes truetype (ttf)
    //imagettftext(image, size, angle, x, y, color, fontfile, text)
    //imagettftext($imge, 32, 0, 100, 150, $titleColor, $fonteBevan, $nomeCertificado);
    
    imagettftext($imge, $dados[2], 0, $dados[0], $dados[1], $titleColor, $dados[4], $dados[3]);
    // imprime data atual se preciso        
    //imagestring($imge, 10, 0, 400, 380, $gray, $fontePlayBall, utf8_decode("Concluído em: ").date("d/m/Y"),$titleColor);
    //imagestring($imge, 3, 440, 410, utf8_decode("Concluido em : ") . date("d/m/Y"), $titleColor);
    
    ob_start (); 
    imagejpeg($imge);
    $image_data = ob_get_contents (); 
    ob_end_clean (); 
    $_SESSION['imagem'] = base64_encode ($image_data);
    echo $_SESSION['imagem'];
    imagejpeg($imge,__DIR__.DIRECTORY_SEPARATOR."certificado".DIRECTORY_SEPARATOR."certificado.jpg" ,60); // "../certificado".DIRECTORY_SEPARATOR."certificado.jpg",60
    $_SESSION["gerarIRT"] = true;
}
    // $dados = [$eixoX,$eixoY,$verificaGhostscript,$_SESSION['pdf'],$_SESSION['nome'],$_SESSION['fonte'],$fonte,$verificaimagick];
    // $dados = [$verificaGhostscript,$_SESSION['pdf'],$_SESSION['nome'],$_SESSION['fonte'],$fonte,$verificaimagick];
function gerarIRT($data){
	$output = shell_exec($data[0] .' -sDEVICE=jpeg -r300 -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile='.__DIR__.DIRECTORY_SEPARATOR.'certificado'.DIRECTORY_SEPARATOR.'certificado.jpg ' .__DIR__.DIRECTORY_SEPARATOR.'certificado'.DIRECTORY_SEPARATOR.$data[1]);
    $imge = imagecreatefromjpeg(__DIR__.DIRECTORY_SEPARATOR."certificado".DIRECTORY_SEPARATOR."certificado.jpg"); //../certificado/certificado.jpg
    $titleColor = imagecolorallocate($imge, 0, 0, 0);
    $gray = imagecolorallocate($imge, 120, 120, 120);

    
    //Quando for usar uma fonte própria segue a função e parametros necessário - Neste exemplo válido para fontes truetype (ttf)
    //imagettftext(image, size, angle, x, y, color, fontfile, text)
    //imagettftext($imge, 32, 0, 100, 150, $titleColor, $fonteBevan, $nomeCertificado);
    imagettftext($imge,$_SESSION['fonteTamanho'], 0, $_SESSION['eixoX'], $_SESSION['eixoY'], $titleColor, $data[3], $data[2]);
    // imprime data atual se preciso        
    //imagestring($imge, 10, 0, 400, 380, $gray, $fontePlayBall, utf8_decode("Concluído em: ").date("d/m/Y"),$titleColor);
    //imagestring($imge, 3, 440, 410, utf8_decode("Concluido em : ") . date("d/m/Y"), $titleColor);
    
    ob_start (); 
    imagejpeg($imge);
    $image_data = ob_get_contents (); 
    ob_end_clean (); 
    $_SESSION['imagem'] = base64_encode ($image_data);
    echo $_SESSION['imagem'];
    imagejpeg($imge,__DIR__.DIRECTORY_SEPARATOR."certificado".DIRECTORY_SEPARATOR."certificado.jpg" ,60);
}
}
?>