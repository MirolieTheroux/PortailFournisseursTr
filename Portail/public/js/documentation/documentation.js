const click = new Event('click');

let loginSection;
let singupSection;
let docSections;

let loginButton;
let loginButtonMobile;
let singupButton;
let singupButtonMobile;

let navbarToggler;

document.addEventListener('DOMContentLoaded', async function() {
  getDocElement();
});

function getDocElement(){
  loginSection = document.getElementById("doc-section-login");
  singupSection = document.getElementById("doc-section-singup");
  docSections = document.getElementsByClassName("doc-section");

  loginButton = document.getElementById("login-nav-button");
  loginButtonMobile = document.getElementById("login-nav-button-mobile");
  loginButton.addEventListener('click', showLoginDoc);
  loginButtonMobile.addEventListener('click', showLoginDoc);

  singupButton = document.getElementById("singup-nav-button");
  singupButtonMobile = document.getElementById("singup-nav-button-mobile");
  singupButton.addEventListener('click', showSingupDoc);
  singupButtonMobile.addEventListener('click', showSingupDoc);

  navbarToggler = document.querySelector(".navbar-toggler");
}

function showLoginDoc(){
    for(let i = 0; i < docSections.length ; i++){
        docSections[i].classList.add("d-none");
    };
    loginSection.classList.remove("d-none");

    navbarToggler.dispatchEvent(click);
}

function showSingupDoc(){
  for(let i = 0; i < docSections.length ; i++){
      docSections[i].classList.add("d-none");
  };
  singupSection.classList.remove("d-none");
  
  navbarToggler.dispatchEvent(click);
}
