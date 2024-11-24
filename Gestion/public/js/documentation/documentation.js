const click = new Event('click');

let docSections;

let loginButton;
let loginButtonMobile;
let signupButton;
let signupButtonMobile;

document.addEventListener('DOMContentLoaded', async function() {
  getDocElement();
});

function getDocElement(){
  docSections = document.getElementsByClassName("doc-section");

  loginButton = document.getElementById("suppliersList-nav-button");
  loginButton.addEventListener('click', ()=>{showSectionDoc("doc-section-suppliersList")});

  loginButton = document.getElementById("supplierZoom-nav-button");
  loginButton.addEventListener('click', ()=>{showSectionDoc("doc-section-supplierZoom")});

  loginButton = document.getElementById("selectedSuppliersList-nav-button");
  loginButton.addEventListener('click', ()=>{showSectionDoc("doc-section-selectedSuppliersList")});
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
  console.log('test');
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