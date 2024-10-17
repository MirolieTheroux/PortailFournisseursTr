/*** Section operation ***/
let entrepreneurContainer;
let ownerBuilderContainer;
let noCategoriesContainer;
let formFailContainer;
let numberRbqInput;
let statusRbqSelect;
let typeRbqSelect;
let checkboxes;

let subcategories = [];
let typeLicence;
let licenceNumber = "";
let phoneNumber;
let address = "";
let city = "";
let districtArea = "";
let licenceRestriction = false;

function getElements(){
  entrepreneurContainer = document.getElementById('entrepreneur-categories');
  ownerBuilderContainer = document.getElementById('ownerBuilder-categories');
  noCategoriesContainer = document.getElementById('no-categories');
  formFailContainer = document.getElementById('form-fail-rbq');
  numberRbqInput = document.getElementById('licenceRbq');
  statusRbqSelect = document.getElementById('statusRbq');

  typeRbqSelect = document.getElementById('typeRbq');
  typeRbqSelect.addEventListener('change', function(event) {
    changeSubCategoriesList();
    checkboxesReset(true);
  });

  checkboxes = document.querySelectorAll('input.form-check-input');
}

async function fetchRBQ() {
  const neqNumber = document.getElementById("neq").value;
  subcategories = [];
  typeLicence = "";
  licenceNumber = "";
  licenceRestriction = false;
  if(formFailContainer === null){
    checkboxesReset(true);
  }

  const response = await fetch("https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT\"Numero de licence\",\"Statut de la licence\",\"Restriction\",\"Type de licence\",\"Categorie\",\"Sous-categories\"FROM\"32f6ec46-85fd-45e9-945b-965d9235840a\"WHERE\"NEQ\"='"+ neqNumber +"'AND\"Categorie\"<>'null'");
  const data = await response.json();

  data.result.records.forEach(record => {
    console.log(record);
    if(record["Statut de la licence"] === "Active"){
      subcategories.push(record["Sous-categories"])
    }
    if(typeLicence === ""){
      typeLicence = record["Type de licence"];
    }
    if(licenceNumber === ""){
      licenceNumber = record["Numero de licence"].replace(/-/g, '');
    }
    if(record["Restriction"] === "Oui"){
      licenceRestriction = true;
    }
    if(phoneNumber === undefined){
      phoneNumber = record["Numero de telephone"];
    }
    if(address === ""){
      address = record["Adresse"];
    }
    if(city === ""){
      city = record["Municipalite"];
    }
    if(districtArea === ""){
      districtArea = record["Region administrative"];
    }
  });

  if(licenceNumber !== "")
    numberRbqInput.value = licenceNumber;
  else
    numberRbqInput.value = "";

  if(subcategories.length > 0 && !licenceRestriction)
    statusRbqSelect.value = 'valid';
  else if(subcategories.length > 0)
    statusRbqSelect.value = 'restrictedValid';
  else if(licenceNumber !== "")
    statusRbqSelect.value = 'invalid';
  else
    statusRbqSelect.value = '';

  if(typeLicence === "Entrepreneur")
    typeRbqSelect.value = 'entrepreneur';
  else if(typeLicence === "Constructeur-proprietaire")
    typeRbqSelect.value = 'ownerBuilder';
  else
  typeRbqSelect.value = '';

  changeSubCategoriesList();

  if(formFailContainer === null){
    checkboxesReset(false);
  }

  return data.result.records;
}

function changeSubCategoriesList(){
  if(typeRbqSelect.value === 'entrepreneur'){
    ownerBuilderContainer.classList.add('d-none');
    ownerBuilderContainer.classList.remove('d-block');
    noCategoriesContainer.classList.add('d-none');
    noCategoriesContainer.classList.remove('d-block');
    entrepreneurContainer.classList.add('d-block');
    entrepreneurContainer.classList.remove('d-none');
  }
  else if(typeRbqSelect.value === 'ownerBuilder'){
    entrepreneurContainer.classList.add('d-none');
    entrepreneurContainer.classList.remove('d-block');
    noCategoriesContainer.classList.add('d-none');
    noCategoriesContainer.classList.remove('d-block');
    ownerBuilderContainer.classList.add('d-block');
    ownerBuilderContainer.classList.remove('d-none');
  }
  else{
    entrepreneurContainer.classList.add('d-none');
    entrepreneurContainer.classList.remove('d-block');
    ownerBuilderContainer.classList.add('d-none');
    ownerBuilderContainer.classList.remove('d-block');
    noCategoriesContainer.classList.add('d-block');
    noCategoriesContainer.classList.remove('d-none');
  }
}


