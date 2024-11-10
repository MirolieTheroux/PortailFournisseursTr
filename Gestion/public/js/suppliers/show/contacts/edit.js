let contactsContainer;
let btnCancelContacts;
let btnEditContacts; 
let btnSaveContacts; 
let contactsInputs; 
let contactsSelects; 
let contactsRow;
let referenceContainer;
let addContactButton;

let contactCards;
let delContactButtons;

let contactNumber;

let idInput;
let firstnameInput;
let firstnameLabel;
let lastnameInput;
let lastnameLabel;
let jobInput;
let jobLabel;
let emailInput;
let emailLabel;
let telTypeInputA;
let telTypeLabelA;
let telTypeInputB;
let telTypeLabelB;
let telnumberInputA;
let telNumberLabelA;
let telnumberInputB;
let telNumberLabelB;
let telExtensionInputA;
let telExtensionLabelA;
let telExtensionInputB;
let telExtensionLabelB;

document.addEventListener("DOMContentLoaded", function () {
  getContactSectionElements();
  getContactSectionChangingElements();
  addContactsSectionListeners();
  setContactNumber();
});

function getContactSectionElements(){
  contactsContainer = document.getElementById('contacts-section');
  btnCancelContacts = document.getElementById("btnCancelContacts");
  btnSaveContacts = document.getElementById("btnSaveContacts");
  btnEditContacts = document.getElementById("btnEditContacts");
  contactsInputs = contactsContainer.getElementsByClassName("form-control");
  contactsSelects = contactsContainer.getElementsByClassName("form-select");

  contactsRow = document.getElementById('contactsRow');
  addContactButton = document.querySelector('.add-contact');

  referenceContainer = document.querySelector('.contactCard');
  idInput = contactsRow.querySelector('#contactId1');
  firstnameInput = contactsRow.querySelector('#contactFirstName1');
  firstnameLabel = contactsRow.querySelector('#contactFirstNameLabel1');
  lastnameInput = contactsRow.querySelector('#contactLastName1');
  lastnameLabel = contactsRow.querySelector('#contactLastNameLabel1');
  jobInput = contactsRow.querySelector('#contactJob1');
  jobLabel = contactsRow.querySelector('#contactJobLabel1');
  emailInput = contactsRow.querySelector('#contactEmail1');
  telIdInputA = contactsRow.querySelector('#contactTelIdA1');
  telIdInputB = contactsRow.querySelector('#contactTelIdB1');
  emailLabel = contactsRow.querySelector('#contactEmailLabel1');
  telTypeInputA = contactsRow.querySelector('#contactTelTypeA1');
  telTypeLabelA = contactsRow.querySelector('#contactTelTypeLabelA1');
  telTypeInputB = contactsRow.querySelector('#contactTelTypeB1');
  telTypeLabelB = contactsRow.querySelector('#contactTelTypeLabelB1');
  telnumberInputA = contactsRow.querySelector('#contactTelNumberA1');
  telNumberLabelA = contactsRow.querySelector('#contactTelNumberLabelA1');
  telnumberInputB = contactsRow.querySelector('#contactTelNumberB1');
  telNumberLabelB = contactsRow.querySelector('#contactTelNumberLabelB1');
  telExtensionInputA = contactsRow.querySelector('#contactTelExtensionA1');
  telExtensionLabelA = contactsRow.querySelector('#contactTelExtensionLabelA1');
  telExtensionInputB = contactsRow.querySelector('#contactTelExtensionB1');
  telExtensionLabelB = contactsRow.querySelector('#contactTelExtensionLabelB1');
}
function addContactsSectionListeners(){
  btnEditContacts.addEventListener('click', enableContactSectionEdit);
  addContactButton.addEventListener("click", cloneContact);
  
  const startingDelContactButtons = document.querySelectorAll('.delete-contact');
  for (let index = 0; index < startingDelContactButtons.length; index++) {
    startingDelContactButtons[index].addEventListener("click", function(){
      startingDelContactButtons[index].closest('.contactCard').remove();
      maskButton();
    });
  }
}

function setContactNumber(){
  contactNumber = contactCards.length;
}

function getContactSectionChangingElements(){
  contactCards = contactsContainer.getElementsByClassName("contactCard");
  delContactButtons = document.querySelectorAll('.delete-contact');
}

function enableContactSectionEdit(){
  btnCancelContacts.classList.remove("d-none");
  btnSaveContacts.classList.remove("d-none");
  btnEditContacts.classList.add("d-none");
  for (let index = 0; index < contactsInputs.length; index++) {
    contactsInputs[index].removeAttribute("disabled");
  }
  for (let index = 0; index < contactsSelects.length; index++) {
    contactsSelects[index].removeAttribute("disabled"); 
  }

  addContactButton.parentElement.classList.remove("d-none");
  maskButton();
  emptyNAinputs();
}

