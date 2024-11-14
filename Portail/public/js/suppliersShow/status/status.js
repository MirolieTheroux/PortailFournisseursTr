const requestStatusCancelBtn = document.getElementById("btnCancelRequestStatus");
const requestStatusEditBtn = document.getElementById("btnEditRequestStatus");
const requestStatusSaveBtn = document.getElementById("btnSaveRequestStatus");
const requestStatus = document.getElementById("requestStatus");
const btnRequest = document.querySelector(".btnRequest");
const deniedDivReason = document.querySelector(".deniedDivReason");
const deniedReasonText = document.getElementById("deniedReasonText");
const pendingOption = requestStatus.options[0];
const oldValueRequest = requestStatus.value;
const deniedReasonRequired = document.getElementById("deniedReasonRequired");

document.addEventListener("DOMContentLoaded", function () {
  initializePopovers();
  if (requestStatus.value === "denied") {
    deniedDivReason.classList.remove("d-none");
    deniedReasonText.setAttribute("disabled", "");
  }
});

//Statut Refuser
// requestStatus.addEventListener("change", () => {
//   showDeniedReason();
// });

// function showDeniedReason() {
//   if (requestStatus.value === "denied") {
//     deniedDivReason.classList.remove("d-none");
//     deniedReasonText.removeAttribute("disabled");
//   } 
//   else {
//     deniedDivReason.classList.add("d-none");
//     deniedReasonRequired.style.display = "none";
//     deniedReasonText.classList.remove("is-invalid");
//     deniedReasonText.classList.remove("is-valid");
//   }
// }

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
    const content = popoverLink.getAttribute("data-content") || "";
    const popover = new bootstrap.Popover(popoverLink, {
      content: content,
      trigger: 'click'
    });

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