function checkboxesReset(statusReset){
  checkboxes.forEach(checkbox => {
    const regexEnt = /Ent$/g;
    const regexOB = /OB$/g;
    if(checkbox.id.match(regexEnt) && typeLicence === "Entrepreneur"){
      if(subcategories.includes(checkbox.value))
        checkbox.checked  = true;
      else
        checkbox.checked  = false;
    }
    else if(checkbox.id.match(regexOB) && typeLicence === "Constructeur-proprietaire"){
      if(subcategories.includes(checkbox.value))
        checkbox.checked  = true;
      else
        checkbox.checked  = false;
    }
    else if(licenceNumber === undefined || statusReset)
      checkbox.checked  = false;
  });
}

document.addEventListener('DOMContentLoaded', async function() {
  getElements();
  await fetchRBQ();
});

/*** Validation ***/
const inputLicenceRbq = document.getElementById("licenceRbq");
inputLicenceRbq.addEventListener('input', validateRbqLicence);

function validateRbqLicence() {
  const parentDiv = inputLicenceRbq.parentElement;
  const invalidNumberMessage = parentDiv.querySelector('.licenceInvalidNumber');
  const invalidSizeMessage = parentDiv.querySelector('.licenceInvalidSize');

  // Reset all error messages
  invalidNumberMessage.style.display = 'none';
  invalidSizeMessage.style.display = 'none';

  // Basic validation logic
  if (isNaN(inputLicenceRbq.value)) {
    inputLicenceRbq.classList.remove('is-valid');
    inputLicenceRbq.classList.add('is-invalid');
    invalidNumberMessage.style.display = 'block';
  }
  else if(!inputLicenceRbq.value){
    inputLicenceRbq.classList.remove('is-invalid');
    inputLicenceRbq.classList.remove('is-valid');
  }
  else if(inputLicenceRbq.value.length !== 10){
    inputLicenceRbq.classList.remove('is-valid');
    inputLicenceRbq.classList.add('is-invalid');
    invalidSizeMessage.style.display = 'block';
  }
  else {
    inputLicenceRbq.classList.remove('is-invalid');
    inputLicenceRbq.classList.add('is-valid');
  }

  inputLicenceRbq.classList.add('was-validated');
  validateRbqStatus();
  validateRbqType();
  validateRbqCategories();
};

const selectStatus = document.getElementById("statusRbq");
selectStatus.addEventListener('change', validateRbqStatus);

function validateRbqStatus() {
  const parentDiv = selectStatus.parentElement;
  const invalidStatusRequired = parentDiv.querySelector('.statusInvalidRequired');
  const invalidStatusRequiredNot = parentDiv.querySelector('.statusInvalidRequiredNot');

  // Reset all error messages
  invalidStatusRequired.style.display = 'none';
  invalidStatusRequiredNot.style.display = 'none';

  // Basic validation logic
  if(inputLicenceRbq.value){
    if(!selectStatus.value){
      selectStatus.classList.remove('is-valid');
      selectStatus.classList.add('is-invalid');
      invalidStatusRequired.style.display = 'block';
    }
    else{
      selectStatus.classList.remove('is-invalid');
      selectStatus.classList.add('is-valid');
    }
  }
  else{
    if(selectStatus.value){
      selectStatus.classList.remove('is-valid');
      selectStatus.classList.add('is-invalid');
      invalidStatusRequiredNot.style.display = 'block';
    }
    else{
      selectStatus.classList.remove('is-invalid');
      selectStatus.classList.add('is-valid');
    }
  }

  selectStatus.classList.add('was-validated');
};

const selectType = document.getElementById("typeRbq");
selectType.addEventListener('change', validateRbqType);

