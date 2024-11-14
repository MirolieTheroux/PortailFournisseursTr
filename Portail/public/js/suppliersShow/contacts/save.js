//Get elements in /suppliers/show/contacts/edit

document.addEventListener("DOMContentLoaded", function () {
  addContactsSaveListeners();
});

function addContactsSaveListeners(){
  btnSaveContacts.addEventListener('click', saveContacts);
}

function saveContacts(event){
  validateContactsAll();

  const currentSectionErrors = contactsContainer.querySelectorAll(".invalid-feedback");
  
  currentSectionErrors.forEach(errorMessage => {
    console.log("Test invalid input");
    if (errorMessage.style.display == "block") {
      console.log("Test invalid input visible");
      event.preventDefault();
    }
  });
}