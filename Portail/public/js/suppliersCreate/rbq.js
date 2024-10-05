/*** Section Licence RBQ ***/
let subcategories = [];
let typeLicence;
let licenceNumber = "";
let phoneNumber;
let address = "";
let city = "";
let districtArea = "";
let licenceRestriction = false;
let neqNumber = "8831854938"; //TODO::Modifier pour mettre la variable du NEQ
//8831854938
async function fetchRBQ(rbqNumber) {
  const response = await fetch("https://donneesquebec.ca/recherche/api/action/datastore_search_sql?sql=SELECT\"Numero de licence\",\"Statut de la licence\",\"Restriction\",\"Type de licence\",\"Categorie\",\"Sous-categories\",\"Numero de telephone\",\"Adresse\",\"Municipalite\",\"Region administrative\"FROM\"32f6ec46-85fd-45e9-945b-965d9235840a\"WHERE\"NEQ\"='"+ rbqNumber +"'AND\"Categorie\"<>'null'");
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
 
  return data.result.records;
}

document.addEventListener('DOMContentLoaded', async function() { //TODO::Modifier pour mettre a jour après la premmière page NEQ
  await fetchRBQ(neqNumber);
  getAddressAndFillForm();

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
function getAddressAndFillForm(){
  if(neqNumber != ""){
    let addressInfo = address.split(city.toLocaleUpperCase());
    let civicNumber = addressInfo[0].substring(0, addressInfo[0].indexOf(" "));
    let streetName = addressInfo[0].substring(addressInfo[0].indexOf(" ") + 1);
    let postalCode = addressInfo[1].substring(addressInfo[1].length-7,addressInfo[0].length);

    document.querySelectorAll("[name='contactDetailsCivicNumber']").forEach(input => {input.value = civicNumber;});
    document.querySelectorAll("[name='contactDetailsStreetName']").forEach(input => {input.value = streetName; });
    document.getElementById("contactDetailsCitySelect").value = city;
    document.getElementById("contactDetailsPostalCode").value = postalCode;
    document.getElementById("contactDetailsDistrictArea").value = districtArea;
    document.getElementById("contactDetailsPhoneNumber").value = phoneNumber;
  }
}

