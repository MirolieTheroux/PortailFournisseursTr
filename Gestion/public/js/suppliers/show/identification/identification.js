const invalidStartNeq = document.getElementById("neqInvalidStart");
const invalidCharacters = document.getElementById("neqInvalidCharacters");
const invalidAmount = document.getElementById("neqInvalidAmount");
const invalidExist = document.getElementById("neqInvalidExist");
const startName = document.getElementById("nameStart");
const validName = document.getElementById("nameValid");
const invalidEmptyName = document.getElementById("nameInvalidEmpty");
const invalidEmptyEmail = document.getElementById("emailInvalidEmpty");
const invalidStartEmail = document.getElementById("emailInvalidStart");
const invalidNoArobase = document.getElementById("emailInvalidNoArobase");
const invalidManyArobase = document.getElementById("emailInvalidManyArobase");
const invalidEmptyDomain = document.getElementById("emailInvalidEmptyDomain");
const invalidDomainFormat = document.getElementById("emailInvalidDomainFormat");
const invalidDomainDot = document.getElementById("emailInvalidDomainDot");
const emailInvalidUnique = document.getElementById("emailInvalidUnique");
const neqInput = document.getElementById("neq");

const formIdentification = document.querySelector("#identification-section form");
const formControlsIdentification = document.querySelectorAll('#identification-section .form-control');

//--IDENTIFICATION--//
const idBtnCancel = document.getElementById("btnCancelId");
const idBtnModify = document.getElementById("btnModifyId"); 
const idBtnSave = document.getElementById("btnSaveId"); 
const neq = document.getElementById("neq");
const companyName = document.getElementById("name");
const email = document.getElementById("email");
const oldNeqValue = neq.value;
const oldCompanyNameValue = companyName.value;
const oldEmailValue = email.value;
//Btn annuler
idBtnCancel.addEventListener("click" , ()=>{
  idBtnModify.classList.remove("d-none");
  idBtnCancel.classList.add("d-none");
  idBtnSave.classList.add("d-none");
  neq.setAttribute("disabled","");
  companyName.setAttribute("disabled","");
  email.setAttribute("disabled","");
  neq.value = oldNeqValue;
  companyName.value = oldCompanyNameValue;
  email.value = oldEmailValue;
  removeNeqErrorMessagesAndClasses();
  removeCompanyEmailErrorMessagesAndClasses();
  removeCompanyEmailErrorMessagesAndClasses();
});
//Btn Modifier
idBtnModify.addEventListener("click", ()=>{
  idBtnCancel.classList.remove("d-none");
  idBtnSave.classList.remove("d-none");
  idBtnModify.classList.add("d-none");
  neq.removeAttribute("disabled");
  companyName.removeAttribute("disabled");
  email.removeAttribute("disabled");
});
//Btn Enregistrer
idBtnSave.addEventListener("click", () => {
  idBtnCancel.classList.add("d-none");
  idBtnSave.classList.add("d-none");
  idBtnModify.classList.add("d-none");
});

function removeNeqErrorMessagesAndClasses(){
  invalidStartNeq.style.display = "none";
  invalidCharacters.style.display = "none";
  invalidAmount.style.display = "none";
  invalidExist.style.display = "none";
  neqInput.classList.remove("is-invalid");
  neqInput.classList.remove("is-valid");
}
function removeCompanyNameErrorMessagesAndClasses(){
  startName.style.display = "none";
  validName.style.display = "none";
  invalidEmpty.style.display = "none";
  nameInput.classList.remove("is-valid");
  nameInput.classList.remove("is-invalid");
}  
function removeCompanyEmailErrorMessagesAndClasses(){
  invalidEmptyEmail.style.display = "none";
  invalidStartEmail.style.display = "none";
  invalidNoArobase.style.display = "none";
  invalidManyArobase.style.display = "none";
  invalidEmptyDomain.style.display = "none";
  invalidDomainFormat.style.display = "none";
  invalidDomainDot.style.display = "none";
  emailInvalidUnique.style.display = "none";
  emailInput.classList.remove("is-valid");
  emailInput.classList.remove("is-invalid");
}

//VALIDATIONS
neqInput.addEventListener("input", validateIdentificationNeq);

function validateIdentificationNeq() {
  // Reset all error messages
  invalidStartNeq.style.display = "none";
  invalidCharacters.style.display = "none";
  invalidAmount.style.display = "none";
  invalidExist.style.display = "none";
  
  // Basic validation logic
  if (!neqInput.value) {
    neqInput.classList.remove("is-invalid");
    neqInput.classList.remove("is-valid");
  }
  else if (!neqInput.value.match(/^11|22|33|88/)) {
    neqInput.classList.remove("is-valid");
    neqInput.classList.add("is-invalid");
    invalidStartNeq.style.display = "block";
  }
  else if (neqInput.value.match(/\D/)) {
    neqInput.classList.remove("is-valid");
    neqInput.classList.add("is-invalid");
    invalidCharacters.style.display = "block";
  }
  else if (neqInput.value.length !== 10) {
    neqInput.classList.remove("is-valid");
    neqInput.classList.add("is-invalid");
    invalidAmount.style.display = "block";
  }
  else {
    neqInput.classList.remove("is-invalid");
    neqInput.classList.add("is-valid");
  }

  if (neqInput.classList.contains("is-valid")) {
    checkNeqUnique(neqInput.value).then(neqExist => {
      if (neqExist) {
        neqInput.classList.remove("is-valid");
        neqInput.classList.add("is-invalid");
        invalidExist.style.display = "block";
      }
    });
  }

  neqInput.classList.add("was-validated");
};

