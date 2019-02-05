/*
Hello, there. My name is Arthur and let me show you a few features I've made in this project! =)
*/


//First of all, let's design an animation for our modal:

//Let's get the id of the elements we want to animate.
var modal = document.getElementById("meuModal");
var btn = document.getElementById("abreModal");



var trueInput = [0, 0, 0, 0];
var botao = document.getElementById("buttonDisappear");
botao.disabled = true;


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
        document.getElementById("nomCertError").style.display = "none";
    }
}


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
        document.getElementById("fontSzError").style.display = "none";

    }
}

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
        document.getElementById("xError").style.display = "none";
    }
}

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
        document.getElementById("yError").style.display = "none";
    }
}

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

        else {
            nomeCertificando.focus();
        }
    }
});


//Now let's show the modal with an animation when the menu icon is clicked:
btn.onclick = function() {
    modal.style.webkitAnimationName = 'slide';
    modal.style.webkitAnimationDuration = '.5s';
    modal.style.display = "block";
  }

//Let's create an animation when the user closes the modal by clicking outside the window:
window.onclick = function (event){
  if (event.target == modal) {
    modal.style.webkitAnimationName = 'slideBack';
    modal.style.webkitAnimationDuration = '.5s';
    setTimeout(function call(event) {
      modal.style.display = "none";
      }, 250);
  }
}


//Now we have a few things to do when the page is finally loaded:
  window.onload = function() { 
// 1 - We're gonna set the class tag in the navigation drawer element which the user is currently on by adding the class "active" to that tag;
    //Let's find the page which the user the user is right now and compare it to our list in the navigation bar
    var all_links = document.getElementById("navInfoMenu").getElementsByTagName("a"),
        i=0, len=all_links.length,
        full_path = location.href.split('#')[0]; 

    // Loop through each link.
    for(; i<len; i++) {
        if(all_links[i].href.split("#")[0] == full_path) {
            all_links[i].className += " active";
            
        }
    }
    //Good! Now it's time to change the icon in the class active to the color we want, by changing the "fill" attribute in each one of the path tags in our svg file!
    var getIcon = document.getElementsByClassName("infoItem active")[0];
    getPathIcon = getIcon.getElementsByTagName("path");
    //vamosVer.style.fill = "#EA2027";
    for (n=0;n<=getPathIcon.length;n++)
    {
    getPathIcon[n].style.fill = "#EA2027"
    }

}

//I'm using a library called Typed.js, for an awesome effect on the form title!
//This is the code used to print the string "Requerimentos" with the wished effect.
var typed = new Typed('#requerimentos', {
    strings: ["Requerimentos"],
    typeSpeed: 40,
    backSpeed: 0,
    fadeOut: true,
    loop: false
  });


$('#inputCert').on('change',function(){
                //get the file name
                var fileName = document.getElementById("inputCert").files[0].name;
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
			$('#inputFonte').on('change',function(){
                //get the file name
                var fileName = document.getElementById("inputFonte").files[0].name;
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })


