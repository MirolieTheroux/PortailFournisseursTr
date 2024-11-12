const regexAlphanum = /^[-a-zA-Z0-9]+$/;
let contactDetailsCivicNumberInput;
let contactDetailsStreetNameInput;
let contactDetailsOfficeNumberInput;
let contactDetailsCityInput;
let contactDetailsPostalCodeInput;
let contactDetailsWebsiteInput;
let contactDetailsPhoneNumberInput;
let contactDetailsPhoneExtensionInput;

document.addEventListener("DOMContentLoaded", function () {
  const buttonsDelete = document.querySelectorAll(".removePhone");
  buttonsDelete.forEach(button => {
    const conteneurButton = button.closest(".divPhone");
    button.addEventListener("click", () => {
      conteneurButton.remove();
    });
  });
  addCitiesAndDAInSelect();
  validateSelectCity();
  addContactDetailsValidationListeners();
});

function addContactDetailsValidationListeners() {
  contactDetailsCivicNumberInput = document.getElementById('contactDetailsCivicNumber');
  contactDetailsCivicNumberInput.addEventListener('input', validateCivicNumber);

  contactDetailsStreetNameInput = document.getElementById('contactDetailsStreetName');
  contactDetailsStreetNameInput.addEventListener('input', validateStreetName);

  contactDetailsOfficeNumberInput = document.getElementById('contactDetailsOfficeNumber');
  contactDetailsOfficeNumberInput.addEventListener('input', validateOfficeNumber);

  contactDetailsCityInput = document.getElementById('contactDetailsInputCity');
  contactDetailsCityInput.addEventListener('input', validateCity);

  contactDetailsPostalCodeInput = document.getElementById('contactDetailsPostalCode');
  contactDetailsPostalCodeInput.addEventListener('input', validatePostalCodeOnInput);
  contactDetailsPostalCodeInput.addEventListener('paste', (event) => {
    const pasteData = (event.clipboardData || window.clipboardData).getData('text');
    event.preventDefault();
  });

  contactDetailsWebsiteInput = document.getElementById('contactDetailsWebsite');
  contactDetailsWebsiteInput.addEventListener('blur', validateWebsite);

  contactDetailsPhoneNumberInput = document.getElementById('contactDetailsPhoneNumber');
  contactDetailsPhoneNumberInput.addEventListener('input', validatePhoneNumber);
  contactDetailsPhoneNumberInput.addEventListener('paste', (event) => {
    const pasteData = (event.clipboardData || window.clipboardData).getData('text');
    if (/\D/.test(pasteData)) {
      event.preventDefault(); 
    }
  });

  contactDetailsPhoneExtensionInput = document.getElementById('contactDetailsPhoneExtension');
  contactDetailsPhoneExtensionInput.addEventListener('input', validatePhoneNumber);
}

function validateCivicNumber() {
  const input = document.getElementById("contactDetailsCivicNumber");
  const invalidRequiredCivicNumber = document.getElementById("invalidRequiredCivicNumber" );
  const invalidCivicNumber = document.getElementById("invalidCivicNumber");
  const invalidCivicNumberLength = document.getElementById("invalidCivicNumberLength");

  // Reset all error messages
  invalidRequiredCivicNumber.style.display = "none";
  invalidCivicNumber.style.display = "none";
  invalidCivicNumberLength.style.display = "none";
  // Basic validation logic
  if (!input.value) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidRequiredCivicNumber.style.display = "block";
  } else if (!regexAlphanum.test(input.value)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidCivicNumber.style.display = "block";
  } else if (input.value.length > 8) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidCivicNumberLength.style.display = "block";
  } else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add("was-validated");
}

function validateStreetName() {
  const regexAlphanumAndSpecialCar = /^[a-zA-Z0-9\'\,\-_À-ÿ ]+$/;
  const input = document.getElementById("contactDetailsStreetName");
  const invalidRequiredStreetName = document.getElementById("invalidRequiredStreetName");
  const invalidStreetName = document.getElementById("invalidStreetName");
  const invalidStreetNameLength = document.getElementById("invalidStreetNameLength");

  // Reset all error messages
  invalidRequiredStreetName.style.display = "none";
  invalidStreetName.style.display = "none";
  invalidStreetNameLength.style.display = "none";
  // Basic validation logic
  if (!input.value) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidRequiredStreetName.style.display = "block";
  } else if (!regexAlphanumAndSpecialCar.test(input.value)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidStreetName.style.display = "block";
  } else if (input.value.length > 64) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidStreetNameLength.style.display = "block";
  } else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add("was-validated");
}

