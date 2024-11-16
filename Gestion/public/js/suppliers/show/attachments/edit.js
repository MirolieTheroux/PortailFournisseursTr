let attachmentsContainer;
let btnCancelAttachments;
let btnEditAttachments;
let btnSaveAttachments;
let removeAttachements;
let filesSize;
let totalSize;
let fileSize;
let tempTotalSize = 0;

document.addEventListener("DOMContentLoaded", function () {
  getAttachmentsSectionElements();
  addAttachmentsSectionListeners();
  getTotalSizeFiles();
  removeFiles();
});

function getAttachmentsSectionElements() {
  attachmentsContainer = document.getElementById("attachments-section");
  btnCancelAttachments = document.getElementById("btnCancelAttachmentFiles");
  btnEditAttachments = document.getElementById("btnEditAttachmentFiles");
  btnSaveAttachments = document.getElementById("btnSaveAttachmentFiles");
  removeAttachements = attachmentsContainer.querySelectorAll(".removeAttachment");
  filesSize = document.getElementById("filesSize");
  totalSize = document.getElementById("totalSize")
  fileSize = attachmentsContainer.querySelectorAll(".fileSize");
  if(removeAttachements.length === 0){
    btnEditAttachments.classList.add("d-none");
    filesSize.classList.add("d-none");
  }   
    
  else
    if(btnEditAttachments)
      btnEditAttachments.classList.remove("d-none");
}

function addAttachmentsSectionListeners() {
  if(btnEditAttachments)
    btnEditAttachments.addEventListener("click",enableAttacmentsSectionEdit);
}

function enableAttacmentsSectionEdit() {
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
        totalSize.textContent = tempTotalSize + "/75mo";
      }
    });
  });
}

function getTotalSizeFiles(){
  fileSize.forEach(file => {
    tempTotalSize += parseInt(file.textContent);
  });
  totalSize.textContent = tempTotalSize + "/75mo";
}