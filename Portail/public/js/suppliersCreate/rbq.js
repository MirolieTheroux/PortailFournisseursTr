/*** Section operation ***/
let subcategories = [];
let typeLicence;
let licenceNumber = "";
let licenceRestriction = false;
let neqNumber = ""; //TODO::Modifier pour mettre la variable du NEQ

async function fetchRBQ(rbqNumber) {
  const response = await fetch("https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT\"Numero de licence\",\"Statut de la licence\",\"Restriction\",\"Type de licence\",\"Categorie\",\"Sous-categories\"FROM\"32f6ec46-85fd-45e9-945b-965d9235840a\"WHERE\"NEQ\"='"+ rbqNumber +"'AND\"Categorie\"<>'null'");
  const data = await response.json();

  licenceRestriction = false;

  data.result.records.forEach(record => {
    if(record["Statut de la licence"] === "Active"){
      subcategories.push(record["Sous-categories"])
    }
    if(typeLicence === undefined){
      typeLicence = record["Type de licence"];
    }
    if(licenceNumber === ""){
      licenceNumber = record["Numero de licence"];
    }
    if(record["restriction"] === "Oui"){
      licenceRestriction = true;
    }
  });
  return data.result.records;
}

document.addEventListener('DOMContentLoaded', async function() { //TODO::Modifier pour mettre a jour après la premmière page NEQ
  await fetchRBQ(neqNumber);

  const entrepreneurContainer = document.getElementById('entrepreneur-categories');
  const ownerBuilderContainer = document.getElementById('ownerBuilder-categories');
  const noCategoriesContainer = document.getElementById('no-categories');
  const formFailContainer = document.getElementById('form-fail-rbq');
  const numberRbqInput = document.getElementById('licenceRbq');
  const statusRbqSelect = document.getElementById('statusRbq');

  const typeRbqSelect = document.getElementById('typeRbq');
  typeRbqSelect.addEventListener('change', function(event) {
    changeSubCategoriesList();
    checkboxesReset(true);
  });

  const checkboxes = document.querySelectorAll('input.form-check-input');

  if(licenceNumber !== "")
    numberRbqInput.value = licenceNumber;

  if(subcategories.length > 0 && !licenceRestriction)
    statusRbqSelect.value = 'valid'
  else if(subcategories.length > 0)
    statusRbqSelect.value = 'restrictedValid'
  else if(licenceNumber !== "")
    statusRbqSelect.value = 'invalid'

  if(typeLicence === "Entrepreneur")
    typeRbqSelect.value = 'entrepreneur';
  else if(typeLicence === "Constructeur-proprietaire")
    typeRbqSelect.value = 'ownerBuilder';

  changeSubCategoriesList();

  if(formFailContainer === null){
    checkboxesReset(false);
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
});

/*** Validation ***/
function validateRbqLicence() {
  const input = document.getElementById("licenceRbq");
  const parentDiv = input.parentElement;
  const invalidNumberMessage = parentDiv.querySelector('.licenceInvalidNumber');
  const invalidSizeMessage = parentDiv.querySelector('.licenceInvalidSize');

  // Reset all error messages
  invalidNumberMessage.style.display = 'none';
  invalidSizeMessage.style.display = 'none';

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
  else if(input.value.length !== 10){
    input.classList.remove('is-valid');
    input.classList.add('is-invalid');
    invalidSizeMessage.style.display = 'block';
  }
  else {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
  }

  input.classList.add('was-validated');
  validateRbqStatus();
  validateRbqType();
  validateRbqCategories();
};

function validateRbqStatus() {
  const inputLicence = document.getElementById("licenceRbq");
  const selectStatus = document.getElementById("statusRbq");
  const parentDiv = selectStatus.parentElement;
  const invalidStatusRequired = parentDiv.querySelector('.statusInvalidRequired');
  const invalidStatusRequiredNot = parentDiv.querySelector('.statusInvalidRequiredNot');

  // Reset all error messages
  invalidStatusRequired.style.display = 'none';
  invalidStatusRequiredNot.style.display = 'none';

  // Basic validation logic
  if(inputLicence.value){
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

function validateRbqType() {
  const inputLicence = document.getElementById("licenceRbq");
  const selectType = document.getElementById("typeRbq");
  const parentDiv = selectType.parentElement;
  const invalidTypeRequired = parentDiv.querySelector('.typeInvalidRequired');
  const invalidTypeRequiredNot = parentDiv.querySelector('.typeInvalidRequiredNot');

  // Reset all error messages
  invalidTypeRequired.style.display = 'none';
  invalidTypeRequiredNot.style.display = 'none';

  // Basic validation logic
  if(inputLicence.value){
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

function validateRbqCategories(){
  const inputLicence = document.getElementById("licenceRbq");
  const subcategorieContainer = document.getElementById("subcategories-container");
  const parentDiv = subcategorieContainer.parentElement;
  const invalidSubcategorieRequired = parentDiv.querySelector('.subcategorieInvalidRequired');
  const invalidSubcategorieRequiredNot = parentDiv.querySelector('.subcategorieInvalidRequiredNot');

  const subcategoriesCheckBoxes = subcategorieContainer.getElementsByClassName("rbq-subcategories-check");

  // Reset all error messages
  invalidSubcategorieRequired.style.display = 'none';
  invalidSubcategorieRequiredNot.style.display = 'none';

  let subcategorieFound = false;

  for(let checkbox of subcategoriesCheckBoxes){
    if(checkbox.checked){
      subcategorieFound = true;
    }
  }
  if(inputLicence.value){
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

function validateRbqAll(){
  const licenceInput = document.getElementById("licenceRbq");
  const oninput = new Event('input');
  licenceInput.dispatchEvent(oninput);

  const statusSelect = document.getElementById("statusRbq");
  const typeSelect = document.getElementById("typeRbq");

  const onchange = new Event('change');
  statusSelect.dispatchEvent(onchange);
  typeSelect.dispatchEvent(onchange);

  const subcategoriesChecks = document.getElementsByClassName("rbq-subcategories-check");
  const onclick = new Event('click');
  subcategoriesChecks.dispatchEvent(onclick);
}
