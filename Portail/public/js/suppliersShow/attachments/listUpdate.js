let addToListButton;
let emptyListDisplay;
let listHeader;
let attachmentListContainer;
let removeAttachmentbuttons;

document.addEventListener("DOMContentLoaded", function () {
  getAttachmentsListUpdateElements();
  addAttachmentsListUpdateListeners();
});

function getAttachmentsListUpdateElements(){
  addToListButton = document.getElementById('add-file');
  emptyListDisplay = document.getElementById('emptyListDisplay');
  listHeader = document.getElementById('listHeader');
  attachmentListContainer = document.getElementById('attachmentFilesList');
  removeAttachmentbuttons = document.querySelectorAll('.removeAttachment');
}

function addAttachmentsListUpdateListeners(){
  addToListButton.addEventListener('click', updateListHeader)

  removeAttachmentbuttons.forEach(button => {
    button.addEventListener('click', updateListHeader)
  });
}

function updateListHeader(){
  if(isListEmpty()){
    displayEmpty();
  }
  else{
    displayHeader();
  }
}

function isListEmpty(){
  const attachmentList = attachmentListContainer.children;
  const isEmpty = attachmentList.length === 0;
  return isEmpty;
}

function displayEmpty(){
  emptyListDisplay.classList.remove('d-none');
  listHeader.classList.add('d-none');
}

function displayHeader(){
  listHeader.classList.remove('d-none');
  emptyListDisplay.classList.add('d-none');
}