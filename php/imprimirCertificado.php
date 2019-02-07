<?php
session_start();
    // Chamando o arquivo funcoes.php && instanciando a classe Funcoes que atribuiba a variavel funcao 
    require_once('funcoes.php');
    $funcao = new Funcoes(); 
    $teste = $funcao -> verificaFonte();
		
// recebendo parametros formulario
    $nomeCertificando = $_POST['nome-certificando'];
    $tamanhoFonte = (int)$_POST['tamanho-fonte'];
    $eixoX = (int)$_POST['eixo-x'];
    $eixoY = (int)$_POST['eixo-y'];
	
    // fonte definda como padrao caso seja passada nenhuma
    $fontePadrao = 'fontes'. DIRECTORY_SEPARATOR."DancingScript-Regular.ttf"; // fontes/DancingScript-Regular.ttf

      // tratando parametros passados vazios
      if (empty($tamanhoFonte)) $tamanhoFonte ?: $tamanhoFonte = 22;
      if (empty($eixoX)) $eixoX ?: $eixoX = 480;
      if (empty($eixoY)) $eixoY ?: $eixoY = 320;
	  if ($uploadfontefile != 'fontes'.DIRECTORY_SEPARATOR){
		  $fonte =  __DIR__ .DIRECTORY_SEPARATOR. $uploadfontefile;
	  }
	  else{
	  $fonte = __DIR__ .DIRECTORY_SEPARATOR. $fontePadrao;
      }
      
    $_SESSION['salvarPDF'] = __DIR__.DIRECTORY_SEPARATOR."certificado". DIRECTORY_SEPARATOR ."certificado.pdf";
    $_SESSION['salvarJPEG'] = __DIR__.DIRECTORY_SEPARATOR."certificado". DIRECTORY_SEPARATOR ."certificado.jpg";
?>