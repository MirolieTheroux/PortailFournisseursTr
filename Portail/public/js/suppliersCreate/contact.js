/*** Section Contacts ***/


document.addEventListener('DOMContentLoaded', function() {
  let contactNumber = 1;
  const contactsRow = document.getElementById('contactsRow');
  const referenceContainer = document.getElementById('referenceContact');

  const addContactButton = document.querySelector('.add-contact');
  addContactButton.addEventListener("click", cloneContact);

  const delContactButton = referenceContainer.querySelector('.delete-contact');
  delContactButton.addEventListener("click", function(){
    referenceContainer.remove();
    maskButton();
  });
  maskButton();

  const subtitle = contactsRow.querySelector('#contactSubtitle1');
  const firstnameInput = contactsRow.querySelector('#contactFirstName1');
  const firstnameLabel = contactsRow.querySelector('#contactFirstNameLabel1');
  const lastnameInput = contactsRow.querySelector('#contactLastName1');
  const lastnameLabel = contactsRow.querySelector('#contactLastNameLabel1');
  const jobInput = contactsRow.querySelector('#contactJob1');
  const jobLabel = contactsRow.querySelector('#contactJobLabel1');
  const emailInput = contactsRow.querySelector('#contactEmail1');
  const emailLabel = contactsRow.querySelector('#contactEmailLabel1');
  const telTypeInput = contactsRow.querySelector('#contactTelType1');
  const telTypeLabel = contactsRow.querySelector('#contactTelTypeLabel1');
  const telnumberInput = contactsRow.querySelector('#contactTelNumber1');
  const telNumberLabel = contactsRow.querySelector('#contactTelNumberLabel1');
  const telExtensionInput = contactsRow.querySelector('#contactTelExtension1');
  const telExtensionLabel = contactsRow.querySelector('#contactTelExtensionLabel1');



  function cloneContact(){
    contactNumber++;

    const newContact = referenceContainer.cloneNode(true);

    const newDeleteContactButton = newContact.querySelector(".delete-contact");
    newDeleteContactButton.classList.remove('d-none');
    newDeleteContactButton.addEventListener("click", function(){
      newContact.remove();
      maskButton();
    });

    const newSubtitle = newContact.querySelector('#' + subtitle.getAttribute("id"));
    newSubtitle.setAttribute("id", newSubtitle.getAttribute("id").slice(0, -1) + contactNumber);

    const newFirstnameInput = newContact.querySelector('#'+firstnameInput.getAttribute("id"));
    newFirstnameInput.setAttribute("id", firstnameInput.getAttribute("id").slice(0, -1) + contactNumber);
    newFirstnameInput.value = "";
    const newFirstnameLabel = newContact.querySelector('#'+firstnameLabel.getAttribute("id"));
    newFirstnameLabel.setAttribute("id", newFirstnameLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newFirstnameLabel.setAttribute("for", newFirstnameInput.getAttribute("id"));
  
    const newlastnameInput = newContact.querySelector('#'+lastnameInput.getAttribute("id"));
    newlastnameInput.setAttribute("id", newlastnameInput.getAttribute("id").slice(0, -1) + contactNumber);
    newlastnameInput.value = "";
    const newlastnameLabel = newContact.querySelector('#'+lastnameLabel.getAttribute("id"));
    newlastnameLabel.setAttribute("id", newlastnameLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newlastnameLabel.setAttribute("for", newlastnameInput.getAttribute("id"));
  
    const newJobInput = newContact.querySelector('#'+jobInput.getAttribute("id"));
    newJobInput.setAttribute("id", newJobInput.getAttribute("id").slice(0, -1) + contactNumber);
    newJobInput.value = "";
    const newJobLabel = newContact.querySelector('#'+jobLabel.getAttribute("id"));
    newJobLabel.setAttribute("id", newJobLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newJobLabel.setAttribute("for", newJobInput.getAttribute("id"));
  
    const newEmailInput = newContact.querySelector('#'+emailInput.getAttribute("id"));
    newEmailInput.setAttribute("id", newEmailInput.getAttribute("id").slice(0, -1) + contactNumber);
    newEmailInput.value = "";
    const newEmailLabel = newContact.querySelector('#'+emailLabel.getAttribute("id"));
    newEmailLabel.setAttribute("id", newEmailLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newEmailLabel.setAttribute("for", newEmailInput.getAttribute("id"));
  
    const newTelTypeInput = newContact.querySelector('#'+telTypeInput.getAttribute("id"));
    newTelTypeInput.setAttribute("id", newTelTypeInput.getAttribute("id").slice(0, -1) + contactNumber);
    newTelTypeInput.value = "desktop";
    const newTelTypeLabel = newContact.querySelector('#'+telTypeLabel.getAttribute("id"));
    newTelTypeLabel.setAttribute("id", newTelTypeLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newTelTypeLabel.setAttribute("for", newTelTypeInput.getAttribute("id"));
  
    const newTelnumberInput = newContact.querySelector('#'+telnumberInput.getAttribute("id"));
    newTelnumberInput.setAttribute("id", newTelnumberInput.getAttribute("id").slice(0, -1) + contactNumber);
    newTelnumberInput.value = "";
    const newTelNumberLabel = newContact.querySelector('#'+telNumberLabel.getAttribute("id"));
    newTelNumberLabel.setAttribute("id", newTelNumberLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newTelNumberLabel.setAttribute("for", newTelnumberInput.getAttribute("id"));
  
    const newTelExtensionInput = newContact.querySelector('#'+telExtensionInput.getAttribute("id"));
    newTelExtensionInput.setAttribute("id", newTelExtensionInput.getAttribute("id").slice(0, -1) + contactNumber);
    newTelExtensionInput.value = "";
    const newTelExtensionLabel = newContact.querySelector('#'+telExtensionLabel.getAttribute("id"));
    newTelExtensionLabel.setAttribute("id", newTelExtensionLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newTelExtensionLabel.setAttribute("for", newTelExtensionInput.getAttribute("id"));

    contactsRow.append(newContact);
    maskButton();
  }

  function maskButton(){
    let delContactButtons = document.querySelectorAll('.delete-contact');
    if(delContactButtons.length === 1){
      delContactButtons.forEach(button => {
        button.classList.add('d-none')
      });
    }
    else{
      delContactButtons.forEach(button => {
        button.classList.remove('d-none')
      });
    }
  }

});