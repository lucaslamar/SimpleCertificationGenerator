/*
Olá, meu nome é Arthur e este é o meu código em JS. Neste código vamos inserir algumas funcionalidades extras ao site.
*/




//Primeiramente, vamos validar os inputs para garantir a segurança e usabilidade pelo usuário.

//A variável trueInput é um array que possui dois estados: 0 ou 1. 1 é quando o input está corretamente preenchido e 0 quando o input não está corretamente preenchido.
var trueInput = [0, 0, 0, 0];
//A variável botao deixa o botão de gerar certificado inativo, impossibilitando o usuário de prosseguir.
var botao = document.getElementById("buttonDisappear");
botao.disabled = true;



/*Agora, vamos trabalhar com cada input diretamente. Nestes primeiros blocos de código, eu estou fazendo o seguinte:
1 - Armazena o input numa variável;
2 - Cria uma função que será chamada todas as vezes que o usuário estiver utilizando o campo de input;
3 - A cada alteração que o usuário fizer no campo de input, essa alteração será comparada com uma Expressão Regular;
4 - Se a Expressão Regular não estiver de acordo com o que foi digitado pelo usuário no input, o array trueInput na posição do input em questão receberá o valor 0 e emitirá uma mensagem ao usuário afirmando que o valor digitado é inválido;
5 - Se a Expressão Regular estiver de acordo com o que foi digitado pelo usuário no input, o array trueInput na posição do input em questão receberá o valor 1 e a mensagem de erro será omitida.
*/


