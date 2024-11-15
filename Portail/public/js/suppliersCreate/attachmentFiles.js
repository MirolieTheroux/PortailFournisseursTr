const inputFile = document.getElementById("formFile");
const fileName = document.getElementById("fileName");
const fileSize = document.getElementById("fileSize");
const addedFileDate = document.getElementById("addedFileDate");
const inputValue = document.getElementById("valueInput");
//Error messages DIV
const attachmentFileRequired = document.getElementById("attachmentFileRequired");
const attachmentFileNameLength = document.getElementById("attachmentFileNameLength");
const attachmentFileFormat = document.getElementById("attachmentFileFormat");
const attachmentFileNameAlphaNum = document.getElementById("attachmentFileNameAlphaNum");
const attachmentSameFileName = document.getElementById("attachmentSameFileName");
const attachmentFilesExceedSize = document.getElementById("attachmentFilesExceedSize");

let pTotalSize = document.getElementById("totalSize");
let fileNameWithoutExtension;
let fileSizeMo;
let totalSizeMo = 0;

document.getElementById("formFile").addEventListener("change", () => {
  // Reset all error messages
  attachmentFileNameLength.style.display = "none";
  attachmentFileFormat.style.display = "none";
  attachmentFileNameAlphaNum.style.display = "none";
  attachmentSameFileName.style.display = "none";
  attachmentFileRequired.style.display = "none";
  attachmentFilesExceedSize.style.display = "none";
  validateFile();
  if (inputFile.files.length > 0) {
    const file = inputFile.files[0];
    const fileSizeInMo = (file.size / (1024 * 1024)).toFixed(2);
    fileSizeMo = fileSizeInMo;
    fileName.textContent = fileNameWithoutExtension;
    fileSize.textContent = fileSizeInMo;
    addedFileDate.textContent = new Date().toLocaleDateString("fr-CA");
    inputValue.textContent = inputFile.value;
  }
});

document.getElementById("add-file").addEventListener("click", () => {
  validateFileRequired();
  validateFile();
  validateSameFileName();
  validateTotalSize(inputFile.files[0].size/(1024 * 1024).toFixed(2));

  if(validateFileBeforeClick()){
    const fileItem = document.createElement("div");
    fileItem.classList.add("row", "mb-2", "align-items-center", "justify-content-between");
    //INPUT FILEFORM
    const fileForm = inputFile.cloneNode(true);
    fileForm.classList.add("d-none");
    fileForm.removeAttribute("id");
    console.log(fileForm.files);
    
    fileForm.setAttribute("name", "files[]");
    //DIV FILE NAME
    const fileNameDiv = document.createElement("div");
    fileNameDiv.classList.add("col-6", "fs-6", "text-wrap", "fileName");
    fileNameDiv.textContent = fileName.textContent;
    const inputFileNameHidden = document.createElement("input");
    inputFileNameHidden.value = fileName.textContent;
    inputFileNameHidden.classList.add("d-none");
    inputFileNameHidden.setAttribute("name", "fileNames[]");
    //DIV FILE SIZE
    const fileSizeDiv = document.createElement("div");
    fileSizeDiv.classList.add("col-2", "fs-6", "text-center", "fileSize");
    fileSizeDiv.textContent = fileSize.textContent;
    const inputFileSizeHidden = document.createElement("input");
    inputFileSizeHidden.value = fileSize.textContent;
    inputFileSizeHidden.classList.add("d-none");
    inputFileSizeHidden.setAttribute("name", "fileSizes[]");
    //DIV FILE ADDED DATE
    const fileDateDiv = document.createElement("div");
    fileDateDiv.classList.add("col-2", "fs-6", "text-center", "addedFileDate");
    fileDateDiv.textContent = addedFileDate.textContent;
    const inputAddedFileDateHidden = document.createElement("input");
    inputAddedFileDateHidden.value = addedFileDate.textContent;
    inputAddedFileDateHidden.classList.add("d-none");
    inputAddedFileDateHidden.setAttribute("name", "addedFileDates[]");
    //TYPES
    const inputFileTypeHidden = document.createElement("input");
    inputFileTypeHidden.value = inputFile.files[0].type;
    inputFileTypeHidden.classList.add("d-none");
    inputFileTypeHidden.setAttribute("name", "fileTypes[]");

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
      const fileSize = parseFloat(fileSizeDiv.textContent); 
      fileItem.remove();
      totalSizeMo -= fileSize; 
      pTotalSize.textContent = totalSizeMo.toFixed(2) + " Mo" + "/75 Mo";
      inputFile.classList.remove("is-valid");
      inputFile.classList.remove("is-invalid");
      if(inputFile.files.length > 0){
        validateSameFileName();
        validateTotalSize(inputFile.files[0].size/(1024 * 1024).toFixed(2));
      }
    };
    removeDiv.appendChild(removeFile);

    fileItem.appendChild(fileNameDiv);
    fileItem.appendChild(fileSizeDiv);
    fileItem.appendChild(fileDateDiv);
    fileItem.appendChild(removeDiv);
    fileItem.appendChild(fileForm);
    fileItem.appendChild(inputFileNameHidden);
    fileItem.appendChild(inputFileSizeHidden);
    fileItem.appendChild(inputAddedFileDateHidden);

    attachmentFilesList.appendChild(fileItem);
    
    clearInfos()
    inputFile.value = ""; 
    updateTotalSize();
  }
});

//VALIDATIONS
function validateFile(){
  const regexAlphanum = /^[a-zA-Z0-9 ]+$/;
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
  if(inputFile.files[0] !== undefined){
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

function validateTotalSize(size){
  let addedSize = parseFloat(size) + totalSizeMo;
  if(addedSize > 75){
    inputFile.classList.remove("is-valid");
    inputFile.classList.add("is-invalid");
    attachmentFilesExceedSize.style.display = "block";
  }
  else{
    attachmentFilesExceedSize.style.display = "none";
    inputFile.classList.add("is-valid");
    inputFile.classList.remove("is-invalid");
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
  totalSizeMo += parseFloat(fileSizeMo);
  pTotalSize.textContent = totalSizeMo.toFixed(2) + " Mo" + "/75 Mo";
}

function clearInfos(){
  fileName.textContent = "";
  fileSize.textContent = "";
  addedFileDate.textContent = "";
  inputFile.classList.remove("is-valid");
}

document.addEventListener("DOMContentLoaded", function () {
  const buttonsDelete = document.querySelectorAll(".removeFile");
  buttonsDelete.forEach(button => {
    const conteneurButton = button.closest(".divFile");
    button.addEventListener("click", () => {
      conteneurButton.remove();
    });
  });
});

window.addEventListener("beforeunload", () => {
  inputFile.value = ""; 
});