//Get elements in /suppliers/show/contacts/edit

document.addEventListener("DOMContentLoaded", function () {
  addContactsSaveListeners();
});

function addContactsSaveListeners(){
  btnSaveContacts.addEventListener('click', saveContacts);
}

function saveContacts(){
  validateContactsAll();

  //in /supplier/show/contacts/cancel
  //disableContactSectionEdit();
}