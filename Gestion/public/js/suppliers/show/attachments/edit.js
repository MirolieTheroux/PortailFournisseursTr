let attachmentsContainer;
let btnCancelAttachments;
let btnEditAttachments;
let btnSaveAttachments;
let attachmentForm;
let attachmentInput;
let removeAttachements;

document.addEventListener("DOMContentLoaded", function () {
  getAttachmentsSectionElements();
  addAttacmentsSectionListeners();
});

function getAttachmentsSectionElements() {
  attachmentsContainer = document.getElementById("attachments-section");
  btnCancelAttachments = document.getElementById("btnCancelAttachmentFiles");
  btnEditAttachments = document.getElementById("btnEditAttachmentFiles");
  btnSaveAttachments = document.getElementById("btnSaveAttachmentFiles");
  attachmentInput = document.getElementById("formFile");
  attachmentForm = attachmentsContainer.getElementsByClassName("attachments");
  removeAttachements = attachmentsContainer.getElementsByClassName("removeAttachment");
}

function addAttacmentsSectionListeners() {
  btnEditAttachments.addEventListener("click",enableAttacmentsSectionEdit);
}

function enableAttacmentsSectionEdit() {
  btnCancelAttachments.classList.remove("d-none");
  btnSaveAttachments.classList.remove("d-none");
  btnEditAttachments.classList.add("d-none");
  attachmentInput.removeAttribute("disabled");
  for (let index = 0; index < attachmentForm.length; index++) {
    attachmentForm[index].classList.remove("d-none");
  }
  for (let index = 0; index < removeAttachements.length; index++) {
    removeAttachements[index].classList.remove("d-none");
  }
}

function removeFilesAlreadyThere(){

}