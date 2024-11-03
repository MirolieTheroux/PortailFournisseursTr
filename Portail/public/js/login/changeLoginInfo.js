let neqButton;
let neqContainer;
let neqInput;
let emailButton;
let emailContainer;
let emailInput;
let errorMessages;

document.addEventListener('DOMContentLoaded', async function() {
  getLoginElement();
  if(emailInput.value){
    showEmail();
  }
  addInputChangeListeners();
});

function getLoginElement(){
  neqButton = document.getElementById('possessNeq-button');
  neqContainer = document.getElementById('neqContainer');
  neqInput = document.getElementById('neq');

  emailButton = document.getElementById('possessNoNeq-button');
  emailContainer = document.getElementById('emailContainer');
  emailInput = document.getElementById('email');
}

function addInputChangeListeners(){
  neqButton.addEventListener('click', (event)=>{
    changeInput(event.target)
  });

  emailButton.addEventListener('click', (event)=>{
    changeInput(event.target)
  });
}

function changeInput(button){
  if(button.classList.contains('login-unselected')){
    if(button.id === "possessNoNeq-button"){
      showEmail();
    }
    else{
      showNeq();
    }
  }
}

function showNeq(){
  neqButton.classList.remove('login-unselected');
  neqButton.classList.add('login-selected');
  emailButton.classList.remove('login-selected');
  emailButton.classList.add('login-unselected');

  emailContainer.classList.add('d-none');
  emailInput.removeAttribute('name');

  neqContainer.classList.remove('d-none');
  neqInput.setAttribute('name', 'neq');
}

function showEmail(){
  neqButton.classList.remove('login-selected');
  neqButton.classList.add('login-unselected');
  emailButton.classList.remove('login-unselected');
  emailButton.classList.add('login-selected');

  neqContainer.classList.add('d-none');
  neqInput.removeAttribute('name');

  emailContainer.classList.remove('d-none');
  emailInput.setAttribute('name', 'email');
}