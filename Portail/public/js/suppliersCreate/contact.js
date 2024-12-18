/*** Section operation ***/
document.addEventListener('DOMContentLoaded', function() {
  addCustomListener();
  let contactNumber = 1;
  const contactsRow = document.getElementById('contactsRow');
  const referenceContainer = document.getElementById('referenceContact');

  const addContactButton = document.querySelector('.add-contact');
  addContactButton.addEventListener("click", cloneContact);

  const delContactButton = referenceContainer.querySelector('.delete-contact');
  delContactButton.addEventListener("click", function(){
    referenceContainer.remove();
    maskButton();
  });
  maskButton();

  const subtitle = contactsRow.querySelector('#contactSubtitle1');
  const firstnameInput = contactsRow.querySelector('#contactFirstName1');
  const firstnameLabel = contactsRow.querySelector('#contactFirstNameLabel1');
  const lastnameInput = contactsRow.querySelector('#contactLastName1');
  const lastnameLabel = contactsRow.querySelector('#contactLastNameLabel1');
  const jobInput = contactsRow.querySelector('#contactJob1');
  const jobLabel = contactsRow.querySelector('#contactJobLabel1');
  const emailInput = contactsRow.querySelector('#contactEmail1');
  const emailLabel = contactsRow.querySelector('#contactEmailLabel1');
  const telTypeInputA = contactsRow.querySelector('#contactTelTypeA1');
  const telTypeLabelA = contactsRow.querySelector('#contactTelTypeLabelA1');
  const telTypeInputB = contactsRow.querySelector('#contactTelTypeB1');
  const telTypeLabelB = contactsRow.querySelector('#contactTelTypeLabelB1');
  const telnumberInputA = contactsRow.querySelector('#contactTelNumberA1');
  const telNumberLabelA = contactsRow.querySelector('#contactTelNumberLabelA1');
  const telnumberInputB = contactsRow.querySelector('#contactTelNumberB1');
  const telNumberLabelB = contactsRow.querySelector('#contactTelNumberLabelB1');
  const telExtensionInputA = contactsRow.querySelector('#contactTelExtensionA1');
  const telExtensionLabelA = contactsRow.querySelector('#contactTelExtensionLabelA1');
  const telExtensionInputB = contactsRow.querySelector('#contactTelExtensionB1');
  const telExtensionLabelB = contactsRow.querySelector('#contactTelExtensionLabelB1');

  function cloneContact(){
    contactNumber++;

    const newContact = referenceContainer.cloneNode(true);

    const newDeleteContactButton = newContact.querySelector(".delete-contact");
    newDeleteContactButton.classList.remove('d-none');
    newDeleteContactButton.addEventListener("click", function(){
      newContact.remove();
      maskButton();
    });

    const newSubtitle = newContact.querySelector('#' + subtitle.getAttribute("id"));
    newSubtitle.setAttribute("id", newSubtitle.getAttribute("id").slice(0, -1) + contactNumber);

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

    const newtelTypeInputA = newContact.querySelector('#'+telTypeInputA.getAttribute("id"));
    newtelTypeInputA.setAttribute("id", newtelTypeInputA.getAttribute("id").slice(0, -1) + contactNumber);
    newtelTypeInputA.value = desktopString;
    const newtelTypeLabelA = newContact.querySelector('#'+telTypeLabelA.getAttribute("id"));
    newtelTypeLabelA.setAttribute("id", newtelTypeLabelA.getAttribute("id").slice(0, -1) + contactNumber);
    newtelTypeLabelA.setAttribute("for", newtelTypeInputA.getAttribute("id"));

    const newtelTypeInputB = newContact.querySelector('#'+telTypeInputB.getAttribute("id"));
    newtelTypeInputB.setAttribute("id", newtelTypeInputB.getAttribute("id").slice(0, -1) + contactNumber);
    newtelTypeInputB.value = desktopString;
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
    maskButton();
    
    addCustomListener();
  }

  function maskButton(){
    let delContactButtons = document.querySelectorAll('.delete-contact');
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

});

/*** Validation ***/
function addCustomListener(){
  const nameInputs = document.querySelectorAll('.contact-name-input');
  nameInputs.forEach(input => {
    input.addEventListener('input', (event)=>{
      validateContactsName(input.id);
    })
  });

  const jobInputs = document.querySelectorAll('.contact-job-input');
  jobInputs.forEach(input => {
    input.addEventListener('input', (event)=>{
      validateContactsJob(input.id);
    })
  });

  const emailInputs = document.querySelectorAll('.contact-email-input');
  emailInputs.forEach(input => {
    input.addEventListener('input', (event)=>{
      validateContactsEmail(input.id);
    })
  });

  const primaryPhoneInputs = document.querySelectorAll('.contact-primary-phone-input');
  primaryPhoneInputs.forEach(input => {
    input.addEventListener('input', (event)=>{
      validateContactsPrimaryPhone(input.id);
    });
    input.addEventListener('paste', (event)=>{
      // Get the pasted data from the clipboard
      const pasteData = (event.clipboardData || window.clipboardData).getData('text');
      
      if (/\D/.test(pasteData)) {
        event.preventDefault();
      }
    });
  });

  const secondaryPhoneInputs = document.querySelectorAll('.contact-secondary-phone-input');
  secondaryPhoneInputs.forEach(input => {
    input.addEventListener('input', (event)=>{
      let index = input.id.replace("contactTelNumberB", '');
      validateContactsSecondaryPhone(index);
    });
    input.addEventListener('paste', (event)=>{
      // Get the pasted data from the clipboard
      const pasteData = (event.clipboardData || window.clipboardData).getData('text');
      
      if (/\D/.test(pasteData)) {
        event.preventDefault();
      }
    });
  });

  const extensionInputs = document.querySelectorAll('.contact-extension-input');
  extensionInputs.forEach(input => {
    input.addEventListener('input', (event)=>{
      validateContactsExtension(input.id);
      if (input.id.startsWith("contactTelExtensionB")){
        let index = input.id.replace("contactTelExtensionB", '');
        validateContactsSecondaryPhone(index);
      }
    })
  });
}

function validateContactsName(id) {
  const input = document.getElementById(id);
  const parentDiv = input.parentElement;
  const invalidRequiredMessage = parentDiv.querySelector('.nameInvalidRequired');
  const invalidSymbolsMessage = parentDiv.querySelector('.nameInvalidSymbols');

  const regex = /^[a-zA-ZÀ-ÿ\'\-]+$/g;

  // Reset all error messages
  invalidRequiredMessage.style.display = 'none';
  invalidSymbolsMessage.style.display = 'none';

  // Basic validation logic
  if (!input.value) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidRequiredMessage.style.display = 'block';
  }
  else if(!input.value.match(regex)){
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidSymbolsMessage.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }

  input.classList.add('was-validated');
}

function validateContactsJob(id) {
  const input = document.getElementById(id);
  const parentDiv = input.parentElement;

  // Reset all error messages

  // Basic validation logic
  if (!input.value) {
    input.classList.remove('is-valid');
  }
  else {
    input.classList.add('is-valid');
  }

  input.classList.add('was-validated');
}

function validateContactsEmail(id) {
  const input = document.getElementById(id);
  const parentDiv = input.parentElement;
  const invalidRequiredMessage = parentDiv.querySelector('.emailInvalidRequired');
  const invalidFormatMessage = parentDiv.querySelector('.emailInvalidFormat');

  const regex = /^([-!#-'*+/-9=?A-Z^-~]+(\.[-!#-'*+/-9=?A-Z^-~]+)*|"([]!#-[^-~ \t]|(\\[\t -~]))+")@[0-9A-Za-z]([0-9A-Za-z-]{0,61}[0-9A-Za-z])?(\.[0-9A-Za-z]([0-9A-Za-z-]{0,61}[0-9A-Za-z])?)+$/g;

  // Reset all error messages
  invalidRequiredMessage.style.display = 'none';
  invalidFormatMessage.style.display = 'none';

  // Basic validation logic
  if (!input.value) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidRequiredMessage.style.display = 'block';
  }
  else if (!input.value.match(regex)) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidFormatMessage.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }

  input.classList.add('was-validated');
}

function validateContactsPrimaryPhone(id) {
  const input = document.getElementById(id);
  const parentDiv = input.closest(".phone-container");
  const invalidRequiredMessage = parentDiv.querySelector('.phoneInvalidRequired');
  const invalidNumberMessage = parentDiv.querySelector('.phoneInvalidNumber');
  const invalidSizeMessage = parentDiv.querySelector('.phoneInvalidSize');

  // Reset all error messages
  invalidRequiredMessage.style.display = 'none';
  invalidNumberMessage.style.display = 'none';
  invalidSizeMessage.style.display = 'none';

  if (/\D/.test(input.value)) {
    input.value = input.value.replace(/\D/g, '');
  }
  
  const phoneValue = input.value.replace(/-/g, '');

  if (phoneValue.length > 6) {
    input.value = `${phoneValue.slice(0, 3)}-${phoneValue.slice(3, 6)}-${phoneValue.slice(6)}`;
  } else if (phoneValue.length > 3) {
    input.value = `${phoneValue.slice(0, 3)}-${phoneValue.slice(3)}`;
  }

  // Basic validation logic
  if (!phoneValue) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidRequiredMessage.style.display = 'block';
  }
  else if(isNaN(phoneValue)){
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidNumberMessage.style.display = 'block';
  }
  else if(phoneValue.length !== 10){
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidSizeMessage.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }

  input.classList.add('was-validated');
}

