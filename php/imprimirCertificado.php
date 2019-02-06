<?php
session_start();
    // verificando se o diretorio existe e criando se nescessario
    require_once('funcoes.php');
    $funcao = new Funcoes(); 

    


		
// recebendo parametros formulario
    $nomeCertificando = $_POST['nome-certificando'];
    $tamanhoFonte = (int)$_POST['tamanho-fonte'];
    $eixoX = (int)$_POST['eixo-x'];
    $eixoY = (int)$_POST['eixo-y'];
	
    // fonte padrão
    $fontePadrao = 'fontes/DancingScript-Regular.ttf';

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
    $_SESSION['salvarPDF'] = "../certificado". DIRECTORY_SEPARATOR ."certificado.pdf";
    $_SESSION['salvarJPEG'] = "../certificado". DIRECTORY_SEPARATOR ."certificado.jpg";
?>