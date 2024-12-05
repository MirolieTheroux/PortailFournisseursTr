document.addEventListener("DOMContentLoaded", function () {
  addContactsValidationListeners();
});

function addContactsValidationListeners(){
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
  const invalidRequiredMessage = parentDiv.querySelector('.jobInvalidRequired');

  // Reset all error messages
  invalidRequiredMessage.style.display = 'none';

  // Basic validation logic
  if (!input.value) {
    input.classList.remove('is-valid');
  }
  else {
    input.classList.remove('is-invalid');
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

function validateContactsAll(){
  addContactsValidationListeners();
  const inputs = document.querySelectorAll(".contact-input");
  const oninput = new Event('input');

  inputs.forEach(input => {
    input.dispatchEvent(oninput);
  });
}
