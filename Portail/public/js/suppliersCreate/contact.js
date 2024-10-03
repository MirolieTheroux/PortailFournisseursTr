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
  const telTypeInputA = contactsRow.querySelector('#contactTelTypeA1');
  const telTypeLabelA = contactsRow.querySelector('#contactTelTypeLabelA1');
  const telTypeInputB = contactsRow.querySelector('#contactTelTypeB1');
  const telTypeLabelB = contactsRow.querySelector('#contactTelTypeLabelB1');
  const telnumberInputA = contactsRow.querySelector('#contactTelNumberA1');
  const telNumberLabelA = contactsRow.querySelector('#contactTelNumberLabelA1');
  const telnumberInputB = contactsRow.querySelector('#contactTelNumberA1');
  const telNumberLabelB = contactsRow.querySelector('#contactTelNumberLabelA1');
  const telExtensionInputA = contactsRow.querySelector('#contactTelExtensionA1');
  const telExtensionLabelA = contactsRow.querySelector('#contactTelExtensionLabelA1');
  const telExtensionInputB = contactsRow.querySelector('#contactTelExtensionA1');
  const telExtensionLabelB = contactsRow.querySelector('#contactTelExtensionLabelA1');



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
    newFirstnameInput.setAttribute("oninput", "validateContactsName('"+newFirstnameInput.getAttribute("id")+"')");
    newFirstnameInput.value = "";
    newFirstnameInput.classList.remove('is-valid');
    newFirstnameInput.classList.remove('is-invalid');
    const newFirstnameLabel = newContact.querySelector('#'+firstnameLabel.getAttribute("id"));
    newFirstnameLabel.setAttribute("id", newFirstnameLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newFirstnameLabel.setAttribute("for", newFirstnameInput.getAttribute("id"));
  
    const newlastnameInput = newContact.querySelector('#'+lastnameInput.getAttribute("id"));
    newlastnameInput.setAttribute("id", newlastnameInput.getAttribute("id").slice(0, -1) + contactNumber);
    newlastnameInput.setAttribute("oninput", "validateContactsName('"+newlastnameInput.getAttribute("id")+"')");
    newlastnameInput.value = "";
    newlastnameInput.classList.remove('is-valid');
    newlastnameInput.classList.remove('is-invalid');
    const newlastnameLabel = newContact.querySelector('#'+lastnameLabel.getAttribute("id"));
    newlastnameLabel.setAttribute("id", newlastnameLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newlastnameLabel.setAttribute("for", newlastnameInput.getAttribute("id"));
  
    const newJobInput = newContact.querySelector('#'+jobInput.getAttribute("id"));
    newJobInput.setAttribute("id", newJobInput.getAttribute("id").slice(0, -1) + contactNumber);
    newJobInput.setAttribute("oninput", "validateContactsJob('"+newJobInput.getAttribute("id")+"')");
    newJobInput.value = "";
    newJobInput.classList.remove('is-valid');
    newJobInput.classList.remove('is-invalid');
    const newJobLabel = newContact.querySelector('#'+jobLabel.getAttribute("id"));
    newJobLabel.setAttribute("id", newJobLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newJobLabel.setAttribute("for", newJobInput.getAttribute("id"));
  
    const newEmailInput = newContact.querySelector('#'+emailInput.getAttribute("id"));
    newEmailInput.setAttribute("id", newEmailInput.getAttribute("id").slice(0, -1) + contactNumber);
    newEmailInput.setAttribute("oninput", "validateContactsEmail('"+newEmailInput.getAttribute("id")+"')");
    newEmailInput.value = "";
    newEmailInput.classList.remove('is-valid');
    newEmailInput.classList.remove('is-invalid');
    const newEmailLabel = newContact.querySelector('#'+emailLabel.getAttribute("id"));
    newEmailLabel.setAttribute("id", newEmailLabel.getAttribute("id").slice(0, -1) + contactNumber);
    newEmailLabel.setAttribute("for", newEmailInput.getAttribute("id"));
  
    const newtelTypeInputA = newContact.querySelector('#'+telTypeInputA.getAttribute("id"));
    newtelTypeInputA.setAttribute("id", newtelTypeInputA.getAttribute("id").slice(0, -1) + contactNumber);
    newtelTypeInputA.value = "desktop";
    const newtelTypeLabelA = newContact.querySelector('#'+telTypeLabelA.getAttribute("id"));
    newtelTypeLabelA.setAttribute("id", newtelTypeLabelA.getAttribute("id").slice(0, -1) + contactNumber);
    newtelTypeLabelA.setAttribute("for", newtelTypeInputA.getAttribute("id"));
  
    const newtelTypeInputB = newContact.querySelector('#'+telTypeInputB.getAttribute("id"));
    newtelTypeInputB.setAttribute("id", newtelTypeInputB.getAttribute("id").slice(0, -1) + contactNumber);
    newtelTypeInputB.value = "desktop";
    const newtelTypeLabelB = newContact.querySelector('#'+telTypeLabelA.getAttribute("id"));
    newtelTypeLabelB.setAttribute("id", newtelTypeLabelB.getAttribute("id").slice(0, -1) + contactNumber);
    newtelTypeLabelB.setAttribute("for", newtelTypeInputB.getAttribute("id"));
  
    const newtelnumberInputA = newContact.querySelector('#'+telnumberInputA.getAttribute("id"));
    newtelnumberInputA.setAttribute("id", newtelnumberInputA.getAttribute("id").slice(0, -1) + contactNumber);
    newtelnumberInputA.value = "";
    const newtelNumberLabelA = newContact.querySelector('#'+telNumberLabelA.getAttribute("id"));
    newtelNumberLabelA.setAttribute("id", newtelNumberLabelA.getAttribute("id").slice(0, -1) + contactNumber);
    newtelNumberLabelA.setAttribute("for", newtelnumberInputA.getAttribute("id"));
  
    const newtelnumberInputB = newContact.querySelector('#'+telnumberInputB.getAttribute("id"));
    newtelnumberInputB.setAttribute("id", newtelnumberInputB.getAttribute("id").slice(0, -1) + contactNumber);
    newtelnumberInputB.value = "";
    const newtelNumberLabelB = newContact.querySelector('#'+telNumberLabelB.getAttribute("id"));
    newtelNumberLabelB.setAttribute("id", newtelNumberLabelB.getAttribute("id").slice(0, -1) + contactNumber);
    newtelNumberLabelB.setAttribute("for", newtelnumberInputB.getAttribute("id"));
  
    const newtelExtensionInputA = newContact.querySelector('#'+telExtensionInputA.getAttribute("id"));
    newtelExtensionInputA.setAttribute("id", newtelExtensionInputA.getAttribute("id").slice(0, -1) + contactNumber);
    newtelExtensionInputA.value = "";
    const newtelExtensionLabelA = newContact.querySelector('#'+telExtensionLabelA.getAttribute("id"));
    newtelExtensionLabelA.setAttribute("id", newtelExtensionLabelA.getAttribute("id").slice(0, -1) + contactNumber);
    newtelExtensionLabelA.setAttribute("for", newtelExtensionInputA.getAttribute("id"));

    const newtelExtensionInputB = newContact.querySelector('#'+telExtensionInputB.getAttribute("id"));
    newtelExtensionInputB.setAttribute("id", newtelExtensionInputB.getAttribute("id").slice(0, -1) + contactNumber);
    newtelExtensionInputB.value = "";
    const newtelExtensionLabelB = newContact.querySelector('#'+telExtensionLabelB.getAttribute("id"));
    newtelExtensionLabelB.setAttribute("id", newtelExtensionLabelB.getAttribute("id").slice(0, -1) + contactNumber);
    newtelExtensionLabelB.setAttribute("for", newtelExtensionInputB.getAttribute("id"));

    newContact.querySelectorAll('.valid-feedback').forEach(element => {
      element.style.display = "none";
    });
    newContact.querySelectorAll('.invalid-feedback').forEach(element => {
      element.style.display = "none";
    });

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