function validateOfficeNumber() {
  const input = document.getElementById("contactDetailsOfficeNumber");
  const invalidOfficeNumber = document.getElementById("invalidOfficeNumber");
  const invalidOfficeNumberLength = document.getElementById("invalidOfficeNumberLength");

  // Reset all error messages
  invalidOfficeNumber.style.display = "none";
  invalidOfficeNumberLength.style.display = "none";
  // Basic validation logic
  if (!regexAlphanum.test(input.value) && input.value !== "") {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidOfficeNumber.style.display = "block";
  } else if (input.value.length > 8 && input.value) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidOfficeNumberLength.style.display = "block";
  } else if (!input.value) {
    input.classList.remove("is-invalid");
    input.classList.remove("is-valid");
  } else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add("was-validated");
}

function validateCity() {
  const inputCity = document.getElementById("contactDetailsInputCity");
  const invalidRequiredCity = document.getElementById("invalidRequiredCity");
  const invalidCityLength = document.getElementById("invalidCityLength");

  // Reset all error messages
  invalidRequiredCity.style.display = "none";
  invalidCityLength.style.display = "none";
  // Basic validation logic
  if (!inputCity.value && !inputCity.classList.contains("d-none")) {
    inputCity.classList.remove("is-valid");
    inputCity.classList.add("is-invalid");
    invalidRequiredCity.style.display = "block";
  } else if (inputCity.value.length > 64) {
    inputCity.classList.remove("is-valid");
    inputCity.classList.add("is-invalid");
    invalidCityLength.style.display = "block";
  }else{
    inputCity.classList.remove("is-invalid");
    inputCity.classList.add("is-valid");
  }
  inputCity.classList.add("was-validated");
}

function validateSelectCity(){
  const inputCity = document.getElementById("contactDetailsInputCity");
  const province = document.getElementById("contactDetailsProvince");
  province.addEventListener("change", () => {
    if (province.value === "Québec") {
      document.getElementById("invalidRequiredCity").style.display = "none";
      inputCity.classList.remove("is-invalid");
    }
    else{
      if(inputCity.value === "")
        inputCity.classList.remove("is-valid");
    }
  });
}

function validatePostalCodeOnInput() {
  const regexFullCP = /^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/;
  const input = document.getElementById("contactDetailsPostalCode");
  const invalidRequiredPostalCode = document.getElementById("invalidRequiredPostalCode");
  const invalidPostalCodeFormat = document.getElementById("invalidPostalCodeFormat");
  const invalidPostalCodeLength = document.getElementById("invalidPostalCodeLength");

  // Reset all error messages
  invalidRequiredPostalCode.style.display = "none";
  invalidPostalCodeFormat.style.display = "none";
  invalidPostalCodeLength.style.display = "none";


  if (/[^a-zA-Z0-9]/.test(input.value)) {
    input.value = input.value.replace(/[^a-zA-Z0-9]/g, '');
  }

  input.value = input.value.toUpperCase();
  const pcValue = input.value.replace(' ', '');

  if (pcValue.length > 3) {
    input.value = `${pcValue.slice(0, 3)} ${pcValue.slice(3)}`;
  }
  // Basic validation logic
  if (!pcValue) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidRequiredPostalCode.style.display = "block";
  } else if (pcValue.length === 1 && !/^[A-Za-z]$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 2 && !/^[A-Za-z]\d$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 3 && !/^[A-Za-z]\d[A-Za-z]$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 4 && !/^[A-Za-z]\d[A-Za-z]\d$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 5 && !/^[A-Za-z]\d[A-Za-z]\d[A-Za-z]$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 6 && !regexFullCP.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length !== 6) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeLength.style.display = "block";
  } else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add("was-validated");
}

function validateWebsite() {
  const urlRegex = /^(www\.)?([a-zA-Z0-9.-]+)(\.[a-zA-Z]{2,})(\/[^\s]*)?$/;
  const input = document.getElementById("contactDetailsWebsite");
  const invalidWebsite = document.getElementById("invalidWebsite");
  const invalidWebsiteLength = document.getElementById("invalidWebsiteLength");

  // Reset all error messages
  invalidWebsite.style.display = "none";
  invalidWebsiteLength.style.display = "none";
  // Basic validation logic
  if (!input.value) {
    input.classList.remove("is-invalid");
    input.classList.remove("is-valid");
  } else if (input.value.length > 64) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidWebsiteLength.style.display = "block";
  } else if (!urlRegex.test(input.value)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidWebsite.style.display = "block";
  } else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add("was-validated");
}

