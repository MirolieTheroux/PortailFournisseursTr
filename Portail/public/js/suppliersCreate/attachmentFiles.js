document.getElementById("formFile").addEventListener("change", () => {
  const input = document.getElementById('formFile');
  const divFileName = document.getElementById("fileName");
  const divFileSize = document.getElementById("fileSize");
  const divAddedFileDate = document.getElementById("addedFileDate");
  if (input.files.length > 0) {
    const file = input.files[0];
    const fileSizeInMo = (file.size / (1024 * 1024)).toFixed(2);
    divFileName.textContent = file.name;
    divFileSize.textContent = fileSizeInMo;
    divAddedFileDate.textContent = new Date().toLocaleDateString("fr-CA");
  }
});

document.getElementById("add-file").addEventListener("click", () => {
  const fileName = document.getElementById("fileName").textContent;
  const fileSize = document.getElementById("fileSize").textContent;
  const addedFileDate = document.getElementById("addedFileDate").textContent;

  const fileItem = document.createElement('div');
  fileItem.classList.add("row", "mb-2", "align-items-center", "justify-content-between");

  const fileNameDiv = document.createElement('div');
  fileNameDiv.classList.add('col-6', 'fs-6');
  fileNameDiv.textContent = fileName;

  const fileSizeDiv = document.createElement('div');
  fileSizeDiv.classList.add('col-2', 'fs-6', 'text-center');
  fileSizeDiv.textContent = fileSize;

  const fileDateDiv = document.createElement('div');
  fileDateDiv.classList.add('col-2', 'fs-6', 'text-center');
  fileDateDiv.textContent = addedFileDate;

  const actionsDiv = document.createElement('div');
  actionsDiv.classList.add('col-2', 'text-center');

  // Créer le SVG
  const removeFile = document.createElementNS("http://www.w3.org/2000/svg", "svg");
  removeFile.setAttribute("xmlns", "http://www.w3.org/2000/svg");
  removeFile.setAttribute("width", "38");
  removeFile.setAttribute("height", "38");
  removeFile.setAttribute("fill", "currentColor");
  removeFile.setAttribute("class", "bi bi-trash-fill");
  removeFile.setAttribute("viewBox", "0 0 16 16");
  removeFile.style.cursor = "pointer";
  removeFile.innerHTML = `
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
          `;


  removeFile.onclick = () => {
    fileItem.remove();
  };

  actionsDiv.appendChild(removeFile);

  fileItem.appendChild(fileNameDiv);
  fileItem.appendChild(fileSizeDiv);
  fileItem.appendChild(fileDateDiv);
  fileItem.appendChild(actionsDiv);

  attachmentFilesList.appendChild(fileItem);
});