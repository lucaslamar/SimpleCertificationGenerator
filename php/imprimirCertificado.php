<?php
session_start();
    // verificando se o diretorio existe e criando se nescessario

    $diretorio = "certificado";
    if (!file_exists($diretorio)){
        mkdir("$diretorio", 0700);
        }
// recebendo parametros formulario
    $nomeCertificando = $_POST['nome'];
    $tamanhoFonte = (int)$_POST['fonte'];
    $eixoX = (int)$_POST['eixoX'];
    $eixoY = (int)$_POST['eixoY'];
    
    // upload do certificado 

    unset($_SESSION['imagem']);
    $uploaddir = 'certificado'. DIRECTORY_SEPARATOR .'';
    $uploadfile = $uploaddir . basename($_FILES['anexo']['name']);
    move_uploaded_file($_FILES['anexo']['tmp_name'], $uploadfile);

      // tratando parametros passados vazios
      if (empty($tamanhoFonte)) $tamanhoFonte ?: $tamanhoFonte = 22;
      if (empty($eixoX)) $eixoX ?: $eixoX = 480;
      if (empty($eixoY)) $eixoY ?: $eixoY = 320;



    $output = shell_exec( "gswin64c -sDEVICE=jpeg -r400 -dCompatibilityLevel=1.4 -dNOPAUSE -dQUIET -dBATCH -sOutputFile=certificado". DIRECTORY_SEPARATOR ."certificado.jpg ".$uploadfile."");
    $imge = imagecreatefromjpeg('certificado'. DIRECTORY_SEPARATOR .'certificado.jpg');
    $titleColor = imagecolorallocate($imge, 0, 0, 0);
    $gray = imagecolorallocate($imge, 120, 120, 120);

    // fontes
    $fontePadrao = __DIR__ . DIRECTORY_SEPARATOR . "fonts" . DIRECTORY_SEPARATOR . "DancingScript-Regular.ttf";
                
    //Quando for usar uma fonte própria segue a função e parametros necessário - Neste exemplo válido para fontes truetype (ttf)
    //imagettftext(image, size, angle, x, y, color, fontfile, text)
    //imagettftext($imge, 32, 0, 100, 150, $titleColor, $fonteBevan, $nomeCertificado);
    
    imagettftext($imge, $tamanhoFonte, 0, $eixoX, $eixoY, $titleColor, $fonteBevan, $nomeCertificando);
    // imprime data atual se preciso        
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
    header("location:formularioCertificado.php");                
?>