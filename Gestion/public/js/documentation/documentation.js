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
}