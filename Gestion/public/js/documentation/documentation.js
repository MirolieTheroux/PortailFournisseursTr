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
  loginButton.addEventListener('click', ()=>{showSectionDoc("doc-section-login")});

  signupButton = document.getElementById("signup-nav-button");
  signupButton.addEventListener('click', ()=>{showSectionDoc("doc-section-signup")});

  signupButton = document.getElementById("home-nav-button");
  signupButton.addEventListener('click', ()=>{showSectionDoc("doc-section-home")});

  signupButton = document.getElementById("update-nav-button");
  signupButton.addEventListener('click', ()=>{showSectionDoc("doc-section-update")});

  signupButton = document.getElementById("delete-nav-button");
  signupButton.addEventListener('click', ()=>{showSectionDoc("doc-section-delete")});

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