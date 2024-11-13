let attachmentsContainer;
let btnCancelAttachments;
let btnEditAttachments;
let btnSaveAttachments;
let attachmentForm;

document.addEventListener("DOMContentLoaded", function () {
  getAttachmentsSectionElements();
  addAttacmentsSectionListeners();
});

function getAttachmentsSectionElements() {
  attachmentsContainer = document.getElementById("attachments-section");
  btnCancelAttachments = document.getElementById("btnCancelAttachmentFiles");
  btnEditAttachments = document.getElementById("btnEditAttachmentFiles");
  btnSaveAttachments = document.getElementById("btnSaveAttachmentFiles");
  attachmentForm = attachmentsContainer.getElementsByClassName("attachments");
}

function addAttacmentsSectionListeners() {
  btnEditAttachments.addEventListener("click",enableAttacmentsSectionEdit);
}

function enableAttacmentsSectionEdit() {
  btnCancelAttachments.classList.remove("d-none");
  btnSaveAttachments.classList.remove("d-none");
  btnEditAttachments.classList.add("d-none");
  for (let index = 0; index < attachmentForm.length; index++) {
    attachmentForm[index].classList.remove("d-none");
  }
}