let btnListSelectedSupplier;
let selectAllCheck;
let supplierChecks;

document.addEventListener("DOMContentLoaded", function () {
  getSuppliersListElements();
});

function getSuppliersListElements(){
  btnListSelectedSupplier = document.getElementById("btnListSelectedSupplier");
  btnListSelectedSupplier.addEventListener('click', ()=>{
    sendSelectedSuppliersForm();
  });

  selectAllCheck = document.getElementById('selectAllCheck');
  selectAllCheck.addEventListener('change', (event)=>{
    selectAllSuppliers(event.target.checked);
  });

  supplierChecks = document.querySelectorAll('.supplier-select-check');
  addHideSendButtonListeners();
}

function sendSelectedSuppliersForm(){
  document.getElementById("suppliersListForm").submit();
}

function selectAllSuppliers(isChecked){
  supplierChecks.forEach(check => {
    check.checked = isChecked;
  });
  hideSendButton();
}

function addHideSendButtonListeners(){
  supplierChecks.forEach(check => {
    check.addEventListener('change', ()=>{
      hideSendButton();
      checkSelectAll();
    });
  });
}

function hideSendButton(){
  const checkedCount = countCheckedChecks();
  if(checkedCount >= 1){
    btnListSelectedSupplier.classList.remove('d-none');
  }
  else{
    btnListSelectedSupplier.classList.add('d-none');
  }
}

function checkSelectAll(){
  const checkedCount = countCheckedChecks();
  if(checkedCount === 0){
    selectAllCheck.checked = false;
  }
  else if(checkedCount === supplierChecks.length){
    selectAllCheck.checked = true;
  }
}

function countCheckedChecks(){
  let checkedCounter = 0;
  supplierChecks.forEach(check => {
    if(check.checked){
      checkedCounter++;
    }
  });
  return checkedCounter;
}