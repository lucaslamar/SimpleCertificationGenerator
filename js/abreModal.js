/*
Hello, there. My name is Arthur and let me show you a few features I've made in this project! =)
*/


//First of all, let's design an animation for our modal:

//Let's get the id of the elements we want to animate.
var modal = document.getElementById("meuModal");
var btn = document.getElementById("abreModal");

var nomeCertificando = document.getElementById("nomCert");
nomeCertificando.oninput = function() {autenticidadeNome()};
function autenticidadeNome() {
    var re = /^[çãáàéèêÇÃÁÀÉÈÊ'A-Za-z _]*[çãáàéèêÇÃÁÀÉÈÊ'A-Za-z][çãáàéèêÇÃÁÀÉÈÊ'A-Za-z _]*$/;
    var nameField = document.getElementById("nomCert").value;
    str = nameField;
    var found = re.test(str);

}


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


