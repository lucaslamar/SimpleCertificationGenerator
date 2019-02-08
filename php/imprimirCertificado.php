<?php
session_start();
require_once('funcoes.php');
$funcao = new Funcoes(); 
$verificaimagick = $funcao -> verificaimagick();
$verificaGhostscript = $funcao -> verificaGhostscript();
$verificaPastas = $funcao -> verificaPastas();
if ($_FILES['fonteAnexo']['tmp_name'] != ""){
$verificaFonte = $funcao -> verificaFonte($_FILES['fonteAnexo']['tmp_name']);
}
else {
   $verificaFonte = dirname(__DIR__, 1). DIRECTORY_SEPARATOR . 'fontes'. DIRECTORY_SEPARATOR."DancingScript-Regular.ttf"; 
}
$verificaAnexo = $funcao -> verificaAnexo($_FILES['certificadoAnexo']['tmp_name']);
$_SESSION['gerarIRT'] = true;
	// recebendo parametros formulario
$nomeCertificando = $_POST['nome-certificando'];
$tamanhoFonte = (int)$_POST['tamanho-fonte'];
$eixoX = (int)$_POST['eixo-x'];
$eixoY = (int)$_POST['eixo-y'];
if (empty($eixoX)) $eixoX ?: $eixoX = 480;
if (empty($eixoY)) $eixoY ?: $eixoY = 320;
$dados = [$eixoX,$eixoY,$tamanhoFonte,$nomeCertificando,$verificaFonte,$verificaGhostscript,$verificaAnexo];
$verificaAnexo = $funcao -> escreveJPEG($dados);
// if ($_SESSION['gerarIRT'] === true){
// $teste = $funcao -> gerarIRT();
// }
// else{	
// }
?>