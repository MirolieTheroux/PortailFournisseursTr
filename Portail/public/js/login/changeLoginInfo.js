let neqButton;
let neqLink;
let neqContainer;
let neqInput;
let emailButton;
let emailLink;
let emailContainer;
let emailInput;
let errorMessages;

let forgotPasswordLink;
let forgotPasswordBackLink;
let connexionForm;
let forgotPasswordForm;

document.addEventListener('DOMContentLoaded', async function() {
  getLoginElement();
  if(emailInput.value){
    showEmail();
  }
  addInputChangeListeners();
});

function getLoginElement(){
  neqButton = document.getElementById('possessNeq-button');
  neqLink = document.getElementById('possessNeq-link');
  neqContainer = document.getElementById('neqContainer');
  neqInput = document.getElementById('neq');

  forgotPasswordLink = document.getElementById('forgotPassword-link');
  forgotPasswordBackLink = document.getElementById('forgotPasswordBack-link');
  connexionForm = document.getElementById('connexion-form');
  forgotPasswordForm = document.getElementById('forgotPassword-form');
  
  emailButton = document.getElementById('possessNoNeq-button');
  emailLink = document.getElementById('possessNoNeq-link');
  emailContainer = document.getElementById('emailContainer');
  emailInput = document.getElementById('email');
}

function addInputChangeListeners(){
  neqButton.addEventListener('click', (event)=>{changeInput(event.target)});
  neqLink.addEventListener('click', (event)=>{changeInput(event.target)});
  emailButton.addEventListener('click', (event)=>{changeInput(event.target)});
  emailLink.addEventListener('click', (event)=>{changeInput(event.target)});
  forgotPasswordLink.addEventListener('click', (event)=>{changeInput(event.target)});
  forgotPasswordBackLink.addEventListener('click', (event)=>{changeInput(event.target)});
}

function changeInput(element){
  if(element.classList.contains('login-unselected')){
    if(element.id.includes("possessNoNeq")){
      showEmail();
    }
    else if(element.id.includes("possessNeq")){
      showNeq();
    }
    else if(element.id.includes("forgotPasswordBack")){
      hideForgotPassword();
    }
    else if(element.id.includes("forgotPassword")){
      showForgotPassword();
    }
  }
}

function showNeq(){
  connexionForm.classList.remove('d-none');
  forgotPasswordForm.classList.add('d-none');
  neqButton.classList.remove('login-unselected');
  neqButton.classList.add('login-selected');
  neqLink.classList.remove('login-unselected');
  neqLink.classList.add('login-selected');

  emailButton.classList.remove('login-selected');
  emailButton.classList.add('login-unselected');
  emailLink.classList.remove('login-selected');
  emailLink.classList.add('login-unselected');

  emailContainer.classList.add('d-none');
  emailInput.removeAttribute('name');

  neqContainer.classList.remove('d-none');
  neqInput.setAttribute('name', 'neq');
}

function showEmail(){
  connexionForm.classList.remove('d-none');
  forgotPasswordForm.classList.add('d-none');
  neqButton.classList.remove('login-selected');
  neqButton.classList.add('login-unselected');
  neqLink.classList.remove('login-selected');
  neqLink.classList.add('login-unselected');

  emailButton.classList.remove('login-unselected');
  emailButton.classList.add('login-selected');
  emailLink.classList.remove('login-unselected');
  emailLink.classList.add('login-selected');

  neqContainer.classList.add('d-none');
  neqInput.removeAttribute('name');

  emailContainer.classList.remove('d-none');
  emailInput.setAttribute('name', 'email');
}

function hideForgotPassword(){
  connexionForm.classList.remove('d-none');
  forgotPasswordForm.classList.add('d-none');
}

function showForgotPassword(){
  connexionForm.classList.add('d-none');
  forgotPasswordForm.classList.remove('d-none');
}