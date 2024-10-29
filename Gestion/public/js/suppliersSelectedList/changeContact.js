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
  const buttonContainer = event.target.parentElement;
  const parentContainer = buttonContainer.parentElement;
  const contactsList = parentContainer.getElementsByClassName('contactContainer');
  const contactsArray = Array.from(contactsList);
  const index = contactsArray.findIndex(x => (!x.classList.contains('d-none')));

  if(event.target.classList.contains('contactUpButtom')){
    console.log('up');
  }
  else{
    //contactsList[index].classList.add('d-none')
    console.log(contactsList);
  }
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