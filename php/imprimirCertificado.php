<?php
session_start();
require_once('funcoes.php');
$funcao = new Funcoes(); 
unset ($_SESSION['gerarIRT']);
$verificaimagick = $funcao -> verificaimagick();
$verificaGhostscript = $funcao -> verificaGhostscript();
if ($_SESSION['gerarIRT'] == true){
    $eixoX = (int)$_POST['eixoX'];
    $eixoY = (int)$_POST['eixoY'];
    $dados = [$eixoX,$eixoY,$verificaGhostscript,$_SESSION['pdf'],$_SESSION['nome'],$_SESSION['fonte']];
    $teste = $funcao -> gerarIRT($dados);
}
else{	
    $verificaPastas = $funcao -> verificaPastas();
    if ($_FILES['fonteAnexo']['tmp_name'] != ""){
        $verificaFonte = $funcao -> verificaFonte($_FILES['fonteAnexo']['tmp_name']);
        $_SESSION['fonte'] = $verificaFonte;
    }
    else {
        $verificaFonte = dirname(__DIR__, 1). DIRECTORY_SEPARATOR . 'fontes'. DIRECTORY_SEPARATOR."DancingScript-Regular.ttf"; 
        $_SESSION['fonte'] = $verificaFonte;
    }
	// recebendo parametros formulario
    $nomeCertificando = $_POST['nome-certificando'];
    $_SESSION['nome'] = $nomeCertificando;
    $tamanhoFonte = (int)$_POST['tamanho-fonte'];
    $eixoX = (int)$_POST['eixo-x'];
    $eixoY = (int)$_POST['eixo-y'];
    if (empty($eixoX)) $eixoX ?: $eixoX = 480;
    if (empty($eixoY)) $eixoY ?: $eixoY = 320;
    $dados = [$eixoX,$eixoY,$tamanhoFonte,$nomeCertificando,$verificaFonte,$verificaGhostscript,$verificaAnexo];
$verificaAnexo = $funcao -> verificaAnexo($_FILES['certificadoAnexo']['tmp_name']);
$_SESSION['pdf'] = $verificaAnexo;
$escreveJPEG = $funcao -> escreveJPEG($dados);
$geraPDF = $funcao -> geraPDF($verificaimagick);
}



?>