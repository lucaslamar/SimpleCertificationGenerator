<?php
class funcoes{

function verificaimagick(){

}
    
function verificaPastas(){
    
        $diretorioCertificado = "../certificado/";
    if (!file_exists($diretorioCertificado)){
        mkdir($diretorioCertificado, 0700);
        }
	$diretorioFonte = "fontes";
    if (!file_exists($diretorioFonte)){
        mkdir($diretorioFonte, 0700);
		copy('../fontes/DancingScript-Regular.ttf', $diretorioFonte .'/DancingScript-Regular.ttf');
        }
	if (!file_exists($diretorioFonte .'/DancingScript-Regular.ttf')){
	copy('../fontes/DancingScript-Regular.ttf', $diretorioFonte .'/DancingScript-Regular.ttf');
	}
}
    
function verificaGhostscript(){
    
}

function geraPDF(){
    
}

function escreveJPEG(){
    
}
    
    
    
    
    
    
    
    
}
?>