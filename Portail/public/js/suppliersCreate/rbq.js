/*** Section Licence RBQ ***/
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

/*** Section Coordonnées ***/
