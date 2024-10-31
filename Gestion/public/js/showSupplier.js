let sections;
let navSectionsDivs;

// NAVIGATE SECTIONS FORM
document.addEventListener("DOMContentLoaded", async function () {
    getSectionsInfo();
});

function getSectionsInfo() {
  sections = document.getElementsByClassName("show-section");
  navSectionsDivs = Array.from(document.querySelectorAll(".shadow-sm > div")).slice(1);
  navSectionsDivs.forEach((div) => {
    div.style.cursor = 'pointer'; 
    div.addEventListener("click", function () {
      showSectionDoc(div.id.replace('-nav-button', '-section'));
    });
  });
}

function showSectionDoc(id) {
  for (let i = 0; i < sections.length; i++) {
    sections[i].classList.add("d-none");
  }

  const displayedSection = document.getElementById(id);
  displayedSection.classList.remove("d-none");
}

// MODIFY SECTIONS FORM
const requestStatusSection = document.getElementById("requestStatus-section");
const identificationSection = document.getElementById("identification-section");
const contactDetailsSection = document.getElementById("contactDetails-section");
const contactsSection = document.getElementById("contacts-section");
const licenceSection = document.getElementById("licence-section");
const attachmentsSection = document.getElementById("attachments-section");
const financesSection = document.getElementById("finances-section");

//--ETAT DEMANDE--//
const requestStatusEditBtn = document.getElementById("btnEditRequestStatus");
const requestStatusSaveBtn = document.getElementById("btnSaveRequestStatus");
const requestStatus= document.getElementById("requestStatus");

requestStatusEditBtn.addEventListener("click", ()=>{
  requestStatusSaveBtn.classList.remove("d-none");
  requestStatus.removeAttribute("disabled");
});

requestStatusSaveBtn.addEventListener("click", () => {
  requestStatusSaveBtn.classList.add("d-none");
  requestStatus.setAttribute("disabled");
});