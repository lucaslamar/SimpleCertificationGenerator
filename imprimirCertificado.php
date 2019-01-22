<?php

 $nomeCertificando = $_POST['nome-certificando'];
 $nomeCertificado = $_POST['nome-certificado'];
// ESPECICAÇÕES IMAGEM
// Exemplo de como gerar imagem a partir de um modelo base
$imge = imagecreatefromjpeg("certificado-base.jpg");
$titleColor = imagecolorallocate($imge, 0, 0, 0);
$gray = imagecolorallocate($imge, 120, 120, 120);

$fonteBevan = __DIR__ . DIRECTORY_SEPARATOR . "fonts" . DIRECTORY_SEPARATOR . "Bevan-Regular.ttf";
$fontePlayBall= __DIR__ . DIRECTORY_SEPARATOR . "fonts" . DIRECTORY_SEPARATOR . "Playball-Regular.ttf";

// Quando for usar uma fonte própria segue a função e parametros necessário - Neste exemplo válido para fontes truetype (ttf)
//imagettftext(image, size, angle, x, y, color, fontfile, text)
imagettftext($imge, 32, 0, 100, 150, $titleColor, $fonteBevan, $nomeCertificado);
imagettftext($imge, 32, 0, 440, 350, $titleColor, $fontePlayBall, $nomeCertificando);

//imagestring($imge, 10, 0, 400, 380, $gray, $fontePlayBall, utf8_decode("Concluído em: ").date("d/m/Y"),$titleColor);
imagestring($imge, 3, 440, 410, utf8_decode("Concluido em : ") . date("d/m/Y"), $titleColor);


// GERANDO A IMAGEM
header("Content-type: image/jpeg");
$nomeSemEspacos = str_replace(' ', '', $nomeCertificando);
imagejpeg($imge);
imagejpeg($imge, "certificado-".mb_strtolower($nomeSemEspacos,"utf-8").".jpg",60);
imagedestroy($imge);
?>
