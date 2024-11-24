const click = new Event('click');

let docSections;

let suppliersListButton;
let supplierZoomButton;
let selectedSuppliersListButton;
let usersListButton;
let parametersButton;
let emailsButton;

document.addEventListener('DOMContentLoaded', async function() {
  getDocElement();
});

function getDocElement(){
  docSections = document.getElementsByClassName("doc-section");

  suppliersListButton = document.getElementById("suppliersList-nav-button");
  suppliersListButton.addEventListener('click', ()=>{showSectionDoc("doc-section-suppliersList")});

  supplierZoomButton = document.getElementById("supplierZoom-nav-button");
  supplierZoomButton.addEventListener('click', ()=>{showSectionDoc("doc-section-supplierZoom")});

  selectedSuppliersListButton = document.getElementById("selectedSuppliersList-nav-button");
  selectedSuppliersListButton.addEventListener('click', ()=>{showSectionDoc("doc-section-selectedSuppliersList")});

  userListButton = document.getElementById("usersList-nav-button");
  userListButton.addEventListener('click', ()=>{showSectionDoc("doc-section-usersList")});

  parametersButton = document.getElementById("parametersManagement-nav-button");
  parametersButton.addEventListener('click', ()=>{showSectionDoc("doc-section-parametersManagement")});

  emailsButton = document.getElementById("emailsManagement-nav-button");
  emailsButton.addEventListener('click', ()=>{showSectionDoc("doc-section-emailsManagement")});
}

function showSectionDoc(id){
  for(let i = 0; i < docSections.length ; i++){
      docSections[i].classList.add("d-none");
  };

  const displayedSection = document.getElementById(id);
  displayedSection.classList.remove("d-none");
  grayOption(id);
}

function grayOption(id){
  const section = id.split('-')[2];
  const sectionId = section + '-nav-button';
  const buttons = document.querySelectorAll('.doc-nav-button');

  buttons.forEach(button => {
    if(button.id === sectionId){
      button.classList.add("bg-gray");
    }
    else{
      button.classList.remove("bg-gray");
    }
  });
}