function validatePhoneNumber() {
  const input = document.getElementById("contactDetailsPhoneNumber");
  const phoneExtension = document.getElementById("contactDetailsPhoneExtension");
  const invalidRequiredPhoneNumber = document.getElementById("invalidRequiredPhoneNumber");
  const invalidPhoneNumberNumeric = document.getElementById("invalidPhoneNumberNumeric");
  const invalidPhoneNumberFormat = document.getElementById("invalidPhoneNumberFormat");
  const invalidAddPhoneNumber = document.getElementById("invalidAddPhoneNumber");

  // Reset all error messages
  invalidRequiredPhoneNumber.style.display = "none";
  invalidPhoneNumberNumeric.style.display = "none";
  invalidPhoneNumberFormat.style.display = "none";

  //Basic validation logic
  if (/\D/.test(input.value)) {
    input.value = input.value.replace(/\D/g, '');
  }

  const phoneValue = input.value.replace(/-/g, '');

  if (phoneValue.length > 6) {
    input.value = `${phoneValue.slice(0, 3)}-${phoneValue.slice(3, 6)}-${phoneValue.slice(6)}`;
  } else if (phoneValue.length > 3) {
    input.value = `${phoneValue.slice(0, 3)}-${phoneValue.slice(3)}`;
  }

  if (!phoneValue && phoneExtension.value) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidRequiredPhoneNumber.style.display = 'block';
  } else if (!phoneValue) {
    input.classList.remove('is-invalid');
    input.classList.remove('is-valid');
  } else if (phoneValue.length === 10) {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  } else {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidPhoneNumberFormat.style.display = "block";
    invalidAddPhoneNumber.style.display = "none";
  }
  input.classList.add('was-validated');
}

function validatePhoneExtension() {
  const input = document.getElementById("contactDetailsPhoneExtension");
  const invalidPhoneExtension = document.getElementById( "invalidPhoneExtension");
  const invalidPhoneExtensionLength = document.getElementById( "invalidPhoneExtensionLength");

  // Reset all error messages
  invalidPhoneExtension.style.display = "none";
  invalidPhoneExtensionLength.style.display = "none";
  // Basic validation logic
  if (isNaN(input.value) && input.value !== "") {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPhoneExtension.style.display = "block";
  } else if (input.value.length > 6) {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
    invalidPhoneExtensionLength.style.display = "none";
  } else if (!input.value) {
    input.classList.remove("is-invalid");
    input.classList.remove("is-valid");
  }else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add("was-validated");
  validatePhoneNumber();
}

