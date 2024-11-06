let sections;
let navSectionsDivs;
let lastClickedDiv = null; 

// NAVIGATE SECTIONS FORM
function getSectionsInfo() {
  const navSectionsDivs = Array.from(document.querySelectorAll(".shadow-sm > div")).slice(1);
  
  navSectionsDivs.forEach((div) => {
    div.addEventListener("click", function () {
      if (lastClickedDiv) {
        lastClickedDiv.classList.remove("bg-gray");
      }
      lastClickedDiv = div;
      div.classList.add("bg-gray");
      div.style.cursor = "pointer"; 
      showSectionDoc(div.id.replace("-nav-button", "-section"));
    });
  });
}

function showSectionDoc(id) {
  const sections = document.getElementsByClassName("show-section");
  for (let i = 0; i < sections.length; i++) {
    sections[i].classList.add("d-none");
  }
  const displayedSection = document.getElementById(id);
  displayedSection.classList.remove("d-none");
}

document.querySelectorAll(".py-1.rounded").forEach(button => {
  button.querySelectorAll("svg").forEach(svg => {
    svg.style.fill = "#0B2341";
  });
  button.addEventListener("click", function () {
    document.querySelectorAll(".section-clicked").forEach(icon => icon.classList.add("d-none"));

    document.querySelectorAll(".py-1.rounded svg").forEach(icon => icon.classList.add("d-none"));
    document.querySelectorAll(".py-1.rounded svg:not(.section-clicked)").forEach(icon => icon.classList.remove("d-none"));
    const clickedIcon = this.querySelector(".section-clicked");
    const defaultIcon = this.querySelector("svg:not(.section-clicked)");
    if (clickedIcon && defaultIcon) {
      clickedIcon.classList.toggle("d-none");
      defaultIcon.classList.toggle("d-none");
    }
  });
});

// MODIFY SECTIONS FORM
const requestStatusSection = document.getElementById("requestStatus-section");
const identificationSection = document.getElementById("identification-section");
const contactDetailsSection = document.getElementById("contactDetails-section");
const contactsSection = document.getElementById("contacts-section");
const licenceSection = document.getElementById("licence-section");
const attachmentsSection = document.getElementById("attachments-section");
const financesSection = document.getElementById("finances-section");

//--ETAT DEMANDE--//
const requestStatusCancelBtn = document.getElementById("btnCancelRequestStatus");
const requestStatusEditBtn = document.getElementById("btnEditRequestStatus");
const requestStatusSaveBtn = document.getElementById("btnSaveRequestStatus");
const requestStatus = document.getElementById("requestStatus");
const btnRequest = document.querySelector(".btnRequest");
const deniedDivReason = document.querySelector(".deniedDivReason");
const deniedReason = document.getElementById("deniedReason");
const pendingOption = requestStatus.options[0];
const oldValueRequest = requestStatus.value;
//Btn annuler
requestStatusCancelBtn.addEventListener("click" , ()=>{
  requestStatusEditBtn.classList.remove("d-none");
  requestStatusCancelBtn.classList.add("d-none");
  requestStatusSaveBtn.classList.add("d-none");
  requestStatus.setAttribute("disabled", "");
  deniedReason.setAttribute("disabled", "");
  requestStatus.insertBefore(pendingOption, requestStatus.options[0]);
  requestStatus.value = oldValueRequest;
  if(oldValueRequest === "accepted" || oldValueRequest === "waiting" || oldValueRequest === "toCheck" )
    deniedDivReason.classList.add("d-none");
  else if (oldValueRequest === "denied")
    deniedDivReason.classList.remove("d-none");
})
//Btn Modifier
requestStatusEditBtn.addEventListener("click", ()=>{
  requestStatusEditBtn.classList.add("d-none");
  requestStatusSaveBtn.classList.remove("d-none");
  requestStatusCancelBtn.classList.remove("d-none");
  requestStatus.removeAttribute("disabled");
  deniedReason.removeAttribute("disabled");
  //enlever l"option en attente.
  requestStatus.options.remove(0);
});
//Btn Enregistrer
requestStatusSaveBtn.addEventListener("click", () => {
  requestStatusEditBtn.classList.remove("d-none");
  requestStatusSaveBtn.classList.add("d-none");
  requestStatusCancelBtn.classList.add("d-none");
  requestStatus.insertBefore(pendingOption, requestStatus.options[0]);
});
//Statut Refuser
requestStatus.addEventListener("change", () => {
  showDeniedReason();
});

function showDeniedReason(){
  if(requestStatus.value === "denied"){
    deniedDivReason.classList.remove("d-none");
    deniedReason.removeAttribute("disabled");
  }
  else
    deniedDivReason.classList.add("d-none");
}

function showBtnAcceptedDenied(){
  if(requestStatus.value === "accepted" || requestStatus.value === "denied")
    btnRequest.classList.add("d-none")
  if(requestStatus.value === "denied")
    deniedDivReason.classList.remove("d-none");
  else
    deniedDivReason.classList.add("d-none");
}

// HISTORIQUE
const modalHistory = new bootstrap.Modal(document.getElementById('modalHistory'))
const btnHistory = document.getElementById("btnHistory");
btnHistory.addEventListener("click", () =>{
  modalHistory.show();
});

function initializePopovers() {
    let currentPopover = null;
    const popoverLinks = document.querySelectorAll(".popover-link");

    popoverLinks.forEach((popoverLink) => {
      const popover = new bootstrap.Popover(popoverLink);
      popoverLink.addEventListener("click", function (event) {
        event.preventDefault();
        if (currentPopover && currentPopover !== popover) {
          currentPopover.hide();
        }
        if (currentPopover === popover) {
          popover.hide();
          currentPopover = null;
        } else {
          popover.show();
          currentPopover = popover;
        }
      });
    });

    document.addEventListener("click", function (event) {
      if (currentPopover && !event.target.closest(".popover-link")) {
        currentPopover.hide();
        currentPopover = null;
      }
    });
}
document.addEventListener("DOMContentLoaded", function () {
  getSectionsInfo();
  showBtnAcceptedDenied();
  initializePopovers();
});