const nameInput = document.getElementById("name");
nameInput.addEventListener("input", validateIdentificationName);

function validateIdentificationName() {
  // Reset all error messages
  startName.style.display = "none";
  validName.style.display = "none";
  invalidEmptyName.style.display = "none";
  
  // Basic validation logic
  if (!nameInput.value) {
    nameInput.classList.remove("is-valid");
    nameInput.classList.add("is-invalid");
    invalidEmptyName.style.display = "block";
  }
  else {
    nameInput.classList.remove("is-invalid");
    nameInput.classList.add("is-valid");
    valid.style.display = "block";
  }
  
  nameInput.classList.add("was-validated");
};

const emailInput = document.getElementById("email");
emailInput.addEventListener("input", validateIdentificationEmail);

function validateIdentificationEmail() {
  // Reset all error messages
  invalidEmptyEmail.style.display = "none";
  invalidStartEmail.style.display = "none";
  invalidNoArobase.style.display = "none";
  invalidManyArobase.style.display = "none";
  invalidEmptyDomain.style.display = "none";
  invalidDomainFormat.style.display = "none";
  invalidDomainDot.style.display = "none";
  emailInvalidUnique.style.display = "none";
  
  // Basic validation logic
  if (!emailInput.value) {
    emailInput.classList.remove("is-valid");
    emailInput.classList.add("is-invalid");
    invalidEmptyEmail.style.display = "block";
  }
  else if (emailInput.value.match(/^@/)) {
    emailInput.classList.remove("is-valid");
    emailInput.classList.add("is-invalid");
    invalidStartEmail.style.display = "block";
  }
  else if (!emailInput.value.match(/@/)) {
    emailInput.classList.remove("is-valid");
    emailInput.classList.add("is-invalid");
    invalidNoArobase.style.display = "block";
  }
  else if (emailInput.value.match(/@.*@/)) {
    emailInput.classList.remove("is-valid");
    emailInput.classList.add("is-invalid");
    invalidManyArobase.style.display = "block";
  }
  else if (emailInput.value.match(/@$/)) {
    emailInput.classList.remove("is-valid");
    emailInput.classList.add("is-invalid");
    invalidEmptyDomain.style.display = "block";
  }
  else if (!emailInput.value.match(/@.*\./)){
    emailInput.classList.remove("is-valid");
    emailInput.classList.add("is-invalid");
    invalidDomainFormat.style.display = "block";
  }
  else if (emailInput.value.match(/(@\.)|(\.$)/)){
    emailInput.classList.remove("is-valid");
    emailInput.classList.add("is-invalid");
    invalidDomainDot.style.display = "block";
  }
  else {
    emailInput.classList.remove("is-invalid");
    emailInput.classList.add("is-valid");
  }

  emailInput.classList.add("was-validated");
};


formIdentification.addEventListener("submit", (event)=>{validateIdentificationAll(event);});

async function validateIdentificationAll(event){
  let isFormInvalid = false;

  if(neqInput.classList.contains("is-valid")) {
    const neqExist = await checkNeqUnique(neqInput.value);
    if (neqExist) {
      isFormInvalid = true;
    }
  }

  if(emailInput.classList.contains("is-valid")) {
    const emailExist = await checkEmailUnique(emailInput.value, neqInput.value);
    if (emailExist) {
      isFormInvalid = true;
    }
  }

  formControlsIdentification.forEach(input => {
    if(input.classList.contains("is-invalid"))
      isFormInvalid = true;
  });

  if(isFormInvalid) {
    event.preventDefault();
  }
}

neqInput.addEventListener("blur", async () => {
  console.log("ici neq");
  if (neqInput.classList.contains("is-valid")) {
    console.log("valeur neq", neqInput.value);
    let neqExist = await checkNeqUnique("1140000119");
    console.log(neqExist);
    if (neqExist) {
      neqInput.classList.remove("is-valid");
      neqInput.classList.add("is-invalid");
      invalidExist.style.display = "block";
    } else {
      neqInput.classList.remove("is-invalid");
      neqInput.classList.add("is-valid");
    }
  }
});

emailInput.addEventListener("blur", async () => {
  console.log("ici email");
  if (emailInput.classList.contains("is-valid")) {
    console.log("valeur email", emailInput.value);
    let emailExist = await checkEmailUnique(emailInput.value, neqInput.value);
    console.log(emailExist);
    if (emailExist) {
      emailInput.classList.remove("is-valid");
      emailInput.classList.add("is-invalid");
      emailInvalidUnique.style.display = "block";
    } else {
      emailInput.classList.remove("is-invalid");
      emailInput.classList.add("is-valid");
    }
  }
});

async function checkEmailUnique(email, neq){
  const response = await fetch('/suppliers/checkEmail', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('[name="_token"]').getAttribute('value')
    },        
    body: JSON.stringify({ email: email, neq: neq })
  })
  console.log("email",response);
  const data = await response.json();
  return data.exists;
}

async function checkNeqUnique(neq){
  const response = await fetch('/suppliers/checkNeq', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('[name="_token"]').getAttribute('value')
    },        
    body: JSON.stringify({ neq: neq })
  })
  console.log("neq",response);
  const data = await response.json();
  console.log(data);
  return data.exists;
}