const requestStatusCancelBtn = document.getElementById("btnCancelRequestStatus");
const requestStatusEditBtn = document.getElementById("btnEditRequestStatus");
const requestStatusSaveBtn = document.getElementById("btnSaveRequestStatus");
const requestStatus = document.getElementById("requestStatus");
const btnRequest = document.querySelector(".btnRequest");
const deniedDivReason = document.querySelector(".deniedDivReason");
const deniedReasonText = document.getElementById("deniedReasonText");
const pendingOption = requestStatus.options[0];
const oldValueRequest = requestStatus.value;

document.addEventListener("DOMContentLoaded", function () {
    getSectionsInfo();
    initializePopovers();
    if (requestStatus.value === "denied") {
      deniedDivReason.classList.remove("d-none");
      deniedReasonText.setAttribute("disabled", "");
    }
});

//Btn annuler
requestStatusCancelBtn.addEventListener("click", () => {
    requestStatusEditBtn.classList.remove("d-none");
    requestStatusCancelBtn.classList.add("d-none");
    requestStatusSaveBtn.classList.add("d-none");
    requestStatus.setAttribute("disabled", "");
    deniedReasonText.setAttribute("disabled", "");
    requestStatus.insertBefore(pendingOption, requestStatus.options[0]);
    requestStatus.value = oldValueRequest;
    if (
      oldValueRequest === "accepted" ||
      oldValueRequest === "waiting" ||
      oldValueRequest === "toCheck"
    )
      deniedDivReason.classList.add("d-none");
    else if (oldValueRequest === "denied")
      deniedDivReason.classList.remove("d-none");
});
//Btn Modifier
requestStatusEditBtn.addEventListener("click", () => {
  requestStatusEditBtn.classList.add("d-none");
  requestStatusSaveBtn.classList.remove("d-none");
  requestStatusCancelBtn.classList.remove("d-none");
  requestStatus.removeAttribute("disabled");
  deniedReasonText.removeAttribute("disabled");
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

function showDeniedReason() {
  if (requestStatus.value === "denied") {
    deniedDivReason.classList.remove("d-none");
    deniedReasonText.removeAttribute("disabled");
  } 
  else 
  deniedDivReason.classList.add("d-none");
}

// HISTORIQUE
const modalHistory = new bootstrap.Modal(
  document.getElementById("modalHistory")
);
const btnHistory = document.getElementById("btnHistory");
btnHistory.addEventListener("click", () => {
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
      } 
      else 
      {
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
