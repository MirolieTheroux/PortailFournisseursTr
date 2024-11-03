function hideContacts(){
  const contactsLists = document.getElementsByClassName('contactsList');
  for(let i = 0 ; i < contactsLists.length ; i++){
    const contactsArray = contactsLists[i].getElementsByClassName('contactContainer');
    const parentContainer = contactsLists[i].parentElement;
    const upButton = parentContainer.querySelector('.contactUpButtom');
    const downButton = parentContainer.querySelector('.contactDownButtom');

    if(contactsArray.length > 1){
      for(let j = 1 ; j < contactsArray.length ; j++){
        contactsArray[j].classList.add('d-none')
      }
      disableButton(upButton);
    }
    else{
      disableButton(upButton);
      disableButton(downButton);
    }
  }
}

function addUpDownListeners(){
  const buttons = document.getElementsByClassName('contactchangeButton');
  for(let i = 0 ; i < buttons.length ; i++){
    buttons[i].addEventListener('click', changeContact);
  }
}

function changeContact(event){
  let button;
  if(event.target instanceof SVGElement){
    button = event.target.parentElement;
  }
  else{
    button = event.target;
  }
  const buttonContainer = button.parentElement;
  const parentContainer = buttonContainer.parentElement;
  const contactsList = parentContainer.getElementsByClassName('contactContainer');
  const contactsArray = Array.from(contactsList);
  const index = contactsArray.findIndex(x => (!x.classList.contains('d-none')));

  contactsList[index].classList.add('d-none');
  if(button.classList.contains('contactUpButtom')){
    contactsList[index - 1].classList.remove('d-none');
    if(index === contactsList.length-1){
      const buttonDown = buttonContainer.querySelector('.contactDownButtom');
      enableButton(buttonDown)
    }
    if(index-1 === 0){
      disableButton(button);
    }
  }
  else{
    contactsList[index + 1].classList.remove('d-none');
    if(index === 0){
      const buttonUp = buttonContainer.querySelector('.contactUpButtom');
      enableButton(buttonUp)
    }
    if(index+1 === contactsList.length-1){
      disableButton(button);
    }
  }

  //Fonction dans le fichier markSelected.js
  changeContactSavedName(event);
}

function disableButton(button){
  button.classList.remove('button-darkblue');
  button.classList.add('button-disabled');
  button.removeEventListener('click', changeContact);
}

function enableButton(button){
  button.classList.remove('button-disabled');
  button.classList.add('button-darkblue');
  button.addEventListener('click', changeContact);
}

document.addEventListener("DOMContentLoaded", async function () {
  addUpDownListeners();
  hideContacts();
});