<?php
session_start();
require_once('funcoes.php');
$funcao = new Funcoes(); 
if(isset($_POST['action']) && !empty($_POST['action'])) {
    session_unset();
    $diretorioCertificado = __DIR__.DIRECTORY_SEPARATOR."certificado". DIRECTORY_SEPARATOR;
    $diretorioFonte = __DIR__.DIRECTORY_SEPARATOR."fontes". DIRECTORY_SEPARATOR;
    array_map('unlink', glob($diretorioCertificado .'*' .'*'));
    array_map('unlink', glob($diretorioFonte .'*' .'*'));
}
//unset ($_SESSION['gerarIRT']);
$verificaimagick = $funcao -> verificaimagick();
$_SESSION['verificaimagick'] = $verificaimagick;
$verificaGhostscript = $funcao -> verificaGhostscript();
if(isset($_POST['gerarPDF']) && !empty($_POST['gerarPDF'])) {
    $eixoX = (int)$_POST['eixoX'];
    $eixoY = (int)$_POST['eixoY'];
    $fonte = (int)$_POST['fonte'];
    $_SESSION['eixoX'] = $eixoX;
    $_SESSION['eixoY'] = $eixoY;
    $_SESSION['fonteTamanho'] = $fonte;
    $nomeSemEspacos = str_replace(' ', '_', $_SESSION['nome']); 
    $teste = $funcao -> gerarIRT($verificaGhostscript);
    $output = shell_exec($_SESSION['verificaimagick'] . __DIR__ . DIRECTORY_SEPARATOR ."certificado". DIRECTORY_SEPARATOR ."certificado.jpg ". __DIR__ . DIRECTORY_SEPARATOR ."certificado". DIRECTORY_SEPARATOR ."certificado_".$nomeSemEspacos.".pdf");
}
if (isset ($_SESSION['gerarIRT']) && $_SESSION['gerarIRT'] == true ){
    $eixoX = (int)$_POST['eixoX'];
    $eixoY = (int)$_POST['eixoY'];
    $fonte = (int)$_POST['fonte'];
    $_SESSION['eixoX'] = $eixoX;
    $_SESSION['eixoY'] = $eixoY;
    $_SESSION['fonteTamanho'] = $fonte;
    $teste = $funcao -> gerarIRT($verificaGhostscript);
}
else{   
    $verificaPastas = $funcao -> verificaPastas();
    if ($_FILES['fonteAnexo']['tmp_name'] != ""){
        $verificaFonte = $funcao -> verificaFonte($_FILES['fonteAnexo']['tmp_name']);
        $_SESSION['fonte'] = __DIR__. DIRECTORY_SEPARATOR . 'fontes'. DIRECTORY_SEPARATOR.$verificaFonte;
        $verificaFonte = __DIR__. DIRECTORY_SEPARATOR . 'fontes'. DIRECTORY_SEPARATOR.$verificaFonte;
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
    $verificaAnexo = $funcao -> verificaAnexo($_FILES['certificadoAnexo']['tmp_name']);
    $dados = [$eixoX,$eixoY,$tamanhoFonte,$nomeCertificando,$verificaFonte,$verificaGhostscript,$verificaAnexo];
    $_SESSION['pdf'] = $verificaAnexo;
    $escreveJPEG = $funcao -> escreveJPEG($dados);
    $geraPDF = $funcao -> geraPDF($verificaimagick);
}
?>