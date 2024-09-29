/*** Section Contacts ***/


document.addEventListener('DOMContentLoaded', function() {
  let contactNumber = 1;
  const contactsRow = document.getElementById('contactsRow');
  const referenceContainer = document.getElementById('referenceContact');

  const addContactButton = document.querySelector('.add-contact');
  addContactButton.addEventListener("click", cloneContact);

  const subtitle = contactsRow.querySelector('#contactSubtitle');
  subtitle.id = subtitle.id + contactNumber;
  subtitle.innerHTML = subtitle.innerHTML + contactNumber;



  function cloneContact(){
    contactNumber++;

    const newContact = referenceContainer.cloneNode(true);

    const newDeleteContactButton = newContact.querySelector(".delete-contact");
    newDeleteContactButton.classList.remove('d-none');
    newDeleteContactButton.addEventListener("click", function(){
      newContact.remove();
    });

    const newSubtitle = newContact.querySelector('#' + subtitle.id);
    newSubtitle.id = newSubtitle.id.slice(0, -1) + contactNumber;
    newSubtitle.innerHTML = newSubtitle.innerHTML.slice(0, -1) + contactNumber;

    contactsRow.append(newContact);
  }


});