function validateContactsSecondaryPhone(id) {
  const input = document.getElementById("contactTelNumberB"+id);
  const phoneExtension = document.getElementById("contactTelExtensionB"+id);
  const parentDiv = input.closest(".phone-container");
  const invalidNumberMessage = parentDiv.querySelector('.phoneInvalidNumber');
  const invalidSizeMessage = parentDiv.querySelector('.phoneInvalidSize');
  const invalidRequiredMessage = parentDiv.querySelector('.phoneInvalidRequired');
  // Reset all error messages
  invalidNumberMessage.style.display = 'none';
  invalidSizeMessage.style.display = 'none';
  invalidRequiredMessage.style.display = 'none';

  if (/\D/.test(input.value)) {
    input.value = input.value.replace(/\D/g, '');
  }

  const phoneValue = input.value.replace(/-/g, '');

  if (phoneValue.length > 6) {
    input.value = `${phoneValue.slice(0, 3)}-${phoneValue.slice(3, 6)}-${phoneValue.slice(6)}`;
  } else if (phoneValue.length > 3) {
    input.value = `${phoneValue.slice(0, 3)}-${phoneValue.slice(3)}`;
  }

  // Basic validation logic
  if (!phoneValue && phoneExtension.value) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidRequiredMessage.style.display = 'block';
  }
  else if (!phoneValue) {
    input.classList.remove('is-valid');
    input.classList.remove('is-invalid');
  }
  else if(isNaN(phoneValue)){
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidNumberMessage.style.display = 'block';
  }
  else if (phoneValue.length === 0) {
    input.classList.remove('is-invalid');
    input.classList.remove('is-valid');
  }
  else if(phoneValue.length !== 10){
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidSizeMessage.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }

  input.classList.add('was-validated');
}

function validateContactsExtension(id) {
  const input = document.getElementById(id);
  const parentDiv = input.closest(".phone-container");
  const invalidNumberMessage = parentDiv.querySelector('.phoneInvalidExtension');
  // Reset all error messages
  invalidNumberMessage.style.display = 'none';

  // Basic validation logic
  if (isNaN(input.value)) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidNumberMessage.style.display = 'block';
  }
  else if(!input.value){
    input.classList.remove('is-invalid');
    input.classList.remove('is-valid');
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }

  input.classList.add('was-validated');
}

const contactsSectionNext = document.getElementById("contacts-button");
contactsSectionNext.addEventListener("click", (event)=>{
  validateContactsAll();
});

function validateContactsAll(){
    const inputs = document.querySelectorAll(".contact-input");
    const oninput = new Event('input');

    inputs.forEach(input => {
      input.dispatchEvent(oninput);
    });
}