function validateRbqType() {
  const parentDiv = selectType.parentElement;
  const invalidTypeRequired = parentDiv.querySelector('.typeInvalidRequired');
  const invalidTypeRequiredNot = parentDiv.querySelector('.typeInvalidRequiredNot');

  // Reset all error messages
  invalidTypeRequired.style.display = 'none';
  invalidTypeRequiredNot.style.display = 'none';

  // Basic validation logic
  if(inputLicenceRbq.value){
    if(!selectType.value){
      selectType.classList.remove('is-valid');
      selectType.classList.add('is-invalid');
      invalidTypeRequired.style.display = 'block';
    }
    else{
      selectType.classList.remove('is-invalid');
      selectType.classList.add('is-valid');
    }
  }
  else{
    if(selectType.value){
      selectType.classList.remove('is-valid');
      selectType.classList.add('is-invalid');
      invalidTypeRequiredNot.style.display = 'block';
    }
    else{
      selectType.classList.remove('is-invalid');
      selectType.classList.add('is-valid');
    }
  }

  selectType.classList.add('was-validated');
};

const subcategorieContainer = document.getElementById("subcategories-container");
const subcategoriesCheckBoxes = subcategorieContainer.getElementsByClassName("rbq-subcategories-check");
selectType.addEventListener('change', validateRbqType);
for(let checkbox of subcategoriesCheckBoxes){
  checkbox.addEventListener('click', validateRbqCategories);
}

function validateRbqCategories(){
  const parentDiv = subcategorieContainer.parentElement;
  const invalidSubcategorieRequired = parentDiv.querySelector('.subcategorieInvalidRequired');
  const invalidSubcategorieRequiredNot = parentDiv.querySelector('.subcategorieInvalidRequiredNot');

  // Reset all error messages
  invalidSubcategorieRequired.style.display = 'none';
  invalidSubcategorieRequiredNot.style.display = 'none';

  let subcategorieFound = false;

  for(let checkbox of subcategoriesCheckBoxes){
    if(checkbox.checked){
      subcategorieFound = true;
    }
  }
  if(inputLicenceRbq.value){
    if(subcategorieFound){
      subcategorieContainer.classList.remove('is-invalid');
      subcategorieContainer.classList.add('is-valid');
    }
    else{
      subcategorieContainer.classList.remove('is-valid');
      subcategorieContainer.classList.add('is-invalid');
      invalidSubcategorieRequired.style.display = 'block';
    }
  }
  else{
    if(subcategorieFound){
      subcategorieContainer.classList.remove('is-valid');
      subcategorieContainer.classList.add('is-invalid');
      invalidSubcategorieRequiredNot.style.display = 'block';
    }
    else{
      subcategorieContainer.classList.remove('is-invalid');
      subcategorieContainer.classList.add('is-valid');
    }
  }

}

const rbqSectionNext = document.getElementById("rbqLicence-button");
rbqSectionNext.addEventListener("click", async (event)=>{
  await validateRbqAll();
});

async function validateRbqAll(){
  validateRbqLicence();
  validateRbqStatus();
  validateRbqType();
  validateRbqCategories();

  if(inputLicenceRbq.classList.contains("is-valid")){
    let rbqExist = await checkRbqUnique(inputLicenceRbq.value);
    if(rbqExist){
      const rbqInvalidExist = document.getElementById('rbqInvalidExist');
      inputLicenceRbq.classList.remove('is-valid');
      inputLicenceRbq.classList.add('is-invalid');
      rbqInvalidExist.style.display = 'block';
    }
  }
}

async function checkRbqUnique(number){
  const response = await fetch('/suppliers/checkRbq', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('[name="_token"]').getAttribute('value')
    },
    body: JSON.stringify({ number: number })
  })
  const data = await response.json();
  return data.exists;
}

/*** Section Coordonnées ***/
function getAddressAndFillForm(){
  if(neqNumber != ""){
    let addressInfo = address.split(city.toLocaleUpperCase());
    let civicNumber = addressInfo[0].substring(0, addressInfo[0].indexOf(" "));
    let streetName = addressInfo[0].substring(addressInfo[0].indexOf(" ") + 1);
    let postalCode = addressInfo[1].substring(addressInfo[1].length-7,addressInfo[0].length);
    let postalCodeNoSpace = postalCode.replace(" ", ""); 

    document.querySelectorAll("[name='contactDetailsCivicNumber']").forEach(input => {input.value = civicNumber;});
    document.querySelectorAll("[name='contactDetailsStreetName']").forEach(input => {input.value = streetName; });
    document.getElementById("contactDetailsCitySelect").value = city;
    document.getElementById("contactDetailsPostalCode").value = postalCodeNoSpace;
    document.getElementById("contactDetailsDistrictArea").value = districtArea;
    document.getElementById("contactDetailsPhoneNumber").value = phoneNumber;
  }
}

