function addSelectedListener(){
  const contactedButton = document.getElementsByClassName('contactedButton');
  for(let i=0 ; i<contactedButton.length ; i++){
    contactedButton[i].addEventListener('click', (event)=>{
      const button = event.target;
      markSelected(button)
    })
  }
  
}

function markSelected(button){
  const container = button.closest('.container');
  if(container.classList.contains('bg-white')){
    container.classList.remove('bg-white');
    container.classList.add('bg-green');

    const selectedInput = container.querySelector('input').cloneNode();
    selectedInput.name = 'selectedSupplierIds[]';
    selectedInput.classList.add('selectedSupplierInput');
    container.prepend(selectedInput);

    saveSelectedContact(container);
  }
  else{
    container.classList.remove('bg-green');
    container.classList.add('bg-white');

    const selectedInputs = container.querySelectorAll('.selectedSupplierInput');
    for (let index = 0; index < selectedInputs.length; index++) {
      const input = selectedInputs[index];
      input.remove();
    }
  }

}

function saveSelectedContact(supplierContainer){
  const selectedContactInputs = supplierContainer.querySelectorAll('.selectedSupplierContactInput');
  for (let index = 0; index < selectedContactInputs.length; index++) {
    const input = selectedContactInputs[index];
    input.remove();
  }

  const selectedContactContainer = supplierContainer.querySelector('.contactContainer:not(.d-none)');
  const selectedContactNameFonction = selectedContactContainer.querySelector('.contactName').innerHTML;
  const selectedContactName = selectedContactNameFonction.split(',')[0];

  const contactNameInput = supplierContainer.querySelector('input').cloneNode();
  contactNameInput.name = 'selectedSupplierContactNames[]';
  contactNameInput.classList.add('selectedSupplierInput');
  contactNameInput.classList.add('selectedSupplierContactInput');
  contactNameInput.value = selectedContactName;
  supplierContainer.prepend(contactNameInput);
}

function changeContactSavedName(event){
  let button;
  if(event.target instanceof SVGElement){
    button = event.target.parentElement;
  }
  else{
    button = event.target;
  }

  const supplierContainer = button.closest('.container')
  const selectedInputs = supplierContainer.querySelectorAll('.selectedSupplierInput')
  
  if(selectedInputs.length > 0)
    saveSelectedContact(supplierContainer)
}


document.addEventListener("DOMContentLoaded", async function () {
  addSelectedListener();
});