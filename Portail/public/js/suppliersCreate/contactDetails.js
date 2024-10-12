async function getCitiesAndDistrickAreas() {
  try {
    const response = await fetch(
      "https://www.donneesquebec.ca/recherche/api/3/action/datastore_search?resource_id=19385b4e-5503-4330-9e59-f998f5918363&fields=munnom,regadm&sort=munnom,regadm&limit=1400"
    );

    if (response.ok) {
      const data = await response.json();
      return data.result.records;
    } else {
      const errorData = await response.json();
      console.error("Erreur:", errorData);
      throw new Error("Erreur lors de la récupération des données");
    }
  } catch (error) {
    console.error("Erreur de réseau:", error);
    throw error;
  }
}

async function addCitiesAndDAInSelect() {
  const citiesAndDA = await getCitiesAndDistrickAreas();
  const province = document.getElementById("contactDetailsProvince");
  const selectCity = document.getElementById("contactDetailsCitySelect");
  const inputCity = document.getElementById("contactDetailsInputCity");
  const districtArea = document.getElementById("contactDetailsDistrictArea");
  const optionsCity = [];
  const optionsDA = [];

  const districtAreas = citiesAndDA.map((da) =>
    da.regadm.replace(/--/g, "-")
  );
  const uniqueDA = Array.from(new Set(districtAreas)).sort();
  const uniqueCity = Array.from(new Set(citiesAndDA.map((city)=>city.munnom)))
  uniqueCity.splice(uniqueCity.indexOf("Toponyme à venir"),1);
  function addQuebecCities() {
    selectCity.innerHTML = "";
    uniqueCity.forEach((city) => {
        let optionCity = document.createElement("option");
        optionCity.text = city;
        optionCity.value = city;
        selectCity.add(optionCity);
        optionsCity.push(optionCity);
    });
    selectCity.classList.remove("d-none");
    inputCity.classList.add("d-none");
    inputCity.removeAttribute("required" ,"");
    if(oldCity !== undefined){
      optionsCity.forEach((city) => {
        if(oldCity === city.value)
          city.setAttribute("selected","selected");
      });
    }
  }
 
  if (province.value === "Québec") {
    addQuebecCities();
    districtArea.removeAttribute("disabled", "");
    addDistrictsAreas()
  } else {
    selectCity.classList.add("d-none");
    inputCity.classList.remove("d-none");
  }

  province.addEventListener("change", () => {
    if (province.value === "Québec") {
      addQuebecCities();
      districtArea.removeAttribute("disabled");
      addDistrictsAreas()
    } else {
      selectCity.classList.add("d-none");
      inputCity.classList.remove("d-none");
      inputCity.setAttribute("type", "text");
      districtArea.setAttribute("disabled", "");
  
      districtArea.innerHTML = "";
      let optionNA = document.createElement("option");
      optionNA.value = "N/A";
      optionNA.textContent = "N/A";
      optionNA.setAttribute("selected", "selected");
      districtArea.add(optionNA);
    }
  });
  function addDistrictsAreas(){
    districtArea.innerHTML = "";
    uniqueDA.forEach((DA) => {
      let optionDA = document.createElement("option");
      optionDA.text = DA;
      optionDA.value = DA.replace(/\s*\(.*?\)/, "");
      districtArea.add(optionDA);
      optionsDA.push(optionDA);
    });
    if(oldDistrictArea !== undefined){
      optionsDA.forEach((da) => {
        if(oldDistrictArea === da.value)
          da.setAttribute("selected", "selected");
      });
    }
  }

  selectCity.addEventListener("change", () =>{
    let cityAndDA = citiesAndDA.find(city => city.munnom === selectCity.value);
    let daWithoutCode = cityAndDA.regadm.replace(/\s*\(.*?\)/, "");
    let daWithoutDoubleDash = daWithoutCode.replace(/--/g, "-");
    //voir si je peux faire en 1 replace.
    if(cityAndDA)
      districtArea.value = daWithoutDoubleDash;
  });
}

function savePhoneNumbers(phoneNumbers) {
  sessionStorage.setItem("phoneNumbers", JSON.stringify(phoneNumbers));
}

function loadPhoneNumbers() {
  const savedPhoneNumbers = sessionStorage.getItem("phoneNumbers"); 
  return savedPhoneNumbers ? JSON.parse(savedPhoneNumbers) : [];
}

function addPhoneNumber() {
  const typePhone = document.getElementById("contactDetailsPhoneType").value;
  const phoneNumber = document.getElementById("contactDetailsPhoneNumber").value;
  const phoneExtension = document.getElementById("contactDetailsPhoneExtension").value;

  const phoneNumbers = loadPhoneNumbers();
  phoneNumbers.push({
    type: typePhone,
    number: phoneNumber,
    extension: phoneExtension,
  });
  savePhoneNumbers(phoneNumbers);

  displayPhoneNumbers();

  document.getElementById("contactDetailsPhoneNumber").value = "";
  document.getElementById("contactDetailsPhoneExtension").value = "";
  document.getElementById("contactDetailsPhoneNumber").classList.remove("is-valid");
  document.getElementById("contactDetailsPhoneExtension").classList.remove("is-valid");
}