//var nomCertErrorDis = 0;
//Validando o campo de nome do certificando
var nomeCertificando = document.getElementById("nomCert");
nomeCertificando.oninput = function() {autenticidadeNome()};
function autenticidadeNome() {
    var re = /^[çãáàéèêÇÃÁÀÉÈÊ'A-Za-z _]*[çãáàéèêÇÃÁÀÉÈÊ'A-Za-z][çãáàéèêÇÃÁÀÉÈÊ'A-Za-z _]*$/;
    var nameField = document.getElementById("nomCert").value;
    var str = nameField;
    var found = re.test(str);
    if (!found)
    {
        trueInput[0] = 0;
        document.getElementById("nomCertError").style.webkitAnimationName = 'cardMoving';
        document.getElementById("nomCertError").style.webkitAnimationDuration = '.5s';
        document.getElementById("nomCertError").style.display = "block";
    }
    else
    {
        trueInput[0] = 1;
        $("#nomCertError").fadeOut(500);
    }
}



//Validando o campo de tamanho da fonte
var fontSize = document.getElementById("fontSz");
fontSize.oninput = function() {autenticidadeFonte()};
function autenticidadeFonte() {
    var re = /^[0-9]+([.][0-9]+)?$/;
    var fontField = document.getElementById("fontSz").value;
    var str = fontField;
    var found = re.test(str);
    if (!found)
    {
        trueInput[1] = 0;
        document.getElementById("fontSzError").style.webkitAnimationName = 'cardMoving';
        document.getElementById("fontSzError").style.webkitAnimationDuration = '.5s';
        document.getElementById("fontSzError").style.display = "block";
    }
    else
    {
        trueInput[1] = 1;
        $("#fontSzError").fadeOut(500);

    }
}


//Validando o campo do eixo X
var xSide = document.getElementById("x");
xSide.oninput = function() {autenticidadeEixoX()};
function autenticidadeEixoX() {
    var re = /^$|^[0-9]+([.][0-9]+)?$/;
    var xSideField = document.getElementById("x").value;
    var str = xSideField;
    var found = re.test(str);
    if (!found)
    {
        trueInput[2] = 0;
        document.getElementById("xError").style.webkitAnimationName = 'cardMoving';
        document.getElementById("xError").style.webkitAnimationDuration = '.5s';
        document.getElementById("xError").style.display = "block";

    }
    else
    {
        trueInput[2] = 1;
        $("#xError").fadeOut(500);
    }
}



//Validando o campo do eixo Y
var ySide = document.getElementById("y");
ySide.oninput = function() {autenticidadeEixoY()};
function autenticidadeEixoY() {
    var re = /^$|^[0-9]+([.][0-9]+)?$/;
    var ySideField = document.getElementById("y").value;
    var str = ySideField;
    var found = re.test(str);
    if (!found)
    {
        trueInput[3] = 0;
        document.getElementById("yError").style.webkitAnimationName = 'cardMoving';
        document.getElementById("yError").style.webkitAnimationDuration = '.5s';
        document.getElementById("yError").style.display = "block";
    }
    else
    {
        trueInput[3] = 1;
        $("#yError").fadeOut(500);
    }
}


//Agora vamos trabalhar com os resultados obtidos pelo array trueInput:
//Cada um desses casos trabalha com resultados diferentes para o botão de gerar certificado.




/*
Neste primeiro caso, eu trato o que o botão deve fazer nas seguintes situações:
1 - Se os inputs de nome do certificando e de tamanho da fonte estiverem devidamente preenchidos e os outros inputs não, o botão de gerar certificado estará disponível e atribuirá um valor vazio para os eixos X e Y;
2 - Se todos os inputs estiverem devidamente preenchidos, o botão de gerar certificado estará disponível.
*/
document.getElementById("myForm").addEventListener("keyup", function() {
    if (trueInput[0] == 1 && trueInput[1] == 1 && trueInput[2] == 0 && trueInput[3] == 0)
    {
        document.getElementById("x").value = "";
        document.getElementById("y").value = "";
        botao.disabled = false;
    }
    else if (trueInput[0] == 1 && trueInput[1] == 1 && trueInput[2] == 1 && trueInput[3] == 1)
    {
        botao.disabled = false;

    }
    else
    {
        botao.disabled = true;
    }
});


/*
Neste segundo caso, eu ofereço ajuda ao usuário para poder preencher corretamente os botões e, assim, liberar o botão de gerar certificado. O tratamento ocorre das seguinte maneira:
1 - Se os inputs de nome do certificando e tamanho da fonte estiverem incorretos, os textos de ajuda dos dois campos serão apresentados e o input de nome do certificano será focado, para auxiliar o usuário a visualizar seus erros;
2 - Se apenas o campo de nome do certificando estiver vazio, esse input será focado e abaixo será apresentada uma mensagem de erro;
3 - Se apenas o campo de tamanho da fonte estiver vazio, esse input será focado e abaixo será apresentada uma mensagem de erro;
4 - Se o input do campo do eixo X estiver incorreto, esse campo terá foco;
5 - Se o input do campo do eixo Y estiver incorreto, esse campo terá foco;

*/
document.getElementById("btnDisabled").addEventListener("click", function() {
    if (botao.disabled == true)
    {
        if (trueInput[0] == 0 && trueInput[1] == 0)
        {
            document.getElementById("nomCertError").style.webkitAnimationName = 'cardMoving';
            document.getElementById("nomCertError").style.webkitAnimationDuration = '.5s';
            document.getElementById("nomCertError").style.display = "block";
            document.getElementById("fontSzError").style.webkitAnimationName = 'cardMoving';
            document.getElementById("fontSzError").style.webkitAnimationDuration = '.5s';
            document.getElementById("fontSzError").style.display = "block";
            nomeCertificando.focus();
        }
        else if (trueInput[0] == 0)
        {
            nomeCertificando.focus();
            document.getElementById("nomCertError").style.webkitAnimationName = 'cardMoving';
            document.getElementById("nomCertError").style.webkitAnimationDuration = '.5s';
            document.getElementById("nomCertError").style.display = "block";
        }
        else if (trueInput[1] == 0)
        {
            fontSize.focus();
            document.getElementById("fontSzError").style.webkitAnimationName = 'cardMoving';
            document.getElementById("fontSzError").style.webkitAnimationDuration = '.5s';
            document.getElementById("fontSzError").style.display = "block";
        }

        else if (trueInput[2] == 0){
            xSide.focus();
        }
        else if (trueInput[3] == 0){
            ySide.focus();
        }
    }
});




//Agora, vamos começar a declarar as variáveis que vão atuar no modal.
var modal = document.getElementById("meuModal");
var btn = document.getElementById("abreModal");


//É hora de apresentar o modal, quando o usuário clicar no ícone. Por meio de uma simples função podemos fazer isso:
btn.onclick = function() {
    modal.style.webkitAnimationName = 'slide';
    modal.style.webkitAnimationDuration = '.5s';
    modal.style.display = "block";
  }

//Vamos agora fechar o modal quando o usuário clicar em alguma área fora do modal. Por meio de outra função simples:
window.onclick = function (event){
  if (event.target == modal) {
    modal.style.webkitAnimationName = 'slideBack';
    modal.style.webkitAnimationDuration = '.5s';
    setTimeout(function call(event) {
      modal.style.display = "none";
      }, 250);
  }
}


//Agora é hora de trabalhar com alguns outros elementos quando o site é carregado, por meio da função window.onload:
  window.onload = function() { 
//Primeiramente, vamos procurar pelo elemento na Navigation Drawer ao qual o usuário está atualmente acessando. Ao encontrarmos a classe em questão, adicionamos a classe "active" à tag âncora (<a></a>)
    var all_links = document.getElementById("navInfoMenu").getElementsByTagName("a"),
        i=0, len=all_links.length,
        full_path = location.href.split('#')[0]; 

    for(; i<len; i++) {
        if(all_links[i].href.split("#")[0] == full_path) {
            all_links[i].className += " active";
            
        }
    }
    //Excelente! Agora vamos alterar o svg da classe que foi definida como "active", iterando pelos elementos da tag svg e modificando o valor "fill" para a cor desejada.
    var getIcon = document.getElementsByClassName("infoItem active")[0];
    getPathIcon = getIcon.getElementsByTagName("path");
    for (n=0;n<getPathIcon.length;n++)
    {
    getPathIcon[n].style.fill = "#EA2027";
    }

}


//Eu estou usando uma biblioteca chamada Typed.JS para dar um efeito bonito de digitação às strings dos títulos de cada página. 
//Aqui é uma pequena configuração para apresentar a string desejada, localizada no objeto "strings". 
var typed = new Typed('#requerimentos', {
    strings: ["Requerimentos"],
    typeSpeed: 40,
    backSpeed: 0,
    fadeOut: true,
    loop: false
  });



//Agora vamos trabalhar com os inputs do tipo file, que são feitos pelo bootstrap.
//Nesta função, eu apresento o nome do arquivo que o usuário selecionou na label do input.
$('#inputCert').on('change',function(){
                var fileName = document.getElementById("inputCert").files[0].name;
                $(this).next('.custom-file-label').html(fileName);
            })
			$('#inputFonte').on('change',function(){
                var fileName = document.getElementById("inputFonte").files[0].name;
                $(this).next('.custom-file-label').html(fileName);
            })


