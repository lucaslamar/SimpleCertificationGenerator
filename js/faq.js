/*
Olá, meu nome é Arthur e este é o meu código em JS. Neste código vamos inserir algumas funcionalidades extras ao site.
*/


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
    for (n=0;n<=getPathIcon.length;n++)
    {
    getPathIcon[n].style.fill = "#EA2027"
    }

}




//Eu estou usando uma biblioteca chamada Typed.JS para dar um efeito bonito de digitação às strings dos títulos de cada página. 
//Aqui é uma pequena configuração para apresentar a string desejada, localizada no objeto "strings". 
var typed = new Typed('#faqTag', {
    strings: ["FAQ"],
    typeSpeed: 40,
    backSpeed: 0,
    fadeOut: true,
    loop: false
  });