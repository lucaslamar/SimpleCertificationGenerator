<?php
session_start();
class funcoes{

// Verifica qual a versão do IMAGICK
    function verificaimagick(){
        $versaoAnterior7 = shell_exec( 'convert -version');
        $versaoSuperior7 = shell_exec( 'magick convert -version');
        
        if ($versaoAnterior7 != NULL){
            return 'anterior';
        }
        else if ($versaoSuperior7 != NULL){
            return 'superior';
        }
        else{
            return NULL;
        }
        
    }
    // VERIFICA SE OS DIRETORIOS "certificado e fonte existem, caso eles não existam crios"
    function verificaPastas(){
        $diretorioCertificado = __DIR__.DIRECTORY_SEPARATOR."certificado".DIRECTORY_SEPARATOR; // "../certificado/
        if (!file_exists($diretorioCertificado)){
            mkdir($diretorioCertificado, 0700);
        }
        $diretorioFonte = "fontes";
        if (!file_exists($diretorioFonte)){
            mkdir($diretorioFonte, 0700);
            copy(__DIR__.DIRECTORY_SEPARATOR."fontes".DIRECTORY_SEPARATOR."DancingScript-Regular.ttf",$diretorioFonte.DIRECTORY_SEPARATOR."DancingScript-Regular.ttf"); // ../fontes/DancingScript-Regular.ttf', $diretorioFonte .'/DancingScript-Regular.ttf
        }
        if (!file_exists($diretorioFonte . DIRECTORY_SEPARATOR. "DancingScript-Regular.ttf")){
         copy(__DIR__.DIRECTORY_SEPARATOR."fontes".DIRECTORY_SEPARATOR."DancingScript-Regular.ttf",$diretorioFonte.DIRECTORY_SEPARATOR."DancingScript-Regular.ttf"); // '../fontes/DancingScript-Regular.ttf', $diretorioFonte .'/DancingScript-Regular.ttf'
     }
 }
 
 // Verifica qual a versao do Ghostscript 64 || 32 para Windows ou se trata de um Unix
 function verificaGhostscript(){
    $win64 = shell_exec( 'gswin64c -version');
    $win32 = shell_exec( 'gswin32c -version');
    $unix = shell_exec( 'gs -version');
    if ($win64 != NULL){
        return '64';
    }
    else if ($win32 != NULL){
        return '32';
    }
    else if ($unix != NULL){
        return 'Unix';
    }
    else{
        return NULL;
    }
}
    // Verifica se o arquivo inserido se trata de um PDF && se o mesmo possiu um tamanho de 4e+6 bytes
function verificaAnexo($teste){
    if( in_array( $_FILES['certificadoAnexo']['type'], array("application/pdf") ) && $_FILES['certificadoAnexo']['size'] <= 4e+6 ){
        $uploadfile = $diretorioCertificado . basename($_FILES['certificadoAnexo']['name']);
        move_uploaded_file($_FILES['certificadoAnexo']['tmp_name'], $uploadfile);
        $nomeArquivo = $_FILES['certificadoAnexo']['name'];
    }
    else{
        header('HTTP/1.1 406 O arquivo informado não é um arquivo PDF válido!');
        die;
    }
}
    
function verificaFonte($fonte){
    $abrirArquivoFonteUploadFile = fopen($fonte, "r");
    $cincoBytes = fread($abrirArquivoFonteUploadFile, 5);
    fclose($abrirArquivoFonteUploadFile);
	$verificaFonte = bin2hex ($cincoBytes);

     if( in_array( $_FILES['fonteAnexo']['type'], array("application/octet-stream") ) && $verificaFonte == "0001000000" || $verificaFonte == "4f54544f00" || $verificaFonte == "774f464600" || $verificaFonte == "774f463200" || $verificaFonte == "3c3f786d6c" ){
         $uploadfontefile = $diretorioFonte . basename($_FILES['fonteAnexo']['name']);
         move_uploaded_file($_FILES['fonteAnexo']['tmp_name'], $uploadfontefile);  
     }
     else{
		 
         header('HTTP/1.1 415 '.utf8_decode('O arquivo informado não é um arquivo de fonte válido!').'');
         die;     
     }
}

function geraPDF(){
    $output = shell_exec( "magick convert".__DIR__. "certificado". DIRECTORY_SEPARATOR ."certificado.jpg". __DIR__. "certificado". DIRECTORY_SEPARATOR ."certificado.pdf");
    unset($_SESSION['gerarIRT']);
}

function escreveJPEG(){
    
    $output = shell_exec( 'gswin64c -sDEVICE=jpeg -r300 -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile='. __DIR__.'certificado'.DIRECTORY_SEPARATOR. 'certificado.jpg' .__DIR__. DIRECTORY_SEPARATOR. 'certificado'.DIRECTORY_SEPARATOR.$nomeArquivo.'');
    $imge = imagecreatefromjpeg(__DIR__.DIRECTORY_SEPARATOR."certificado".DIRECTORY_SEPARATOR."certificado.jpg"); //../certificado/certificado.jpg
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
    imagejpeg($imge,__DIR__.DIRECTORY_SEPARATOR."certificado".DIRECTORY_SEPARATOR."certificado.jpg" ,60); // "../certificado".DIRECTORY_SEPARATOR."certificado.jpg",60
    
}

    function gerarIRT(){
        
}
}
?>