function displayPhoneNumbers() {
  const phoneNumberList = document.getElementById("phoneNumberList");
  phoneNumberList.innerHTML = "";

  const phoneNumbers = loadPhoneNumbers();
  phoneNumbers.forEach((phone, index) => {
    const newphoneNumber = document.createElement("div");
    newphoneNumber.classList.add(
      "row",
      "mb-2",
      "align-items-center",
      "justify-content-between"
    );
    const colphoneType = document.createElement("div");
    colphoneType.classList.add("col-2", "text-start","phoneType");
    colphoneType.textContent = phone.type;
    const inputPhoneTypeHidden = document.createElement("input");
    inputPhoneTypeHidden.value = phone.type;
    inputPhoneTypeHidden.classList.add("d-none");
    inputPhoneTypeHidden.setAttribute("name", "phoneTypes[]");
    newphoneNumber.appendChild(colphoneType);
    newphoneNumber.appendChild(inputPhoneTypeHidden);

    const colphoneNum = document.createElement("div");
    colphoneNum.classList.add("col-6", "text-center", "phoneNumber");
    colphoneNum.textContent = phone.number;
    const inputPhoneNumHidden = document.createElement("input");
    inputPhoneNumHidden.value = phone.number;
    inputPhoneNumHidden.classList.add("d-none");
    inputPhoneNumHidden.setAttribute("name", "phoneNumbers[]");
    newphoneNumber.appendChild(colphoneNum);
    newphoneNumber.appendChild(inputPhoneNumHidden);

    const colphoneExtension = document.createElement("div");
    colphoneExtension.classList.add("col-2", "text-center","phoneExtension");
    colphoneExtension.textContent = phone.extension; 
    const inputPhoneExtensionHidden = document.createElement("input");
    inputPhoneExtensionHidden.value = phone.extension;
    inputPhoneExtensionHidden.classList.add("d-none");
    inputPhoneExtensionHidden.setAttribute("name", "phoneExtensions[]");
    newphoneNumber.appendChild(colphoneExtension);
    newphoneNumber.appendChild(inputPhoneExtensionHidden);

    const colRemove = document.createElement("div");
    colRemove.classList.add("col-2", "d-flex", "justify-content-center");

    const removephoneNumber = document.createElementNS(
      "http://www.w3.org/2000/svg",
      "svg"
    );
    removephoneNumber.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    removephoneNumber.setAttribute("width", "38");
    removephoneNumber.setAttribute("height", "38");
    removephoneNumber.setAttribute("fill", "currentColor");
    removephoneNumber.setAttribute("class", "bi bi-trash-fill");
    removephoneNumber.setAttribute("viewBox", "0 0 16 16");
    removephoneNumber.style.cursor = "pointer";
    removephoneNumber.innerHTML = `
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
    `;
    removephoneNumber.addEventListener("click", function () {
      phoneNumbers.splice(index, 1);
      savePhoneNumbers(phoneNumbers);
      displayPhoneNumbers();
    });
    colRemove.appendChild(removephoneNumber);
    newphoneNumber.appendChild(colRemove);
    phoneNumberList.appendChild(newphoneNumber);
  });
}

window.onload = function () {
    displayPhoneNumbers();
};

//Validation section Adresse
const regexAlphanum = /^[a-zA-Z0-9 ]+$/;

document.getElementById("contactDetailsCivicNumber").addEventListener("input", validateCivicNumber);
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

document.getElementById("contactDetailsStreetName").addEventListener("input", validateStreetName);
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

document.getElementById("contactDetailsOfficeNumber").addEventListener("input",validateOfficeNumber);
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

document.getElementById("contactDetailsInputCity").addEventListener("input", validateCity);
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
  });
}

document.getElementById("contactDetailsPostalCode").addEventListener("input", validatePostalCodeOnInput);
function validatePostalCodeOnInput() {
  const regexFullCP = /^[A-Za-z]\d[A-Za-z]\s?\d[A-Za-z]\d$/;
  const input = document.getElementById("contactDetailsPostalCode");
  const invalidRequiredPostalCode = document.getElementById("invalidRequiredPostalCode");
  const invalidPostalCodeFormat = document.getElementById("invalidPostalCodeFormat");
  const invalidPostalCodeLength = document.getElementById( "invalidPostalCodeLength");

  // Reset all error messages
  invalidRequiredPostalCode.style.display = "none";
  invalidPostalCodeFormat.style.display = "none";
  invalidPostalCodeLength.style.display = "none";

  const pcValue = input.value.replace(/\s+/g, "").toUpperCase();
// bug pour la validation code postal pas derreur si juste 1 lettre
  // Basic validation logic
  if (!input.value) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidRequiredPostalCode.style.display = "block";
  } else if (pcValue.length > 6) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeLength.style.display = "block";
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
  } else if ( pcValue.length === 4 && !/^[A-Za-z]\d[A-Za-z]\d$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 5 && !/^[A-Za-z]\d[A-Za-z]\s?\d[A-Za-z]$/.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else if (pcValue.length === 6 && !regexFullCP.test(pcValue)) {
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  } else {
    input.classList.remove("is-invalid");
    input.classList.add("is-valid");
  }
  input.classList.add("was-validated");
}

