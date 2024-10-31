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
  }
  else{
    container.classList.remove('bg-green');
    container.classList.add('bg-white');
  }
}

document.addEventListener("DOMContentLoaded", async function () {
  addSelectedListener();
});