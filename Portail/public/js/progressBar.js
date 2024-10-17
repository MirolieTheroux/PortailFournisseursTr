document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.arrow-steps .step');
    const nextButton = document.getElementById('test'); //TODO::Changer le ID nextButton pour une class ou querySelectorAll -> Il va y avoir plusieurs boutons parielle et tous les boutons devrons avoir le listener.

    let currentStep = 0;
    let areFieldsValid = true;



    // nextButton.addEventListener('click', function() {
    //     if ((currentStep < steps.length - 1) && areFieldsValid) {
    //         steps[currentStep].classList.remove('current'); 
    //         currentStep++; 
    //         steps[currentStep].classList.add('current'); 
    //     }
    // });
});