function emptyNAinputs(){
  const inputs = contactsContainer.querySelectorAll(".form-control");
  inputs.forEach(input => {
    if(input.value === "N/A"){
      input.value = "";
    }
  });
}

function maskButton(){
  getContactSectionChangingElements();
  if(delContactButtons.length === 1){
    delContactButtons.forEach(button => {
      button.classList.add('d-none')
    });
  }
  else{
    delContactButtons.forEach(button => {
      button.classList.remove('d-none')
    });
  }
}

function cloneContact(){
  contactNumber++;

  const newContact = referenceContainer.cloneNode(true);

  const newDeleteContactButton = newContact.querySelector(".delete-contact");
  newDeleteContactButton.classList.remove('d-none');
  newDeleteContactButton.addEventListener("click", function(){
    newContact.remove();
    maskButton();
  });

  const newIdInput = newContact.querySelector('#'+idInput.getAttribute("id"));
  newIdInput.setAttribute("id", idInput.getAttribute("id").slice(0, -1) + contactNumber);
  newIdInput.value = -1;
  newIdInput.classList.remove('is-valid');
  newIdInput.classList.remove('is-invalid');

  const newFirstnameInput = newContact.querySelector('#'+firstnameInput.getAttribute("id"));
  newFirstnameInput.setAttribute("id", firstnameInput.getAttribute("id").slice(0, -1) + contactNumber);
  newFirstnameInput.value = "";
  newFirstnameInput.classList.remove('is-valid');
  newFirstnameInput.classList.remove('is-invalid');
  const newFirstnameLabel = newContact.querySelector('#'+firstnameLabel.getAttribute("id"));
  newFirstnameLabel.setAttribute("id", newFirstnameLabel.getAttribute("id").slice(0, -1) + contactNumber);
  newFirstnameLabel.setAttribute("for", newFirstnameInput.getAttribute("id"));

  const newlastnameInput = newContact.querySelector('#'+lastnameInput.getAttribute("id"));
  newlastnameInput.setAttribute("id", newlastnameInput.getAttribute("id").slice(0, -1) + contactNumber);
  newlastnameInput.value = "";
  newlastnameInput.classList.remove('is-valid');
  newlastnameInput.classList.remove('is-invalid');
  const newlastnameLabel = newContact.querySelector('#'+lastnameLabel.getAttribute("id"));
  newlastnameLabel.setAttribute("id", newlastnameLabel.getAttribute("id").slice(0, -1) + contactNumber);
  newlastnameLabel.setAttribute("for", newlastnameInput.getAttribute("id"));

  const newJobInput = newContact.querySelector('#'+jobInput.getAttribute("id"));
  newJobInput.setAttribute("id", newJobInput.getAttribute("id").slice(0, -1) + contactNumber);
  newJobInput.value = "";
  newJobInput.classList.remove('is-valid');
  newJobInput.classList.remove('is-invalid');
  const newJobLabel = newContact.querySelector('#'+jobLabel.getAttribute("id"));
  newJobLabel.setAttribute("id", newJobLabel.getAttribute("id").slice(0, -1) + contactNumber);
  newJobLabel.setAttribute("for", newJobInput.getAttribute("id"));

  const newEmailInput = newContact.querySelector('#'+emailInput.getAttribute("id"));
  newEmailInput.setAttribute("id", newEmailInput.getAttribute("id").slice(0, -1) + contactNumber);
  newEmailInput.value = "";
  newEmailInput.classList.remove('is-valid');
  newEmailInput.classList.remove('is-invalid');
  const newEmailLabel = newContact.querySelector('#'+emailLabel.getAttribute("id"));
  newEmailLabel.setAttribute("id", newEmailLabel.getAttribute("id").slice(0, -1) + contactNumber);
  newEmailLabel.setAttribute("for", newEmailInput.getAttribute("id"));

  const newTelIdInputA = newContact.querySelector('#'+telIdInputA.getAttribute("id"));
  newTelIdInputA.setAttribute("id", telIdInputA.getAttribute("id").slice(0, -1) + contactNumber);
  newTelIdInputA.value = -1;
  newTelIdInputA.classList.remove('is-valid');
  newTelIdInputA.classList.remove('is-invalid');

  const newTelIdInputB = newContact.querySelector('#'+telIdInputB.getAttribute("id"));
  newTelIdInputB.setAttribute("id", telIdInputB.getAttribute("id").slice(0, -1) + contactNumber);
  newTelIdInputB.value = -1;
  newTelIdInputB.classList.remove('is-valid');
  newTelIdInputB.classList.remove('is-invalid');

  const newtelTypeInputA = newContact.querySelector('#'+telTypeInputA.getAttribute("id"));
  newtelTypeInputA.setAttribute("id", newtelTypeInputA.getAttribute("id").slice(0, -1) + contactNumber);
  newtelTypeInputA.value = "desktop";
  const newtelTypeLabelA = newContact.querySelector('#'+telTypeLabelA.getAttribute("id"));
  newtelTypeLabelA.setAttribute("id", newtelTypeLabelA.getAttribute("id").slice(0, -1) + contactNumber);
  newtelTypeLabelA.setAttribute("for", newtelTypeInputA.getAttribute("id"));

  const newtelTypeInputB = newContact.querySelector('#'+telTypeInputB.getAttribute("id"));
  newtelTypeInputB.setAttribute("id", newtelTypeInputB.getAttribute("id").slice(0, -1) + contactNumber);
  newtelTypeInputB.value = "desktop";
  const newtelTypeLabelB = newContact.querySelector('#'+telTypeLabelB.getAttribute("id"));
  newtelTypeLabelB.setAttribute("id", newtelTypeLabelB.getAttribute("id").slice(0, -1) + contactNumber);
  newtelTypeLabelB.setAttribute("for", newtelTypeInputB.getAttribute("id"));

  const newtelnumberInputA = newContact.querySelector('#'+telnumberInputA.getAttribute("id"));
  newtelnumberInputA.setAttribute("id", newtelnumberInputA.getAttribute("id").slice(0, -1) + contactNumber);
  newtelnumberInputA.value = "";
  newtelnumberInputA.classList.remove('is-valid');
  newtelnumberInputA.classList.remove('is-invalid');
  const newtelNumberLabelA = newContact.querySelector('#'+telNumberLabelA.getAttribute("id"));
  newtelNumberLabelA.setAttribute("id", newtelNumberLabelA.getAttribute("id").slice(0, -1) + contactNumber);
  newtelNumberLabelA.setAttribute("for", newtelnumberInputA.getAttribute("id"));

  const newtelnumberInputB = newContact.querySelector('#'+telnumberInputB.getAttribute("id"));
  newtelnumberInputB.setAttribute("id", newtelnumberInputB.getAttribute("id").slice(0, -1) + contactNumber);
  newtelnumberInputB.value = "";
  newtelnumberInputB.classList.remove('is-valid');
  newtelnumberInputB.classList.remove('is-invalid');
  const newtelNumberLabelB = newContact.querySelector('#'+telNumberLabelB.getAttribute("id"));
  newtelNumberLabelB.setAttribute("id", newtelNumberLabelB.getAttribute("id").slice(0, -1) + contactNumber);
  newtelNumberLabelB.setAttribute("for", newtelnumberInputB.getAttribute("id"));

  const newtelExtensionInputA = newContact.querySelector('#'+telExtensionInputA.getAttribute("id"));
  newtelExtensionInputA.setAttribute("id", newtelExtensionInputA.getAttribute("id").slice(0, -1) + contactNumber);
  newtelExtensionInputA.value = "";
  newtelExtensionInputA.classList.remove('is-valid');
  newtelExtensionInputA.classList.remove('is-invalid');
  const newtelExtensionLabelA = newContact.querySelector('#'+telExtensionLabelA.getAttribute("id"));
  newtelExtensionLabelA.setAttribute("id", newtelExtensionLabelA.getAttribute("id").slice(0, -1) + contactNumber);
  newtelExtensionLabelA.setAttribute("for", newtelExtensionInputA.getAttribute("id"));

  const newtelExtensionInputB = newContact.querySelector('#'+telExtensionInputB.getAttribute("id"));
  newtelExtensionInputB.setAttribute("id", newtelExtensionInputB.getAttribute("id").slice(0, -1) + contactNumber);
  newtelExtensionInputB.value = "";
  newtelExtensionInputB.classList.remove('is-valid');
  newtelExtensionInputB.classList.remove('is-invalid');
  const newtelExtensionLabelB = newContact.querySelector('#'+telExtensionLabelB.getAttribute("id"));
  newtelExtensionLabelB.setAttribute("id", newtelExtensionLabelB.getAttribute("id").slice(0, -1) + contactNumber);
  newtelExtensionLabelB.setAttribute("for", newtelExtensionInputB.getAttribute("id"));

  newContact.querySelectorAll('.valid-feedback').forEach(element => {
    element.style.display = "none";
  });
  newContact.querySelectorAll('.invalid-feedback').forEach(element => {
    element.style.display = "none";
  });

  contactsRow.append(newContact);
  getContactSectionChangingElements();
  maskButton();
}