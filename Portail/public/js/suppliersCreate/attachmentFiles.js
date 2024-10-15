const inputFile = document.getElementById("formFile");
const attachmentFileRequired = document.getElementById("attachmentFileRequired");
const divFileName = document.getElementById("fileName");
const divFileSize = document.getElementById("fileSize");
const divAddedFileDate = document.getElementById("addedFileDate");
let fileNameWithoutExtension;
let fileSizeMo;
let totalSizeMo = 0;

document.getElementById("formFile").addEventListener("change", () => {
  attachmentFileRequired.style.display = "none";
  validateFile();
  validateSameFileName();
  if (inputFile.files.length > 0 && validateFileBeforeClick()) {
    const file = inputFile.files[0];
    const fileSizeInMo = (file.size / (1024 * 1024)).toFixed(2);
    fileSizeMo = fileSizeInMo;
    divFileName.textContent = fileNameWithoutExtension;
    divFileSize.textContent = fileSizeInMo;
    divAddedFileDate.textContent = new Date().toLocaleDateString("fr-CA");
  }
  //vérifier la taille aussi ici au cas où le fichier choisi va dépasser le maximum.
});
document.getElementById("add-file").addEventListener("click", () => {
  const attachmentFilesExceedSize = document.getElementById("attachmentFilesExceedSize");
  const inputAttachmentsList = document.getElementById("attachmentList");

  validateFileRequired();
  validateFile();
  validateSameFileName();
  if(validateFileBeforeClick() && totalSizeMo <= 0.25){
    const fileName = document.getElementById("fileName").textContent;
    const fileSize = document.getElementById("fileSize").textContent;
    const addedFileDate = document.getElementById("addedFileDate").textContent;
    

    const fileItem = document.createElement("div");
    fileItem.classList.add("row", "mb-2", "align-items-center", "justify-content-between");

    const fileNameDiv = document.createElement("div");
    fileNameDiv.classList.add("col-6", "fs-6", "text-wrap", "fileName");
    fileNameDiv.textContent = fileName;

    const fileSizeDiv = document.createElement("div");
    fileSizeDiv.classList.add("col-2", "fs-6", "text-center");
    fileSizeDiv.textContent = fileSize;

    const fileDateDiv = document.createElement("div");
    fileDateDiv.classList.add("col-2", "fs-6", "text-center");
    fileDateDiv.textContent = addedFileDate;

    const removeDiv = document.createElement("div");
    removeDiv.classList.add("col-2", "text-center");

    const removeFile = document.createElementNS("http://www.w3.org/2000/svg", "svg");
    removeFile.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    removeFile.setAttribute("width", "38");
    removeFile.setAttribute("height", "38");
    removeFile.setAttribute("fill", "currentColor");
    removeFile.setAttribute("class", "bi bi-trash-fill");
    removeFile.setAttribute("viewBox", "0 0 16 16");
    removeFile.style.cursor = "pointer";
    removeFile.innerHTML = `<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>`;
    
    removeDiv.onclick = () => {
      fileItem.remove();
    };

    removeDiv.appendChild(removeFile);

    fileItem.appendChild(fileNameDiv);
    fileItem.appendChild(fileSizeDiv);
    fileItem.appendChild(fileDateDiv);
    fileItem.appendChild(removeDiv);

    attachmentFilesList.appendChild(fileItem);
    clearInfos()
    inputFile.value = ""; 
    updateTotalSize()
  }
  else{
    console.log("taille dépassée");
    attachmentFilesExceedSize.style.display = "block";
  }
});

//VALIDATIONS
function validateFile(){
  const regexAlphanum = /^[a-zA-Z0-9 ]+$/;
  const attachmentFileNameLength = document.getElementById("attachmentFileNameLength");
  const attachmentFileFormat = document.getElementById("attachmentFileFormat");
  const attachmentFileNameAlphaNum = document.getElementById("attachmentFileNameAlphaNum");
  const validMimeTypes = [
    "application/msword", 
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "application/pdf", 
    "image/jpeg", 
    "image/png", 
    "image/bmp", 
    "image/tiff", 
    "text/plain", 
    "application/rtf", 
    "application/vnd.oasis.opendocument.text",
    "application/vnd.ms-excel",
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    "application/vnd.ms-powerpoint", 
    "application/vnd.openxmlformats-officedocument.presentationml.presentation" 
  ];
  fileNameWithoutExtension = inputFile.files[0].name.substring(0, inputFile.files[0].name.lastIndexOf("."))
  // Reset all error messages
  attachmentFileNameLength.style.display = "none";
  attachmentFileFormat.style.display = "none";
  attachmentFileNameAlphaNum.style.display = "none";
  // Basic validation logic
  if (inputFile.files[0].name.length > 32){
    inputFile.classList.remove("is-valid");
    inputFile.classList.add("is-invalid");
    attachmentFileNameLength.style.display = "block";
  } else if (!regexAlphanum.test(fileNameWithoutExtension)) {
    inputFile.classList.remove("is-valid");
    inputFile.classList.add("is-invalid");
    attachmentFileNameAlphaNum.style.display = "block";
  }
  else if (!validMimeTypes.includes(inputFile.files[0].type)){
    inputFile.classList.remove("is-valid");
    inputFile.classList.add("is-invalid");
    attachmentFileFormat.style.display = "block";
  }
  else{
    inputFile.classList.remove("is-invalid");
    inputFile.classList.add("is-valid");
  }
  inputFile.classList.add("was-validated");
}

function validateFileRequired(){
  // Reset all error messages
  attachmentFileRequired.style.display = "none";
  // Basic validation logic
  if(inputFile.files.length === 0){
    inputFile.classList.remove("is-valid");
    inputFile.classList.add("is-invalid");
    attachmentFileRequired.style.display = "block";
  }
  else{
    inputFile.classList.remove("is-invalid");
    inputFile.classList.add("is-valid");
  }
  inputFile.classList.add("was-validated");
}

function validateSameFileName(){
  const attachmentSameFileName = document.getElementById("attachmentSameFileName");
  const allDivsFileName = document.querySelectorAll(".fileName");
  let isFileName = false;
  allDivsFileName.forEach(file => {
    if(file.textContent === fileNameWithoutExtension)
      isFileName = true;
  });
  // Reset all error messages
  attachmentSameFileName.style.display = "none";
  // Basic validation logic
  if(isFileName){
    inputFile.classList.remove("is-valid");
    inputFile.classList.add("is-invalid");
    attachmentSameFileName.style.display = "block";
  }
}

function validateFileBeforeClick(){
  const attachmentErrorMessages = document.querySelectorAll(".attachment");
  let isValid = true;
  attachmentErrorMessages.forEach(errorMessage => {
    if(errorMessage.style.display == "block")
      isValid = false;
  });
  return isValid;
}

function updateTotalSize(){
  const pTotalSize = document.getElementById("totalSize");
  totalSizeMo += parseFloat(fileSizeMo);
  pTotalSize.textContent = totalSizeMo.toFixed(2) + " Mo" + "/75 Mo";
}

function clearInfos(){
  divFileName.textContent = "";
  divFileSize.textContent = "";
  divAddedFileDate.textContent = "";
  inputFile.classList.remove("is-valid");
}


document.getElementById("attachmentFiles-button").addEventListener("click", () =>{
 validateFile()
});

window.addEventListener("beforeunload", () => {
  inputFile.value = ""; 
});