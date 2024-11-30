let attachmentsContainer;
let addAttachementsContainer;
let btnCancelAttachments;
let btnEditAttachments;
let btnSaveAttachments;
let removeAttachements;
let totalSizeUpdate;
let fileSizeUpdate;
let tempTotalSize = 0;
let maxSizeFiles;

document.addEventListener("DOMContentLoaded", function () {
  getAttachmentsSectionElements();
  addAttacmentsSectionListeners();
  getTotalSizeFiles();
  removeFiles();
});

function getAttachmentsSectionElements() {
  attachmentsContainer = document.getElementById("attachments-section");
  addAttachementsContainer = document.getElementById("addAttachmentsContainer");
  btnCancelAttachments = document.getElementById("btnCancelAttachmentFiles");
  btnEditAttachments = document.getElementById("btnEditAttachmentFiles");
  btnSaveAttachments = document.getElementById("btnSaveAttachmentFiles");
  removeAttachements = attachmentsContainer.querySelectorAll(".removeAttachment");
  totalSizeUpdate = document.getElementById("totalSize")
  fileSizeUpdate = attachmentsContainer.querySelectorAll(".fileSize");
  maxSizeFiles = document.getElementById("maxSizeFiles")
  //console.log(maxSizeFiles.textContent);
}

function addAttacmentsSectionListeners() {
  btnEditAttachments.addEventListener("click",enableAttacmentsSectionEdit);
}

function enableAttacmentsSectionEdit() {
  addAttachementsContainer.classList.remove("d-none");
  btnCancelAttachments.classList.remove("d-none");
  btnSaveAttachments.classList.remove("d-none");
  btnEditAttachments.classList.add("d-none");
  removeAttachements.forEach(attachment =>{
    attachment.classList.remove("d-none")
  });
}

function removeFiles(){
  removeAttachements.forEach(removeAttachment => {
    removeAttachment.addEventListener("click", function (){
      const divAttachment = removeAttachment.closest(".d-flex");
      if(divAttachment){
        const fileSizeDiv = divAttachment.querySelector(".fileSize");
        const fileSize = parseFloat(fileSizeDiv.textContent);
        divAttachment.remove();
        tempTotalSize -= fileSize; 
        totalSizeUpdate.textContent = tempTotalSize + "/" + maxSizeFiles.textContent + "mo";
       
        //Variable from /js/suppliersCreate/attachmentFiles.js
        totalSizeMo = tempTotalSize;
      }
    });
  });
}

function getTotalSizeFiles(){
  fileSizeUpdate.forEach(file => {
    tempTotalSize += parseInt(file.textContent);
  });

  totalSizeUpdate.textContent = tempTotalSize + "/" + maxSizeFiles.textContent + "mo";  

  //Variable from /js/suppliersCreate/attachmentFiles.js
  totalSizeMo = tempTotalSize;
}