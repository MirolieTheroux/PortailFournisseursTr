let contactDetailsContainer;
let btnCancelcontactDetails;
let btnModifyContactDetails;
let btnSaveContactDetails;
let contactDetailsInputs;
let contactDetailsSelects;
let addPhone;
let svgRemovePhone;

document.addEventListener("DOMContentLoaded", function () {
  getContactDetailsSectionElements();
  addContactDetailsSectionListeners();
  removePhoneNumberAlreadyThere();
});

function getContactDetailsSectionElements() {
  contactDetailsContainer = document.getElementById("contactDetails-section");
  btnCancelcontactDetails = document.getElementById("btnCancelContactDetails");
  btnSaveContactDetails = document.getElementById("btnSaveContactDetails");
  btnModifyContactDetails = document.getElementById("btnModifyContactDetails");
  contactDetailsInputs = contactDetailsContainer.getElementsByClassName("form-control");
  contactDetailsSelects = contactDetailsContainer.getElementsByClassName("form-select");
  addPhone = document.getElementById("addPhone");
  svgRemovePhone = contactDetailsContainer.querySelectorAll(".removePhone");
}

function addContactDetailsSectionListeners() {
  btnModifyContactDetails.addEventListener("click",enableContactDetailsSectionEdit);
}

function enableContactDetailsSectionEdit() {
  btnCancelcontactDetails.classList.remove("d-none");
  btnSaveContactDetails.classList.remove("d-none");
  btnModifyContactDetails.classList.add("d-none");
  addPhone.classList.remove("d-none");
  for (let index = 0; index < contactDetailsInputs.length; index++) {
    contactDetailsInputs[index].removeAttribute("disabled");
  }
  for (let index = 0; index < contactDetailsSelects.length; index++) {
    contactDetailsSelects[index].removeAttribute("disabled");
  }
  svgRemovePhone.forEach(svg => {
    svg.classList.remove("d-none");
  });
  addCitiesAndDAInSelect();
  emptyNAinputsContactDetails();
  //à tester avec une province autre que QC 
  provinceContactDetails.value = selectedProvince;
}

function emptyNAinputsContactDetails() {
  const inputs = contactDetailsContainer.querySelectorAll(".form-control");
  inputs.forEach((input) => {
    if (input.value === "N/A") {
      input.value = "";
    }
  });
}