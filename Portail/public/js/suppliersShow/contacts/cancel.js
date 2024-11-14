//Get elements in /suppliers/show/contacts/edit

let invalidFeedbacks;

document.addEventListener("DOMContentLoaded", function () {
  addContactsCancelListeners();
});
function addContactsCancelListeners(){
  btnCancelContacts.addEventListener('click', cancelContacts);
}

function cancelContacts(){
  disableContactSectionEdit();
}

function disableContactSectionEdit(){
  btnCancelContacts.classList.add("d-none");
  btnSaveContacts.classList.add("d-none");
  btnEditContacts.classList.remove("d-none");
  for (let index = 0; index < contactsInputs.length; index++) {
    contactsInputs[index].setAttribute("disabled","");
  }
  for (let index = 0; index < contactsSelects.length; index++) {
    contactsSelects[index].setAttribute("disabled",""); 
  }

  addContactButton.parentElement.classList.add("d-none");
  delContactButtons.forEach(button => {
    button.classList.add('d-none')
  });

  removeValidations();
  fillEmptyinputs();
}

function removeValidations(){
  const inputs = contactsContainer.querySelectorAll(".form-control");
  inputs.forEach(input => {
    input.classList.remove("is-valid", "is-invalid", "was-validated");
  });

  invalidFeedbacks = contactsContainer.querySelectorAll(".invalid-feedback");
  invalidFeedbacks.forEach(input => {
    input.style.display = "none";
  });
}

function fillEmptyinputs(){
  const inputs = contactsContainer.querySelectorAll(".form-control");
  inputs.forEach(input => {
    if(input.value === ""){
      input.value = "N/A";
    }
  });
}