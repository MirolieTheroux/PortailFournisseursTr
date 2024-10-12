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