const click = new Event('click');

let docSections;

let loginButton;
let loginButtonMobile;
let signupButton;
let signupButtonMobile;

let navbarToggler;

document.addEventListener('DOMContentLoaded', async function() {
  getDocElement();
});

function getDocElement(){
  docSections = document.getElementsByClassName("doc-section");

  loginButton = document.getElementById("login-nav-button");
  loginButtonMobile = document.getElementById("login-nav-button-mobile");
  loginButton.addEventListener('click', ()=>{showSectionDoc("doc-section-login")});
  loginButtonMobile.addEventListener('click', ()=>{showSectionDoc("doc-section-login")});

  signupButton = document.getElementById("signup-nav-button");
  signupButtonMobile = document.getElementById("signup-nav-button-mobile");
  signupButton.addEventListener('click', ()=>{showSectionDoc("doc-section-signup")});
  signupButtonMobile.addEventListener('click', ()=>{showSectionDoc("doc-section-signup")});

  navbarToggler = document.querySelector(".navbar-toggler");
}

function showSectionDoc(id){
  for(let i = 0; i < docSections.length ; i++){
      docSections[i].classList.add("d-none");
  };

  const displayedSection = document.getElementById(id);
  displayedSection.classList.remove("d-none");

  navbarToggler.dispatchEvent(click);
}