document.getElementById("contactDetailsPostalCode").addEventListener("blur", formatPostalCodeOnBlur);
function formatPostalCodeOnBlur() {
  const input = document.getElementById("contactDetailsPostalCode");
  const invalidPostalCodeFormat = document.getElementById("invalidPostalCodeFormat");
  const pcValue = input.value.replace(/\s+/g, "").toUpperCase();
  invalidPostalCodeFormat.style.display = "none";
  if (/^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/.test(pcValue)) {
    input.value = pcValue
    .replace(/\s+/g, "")
    .toUpperCase()
    .replace(/^([A-Za-z]\d[A-Za-z])(\d[A-Za-z]\d)$/, "$1 $2");
  }else{
    input.classList.remove("is-valid");
    input.classList.add("is-invalid");
    invalidPostalCodeFormat.style.display = "block";
  }
}

document.getElementById("contactDetailsWebsite").addEventListener("blur", validateWebsite);
function validateWebsite() {
  const urlRegex = /^(https?:\/\/)?(www\.)?([a-zA-Z0-9.-]+)(\.[a-zA-Z]{2,})(\/[^\s]*)?$/;
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

//Validation section Téléphones
document.getElementById("contactDetailsPhoneNumber").addEventListener("input", validatePhoneNumberOnInput);
function validatePhoneNumberOnInput() {
  const input = document.getElementById("contactDetailsPhoneNumber");
  const invalidRequiredPhoneNumber = document.getElementById("invalidRequiredPhoneNumber");
  const invalidPhoneNumberNumeric = document.getElementById("invalidPhoneNumberNumeric");
  const invalidPhoneNumberFormat = document.getElementById("invalidPhoneNumberFormat");
  const invalidAddPhoneNumber = document.getElementById("invalidAddPhoneNumber");

  // Reset all error messages
  invalidRequiredPhoneNumber.style.display = "none";
  invalidPhoneNumberNumeric.style.display = "none";
  invalidPhoneNumberFormat.style.display = "none";

  const phoneValue = input.value.replace(/\D/g, ''); 
  //Basic validation logic
  if (!phoneValue) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidRequiredPhoneNumber.style.display = 'block';
  } else if (isNaN(phoneValue)) {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidPhoneNumberNumeric.style.display = 'block';
  } else if (phoneValue.length === 10) {
    const formattedNumber = `${phoneValue.slice(0, 3)}-${phoneValue.slice(3, 6)}-${phoneValue.slice(6)}`;
    input.value = formattedNumber;
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  } else {
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidPhoneNumberFormat.style.display = 'block';
    invalidAddPhoneNumber.style.display = "none";
  }
  input.classList.add('was-validated');
}

document.getElementById("contactDetailsPhoneExtension").addEventListener("input",validatePhoneExtension);
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

document.getElementById("add-icon").addEventListener("click", function () {
  if (isPhoneNumberValid()) {
    addPhoneNumber();
    //validateListPhoneNumber();
  }
});

function validateListPhoneNumber(){
  const invalidListPhoneNumbers = document.getElementById("invalidListPhoneNumbers");
  const divPhoneNumberList = document.getElementById("div-phoneNumberList");
  const contactDetailsPhoneNumberList = document.getElementById("contactDetailsPhoneNumberList");
  if(document.getElementById("phoneNumberList").children.length == 0){
    invalidListPhoneNumbers.style.display = "block";
    contactDetailsPhoneNumberList.classList.remove("mb-4");
    divPhoneNumberList.classList.remove("pb-4");
    invalidListPhoneNumbers.classList.add("mb-4");
    contactDetailsPhoneNumberList.classList.add("is-invalid");
    contactDetailsPhoneNumberList.classList.remove("is-valid");
  }
  else{
    invalidListPhoneNumbers.style.display = "none";
    invalidListPhoneNumbers.remove("mb-4");
    divPhoneNumberList.classList.add("pb-4");
    contactDetailsPhoneNumberList.classList.add("mb-4");
    contactDetailsPhoneNumberList.classList.remove("is-invalid");
    contactDetailsPhoneNumberList.classList.add("is-valid");
  }
} 


document.addEventListener("DOMContentLoaded", function () {
  
  addCitiesAndDAInSelect();
  validateSelectCity();
  if(array !== undefined){
    console.log(array); 
  }
});

document.getElementById("contactDetails-button").addEventListener("click", (event)=>{
  validateContactDetailsAll();
})
function validateContactDetailsAll() {
  validateListPhoneNumber();
  validateCivicNumber();
  validateStreetName();
  validateOfficeNumber();
  validateCity();
  validatePostalCodeOnInput();
  formatPostalCodeOnBlur();
  validateWebsite();
}
