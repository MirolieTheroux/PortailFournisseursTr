function sendSelectedSuppliersForm(){
  document.getElementById("suppliersListForm").submit();
}

function selectAllSuppliers(isChecked){
  const supplierChecks = document.querySelectorAll('.supplier-select-check');
  supplierChecks.forEach(check => {
    check.checked = isChecked;
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const btnListSelectedSupplier = document.getElementById("btnListSelectedSupplier");
  btnListSelectedSupplier.addEventListener('click', ()=>{
    sendSelectedSuppliersForm();
  });

  const selectAllCheck = document.getElementById('selectAllCheck');
  selectAllCheck.addEventListener('change', (event)=>{
    selectAllSuppliers(event.target.checked);
  });
});