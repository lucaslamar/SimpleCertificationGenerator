<?php
session_start();
require_once('funcoes.php');
$funcao = new Funcoes(); 
$verificaimagick = $funcao -> verificaimagick();
$verificaGhostscript = $funcao -> verificaGhostscript();
$verificaPastas = $funcao -> verificaPastas();
$verificaFonte = $funcao -> verificaFonte($_FILES['fonteAnexo']['tmp_name']);
$verificaAnexo = $funcao -> verificaAnexo($_FILES['certificadoAnexo']['tmp_name']);
$_SESSION['gerarIRT'] = true;
	// recebendo parametros formulario
$nomeCertificando = $_POST['nome-certificando'];
$tamanhoFonte = (int)$_POST['tamanho-fonte'];
$eixoX = (int)$_POST['eixo-x'];
$eixoY = (int)$_POST['eixo-y'];

      // tratando parametros passados vazios

	// fonte definda como padrao caso seja passada nenhuma
    $fontePadrao = 'fontes'. DIRECTORY_SEPARATOR."DancingScript-Regular.ttf"; // fontes/DancingScript-Regular.ttf
    if (empty($tamanhoFonte)) $tamanhoFonte ?: $tamanhoFonte = 22;
    if (empty($eixoX)) $eixoX ?: $eixoX = 480;
    if (empty($eixoY)) $eixoY ?: $eixoY = 320;
    if ($uploadfontefile != 'fontes'.DIRECTORY_SEPARATOR){
    	$fonte =  __DIR__ .DIRECTORY_SEPARATOR. $uploadfontefile;
    }
    else{
    	$fonte = __DIR__ .DIRECTORY_SEPARATOR. $fontePadrao;
    }
    
    if (_SESSION['gerarIRT'] === true){
    	$teste = $funcao -> gerarIRT();
    }
    else{	

    }

    ?>