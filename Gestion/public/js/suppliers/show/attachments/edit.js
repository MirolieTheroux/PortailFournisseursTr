let attachmentsContainer;
let btnCancelAttachments;
let btnEditAttachments;
let btnSaveAttachments;
let attachmentForm;
let attachmentInput;
let removeAttachements;
let filesSize;
let totalSize;
let fileSize;
let tempTotalSize = 0;

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
  removeAttachements = attachmentsContainer.querySelectorAll(".removeAttachment");
  filesSize = document.getElementById("filesSize");
  totalSize = document.getElementById("totalSize")
  fileSize = attachmentsContainer.querySelectorAll(".fileSize");
}

function addAttacmentsSectionListeners() {
  btnEditAttachments.addEventListener("click",enableAttacmentsSectionEdit);
}

function enableAttacmentsSectionEdit() {
  btnCancelAttachments.classList.remove("d-none");
  btnSaveAttachments.classList.remove("d-none");
  btnEditAttachments.classList.add("d-none");
  filesSize.classList.remove("d-none")
  attachmentInput.removeAttribute("disabled");
  for (let index = 0; index < attachmentForm.length; index++) {
    attachmentForm[index].classList.remove("d-none");
  }
  removeAttachements.forEach(attachment =>{
    attachment.classList.remove("d-none")
  });
  getTotalSizeFiles();
}

function getTotalSizeFiles(){
  fileSize.forEach(file => {
    tempTotalSize += parseInt(file.textContent);
  });
  totalSize.textContent = tempTotalSize + "/75mo";
}