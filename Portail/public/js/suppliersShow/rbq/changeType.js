/*** Section operation ***/
let entrepreneurContainer;
let ownerBuilderContainer;
let noCategoriesContainer;
let formFailContainer;
let numberRbqInput;
let statusRbqSelect;
let typeRbqSelect;
let checkboxes;
let idButton;

let subcategories = [];
let typeLicence;
let licenceNumber = "";
let phoneNumber;
let address = "";
let city = "";
let districtArea = "";
let licenceRestriction = false;
let neqNumber = "";

document.addEventListener('DOMContentLoaded', async function() {
  getRbqChangeTypeElements();
});

function getRbqChangeTypeElements(){
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
  validateRbqCategories();
}