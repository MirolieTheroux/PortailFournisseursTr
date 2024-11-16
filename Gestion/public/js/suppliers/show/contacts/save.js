//Get elements in /suppliers/show/contacts/edit

document.addEventListener("DOMContentLoaded", function () {
  addContactsSaveListeners();
});

function addContactsSaveListeners(){
  if(btnSaveContactDetails)
    btnSaveContacts.addEventListener('click', saveContacts);
}

function saveContacts(event){
  validateContactsAll();

  const currentSectionErrors = contactsContainer.querySelectorAll(".invalid-feedback");
  
  currentSectionErrors.forEach(errorMessage => {
    if (errorMessage.style.display == "block") {
      event.preventDefault();
    }
  });
}