document.getElementById("add-icon").addEventListener("click", function () {
  if (isPhoneNumberValid()) {
    const typePhone = document.getElementById("contactDetailsPhoneType").value;
    const phoneNumber = document.getElementById("contactDetailsPhoneNumber").value;
    const phoneExtension = document.getElementById("contactDetailsPhoneExtension").value;
    const phoneNumberList = document.getElementById("phoneNumberList");
  
    const newphoneNumber = document.createElement("div");
    newphoneNumber.classList.add("d-flex","flex-row","align-items-center");
    //INPUT HIDDEN ID
    const inputId = document.createElement("input");
    inputId.value = "-1";
    inputId.classList.add("d-none");
    inputId.setAttribute("name","phoneNumberIds[]");
    //DIV PHONE TYPE
    const colphoneType = document.createElement("div");
    colphoneType.classList.add("col-2", "text-start","phoneType");
    colphoneType.textContent = typePhone;
    const inputPhoneTypeHidden = document.createElement("input");
    inputPhoneTypeHidden.value = typePhone;
    inputPhoneTypeHidden.classList.add("d-none");
    inputPhoneTypeHidden.setAttribute("name", "phoneTypes[]");
    newphoneNumber.appendChild(colphoneType);
    newphoneNumber.appendChild(inputPhoneTypeHidden);
    //DIV PHONE NUMBER
    const colphoneNum = document.createElement("div");
    colphoneNum.classList.add("col-6", "text-center", "phoneNumber");
    colphoneNum.textContent = phoneNumber;
    const inputPhoneNumHidden = document.createElement("input");
    inputPhoneNumHidden.value = phoneNumber;
    inputPhoneNumHidden.classList.add("d-none");
    inputPhoneNumHidden.setAttribute("name", "phoneNumbers[]");
    newphoneNumber.appendChild(colphoneNum);
    newphoneNumber.appendChild(inputPhoneNumHidden);
     //DIV PHONE EXTENSION
    const colphoneExtension = document.createElement("div");
    colphoneExtension.classList.add("col-2", "text-center","phoneExtension");
    colphoneExtension.textContent = phoneExtension; 
    const inputPhoneExtensionHidden = document.createElement("input");
    inputPhoneExtensionHidden.value = phoneExtension;
    inputPhoneExtensionHidden.classList.add("d-none");
    inputPhoneExtensionHidden.setAttribute("name", "phoneExtensions[]");
    newphoneNumber.appendChild(colphoneExtension);
    newphoneNumber.appendChild(inputPhoneExtensionHidden);
    
    const removephoneNumber = document.createElementNS(
      "http://www.w3.org/2000/svg",
      "svg"
    );
    removephoneNumber.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    removephoneNumber.setAttribute("width", "35");
    removephoneNumber.setAttribute("height", "35");
    removephoneNumber.setAttribute("fill", "currentColor");
    removephoneNumber.setAttribute("class", "bi bi-trash-fill col-2 ");
    removephoneNumber.setAttribute("viewBox", "0 0 16 16");
    removephoneNumber.style.cursor = "pointer";
    removephoneNumber.innerHTML = `
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
    `;
    removephoneNumber.onclick = () => {
      newphoneNumber.remove();
      validateListPhoneNumber();
    };
    newphoneNumber.appendChild(removephoneNumber);
    phoneNumberList.appendChild(newphoneNumber);
     
    document.getElementById("contactDetailsPhoneNumber").value = "";
    document.getElementById("contactDetailsPhoneExtension").value = "";
    document.getElementById("contactDetailsPhoneNumber").classList.remove("is-valid");
    document.getElementById("contactDetailsPhoneExtension").classList.remove("is-valid");
  }
  validateListPhoneNumber();
});

function removePhoneNumberAlreadyThere() {
  svgRemovePhone.forEach((removeButton) => {
    removeButton.addEventListener("click", function () {
      const phoneEntry = removeButton.closest(".d-flex"); 
      if (phoneEntry) {
        phoneEntry.remove();
        validateListPhoneNumber(); 
      }
    });
  });
}

function isPhoneNumberValid() {
  const errorMessages = document.querySelector('.errorMessagesPhone').children;
  const errorMessagesArray = Array.from(errorMessages);
  const invalidAddPhoneNumber = document.getElementById("invalidAddPhoneNumber");
  const valuePhoneNumber = document.getElementById("contactDetailsPhoneNumber").value;
  let hasError = false;
  errorMessagesArray.forEach(message => {
    if (message.style.display === "block") {
      hasError = true; 
    }
  });

  if (hasError) 
    return false;
  else if (valuePhoneNumber === "") {
    invalidAddPhoneNumber.style.display = "block";
    return false;
  }else{
    invalidAddPhoneNumber.style.display = "none";
    return true;
  }
}

function validateListPhoneNumber() {
  const invalidListPhoneNumbers = document.getElementById("invalidListPhoneNumbers");
  const divPhoneNumberList = document.getElementById("div-phoneNumberList");
  const contactDetailsPhoneNumberList = document.getElementById("contactDetailsPhoneNumberList");
  const phoneNumberCount = document.getElementById("phoneNumberList").children.length;

  if (phoneNumberCount === 0) {
    invalidListPhoneNumbers.style.display = "block";
    contactDetailsPhoneNumberList.classList.remove("mb-4");
    divPhoneNumberList.classList.remove("pb-4");
    invalidListPhoneNumbers.classList.add("mb-4");
    contactDetailsPhoneNumberList.classList.add("is-invalid");
    contactDetailsPhoneNumberList.classList.remove("is-valid");
  } else {
    invalidListPhoneNumbers.style.display = "none";
    invalidListPhoneNumbers.classList.remove("mb-4");
    divPhoneNumberList.classList.add("pb-4");
    contactDetailsPhoneNumberList.classList.add("mb-4");
    contactDetailsPhoneNumberList.classList.remove("is-invalid");
    contactDetailsPhoneNumberList.classList.add("is-valid");
  }
}

function validateContactDetailsAll(){
  validateCivicNumber();
  validateStreetName();
  validateOfficeNumber();
  validateCity();
  validatePostalCodeOnInput();
  validateWebsite();
 }