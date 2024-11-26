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

  signupButton = document.getElementById("home-nav-button");
  signupButtonMobile = document.getElementById("home-nav-button-mobile");
  signupButton.addEventListener('click', ()=>{showSectionDoc("doc-section-home")});
  signupButtonMobile.addEventListener('click', ()=>{showSectionDoc("doc-section-home")});

  signupButton = document.getElementById("update-nav-button");
  signupButtonMobile = document.getElementById("update-nav-button-mobile");
  signupButton.addEventListener('click', ()=>{showSectionDoc("doc-section-update")});
  signupButtonMobile.addEventListener('click', ()=>{showSectionDoc("doc-section-update")});

  signupButton = document.getElementById("delete-nav-button");
  signupButtonMobile = document.getElementById("delete-nav-button-mobile");
  signupButton.addEventListener('click', ()=>{showSectionDoc("doc-section-delete")});
  signupButtonMobile.addEventListener('click', ()=>{showSectionDoc("doc-section-delete")});

  navbarToggler = document.querySelector(".navbar-toggler");
}

function showSectionDoc(id){
  for(let i = 0; i < docSections.length ; i++){
      docSections[i].classList.add("d-none");
  };

  const displayedSection = document.getElementById(id);
  displayedSection.classList.remove("d-none");

  navbarToggler.dispatchEvent(click);
  grayOption(id);
}

function grayOption(id){
  const section = id.split('-')[2];
  const sectionId = section + '-nav-button';
  const buttons = document.querySelectorAll('.doc-nav-button');

  buttons.forEach(button => {
    if(button.id === sectionId){
      button.classList.add("bg-gray");
    }
    else{
      button.classList.remove("bg-gray");
    }
  });
}