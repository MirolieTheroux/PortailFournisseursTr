document.addEventListener('DOMContentLoaded', function() {
    const steps = document.querySelectorAll('.arrow-steps .step');
    const nextButton = document.getElementById('test'); 

    let currentStep = 0; 
    nextButton.addEventListener('click', function() {
        if (currentStep < steps.length - 1) {
            steps[currentStep].classList.remove('current'); 
            currentStep++; 
            steps[currentStep].classList.add('current'); 
        }
    });
});
