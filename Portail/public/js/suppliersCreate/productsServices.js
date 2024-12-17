const productsCategories = document.getElementById('products-categories');
let debounceTimer = 0;
let offset = 0;
const limit = 50;
let scrolled = false;
let totalCount = 0;
let curentCount = 0;

function fetchServices() {
    const searchTerm = document.getElementById('service-search').value;

    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {
        fetch(`/services?search=${encodeURIComponent(searchTerm)}&offset=${offset}&limit=${limit}`)
            .then(response => response.json())
            .then(data => {
                const serviceList = document.getElementById('service-list');
                
                if (offset === 0) {
                    serviceList.innerHTML = '';
                }
                curentCount = data.services.length + offset;
                totalCount = data.total_count;

                const resultCount = document.getElementById('results-count');
                resultCount.innerHTML = `${curentCount} sur ${totalCount} resultat(s)`; // Update with count of results shown vs total

                data.services.forEach(service => {
                    const serviceItem = document.createElement('div');
                    serviceItem.classList.add('row', 'align-items-start', 'py-2', 'hover-options', 'user-select-none');

                    const originalCode = service.code;
                    const originalDescription = service.description;

                    const highlightedDescription = highlightText(originalDescription, searchTerm);

                    serviceItem.innerHTML = `
                        <div class="col-12 d-flex flex-column justify-content-start">
                            <label class="form-check-label" id="category${service.code}">${highlightedDescription}</label>
                        </div>
                    `;

                    const clonedService = document.querySelector(`#service-selected [data-code="${service.code}"]`);
                    if (clonedService) {
                        serviceItem.classList.add('disabled-options');
                    }

                    serviceItem.addEventListener('click', function () {
                        serviceItem.classList.add('disabled-options');

                        const selectedService = document.createElement('div');
                        selectedService.classList.add('row', 'align-items-start', 'py-2', 'hover-options', 'user-select-none');
                        selectedService.dataset.code = service.code;

                        selectedService.innerHTML = `
                            <input type="text" name="products_services[]" value="${originalCode}" class="d-none">
                            <div class="col-12 d-flex flex-column justify-content-start">
                                ${originalDescription}
                            </div>
                        `;

                        addSelectedServiceListener(selectedService);

                        const selectedContainer = document.getElementById('service-selected');
                        selectedContainer.appendChild(selectedService);
                    });

                    serviceList.appendChild(serviceItem);
                });

                updateServiceList();
            })
            .catch(error => console.error('Error fetching services:', error));
            scrolled = false;
    }, 500);
}

function loadMoreServices() {
    if (productsCategories.scrollTop >= productsCategories.scrollHeight-606  && scrolled == false && curentCount < totalCount){
        offset += limit;
        scrolled = true;
        fetchServices();
    }
}

function updateServiceList() {
    const clonedServices = document.querySelectorAll('#service-selected .row');
    
    clonedServices.forEach(clonedService => {
        const clonedCode = clonedService.dataset.code;
        const originalService = document.getElementById(`category${clonedCode}`);
        
        if (originalService) {
            originalService.closest('.row').classList.add('disabled-options');
        }
    });
}

productsCategories.addEventListener('scroll', loadMoreServices);

fetchServices();
var searchBar = document.getElementById('service-search');
searchBar.addEventListener("input", function() {
    offset = 0;
    productsCategories.scrollTop = 0;
    fetchServices();
});


function removeAccents(text) {
    return text.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
}

function highlightText(text, searchTerm) {
    const normalizedText = removeAccents(text);
    const normalizedSearchTerm = removeAccents(searchTerm);

    const index = normalizedText.toLowerCase().indexOf(normalizedSearchTerm.toLowerCase());

    if (index !== -1) {
        const highlightedText = `
            ${text.substring(0, index)}<span class="highlight">${text.substring(index, index + searchTerm.length)}</span>${text.substring(index + searchTerm.length)}
        `;
        return highlightedText;
    }

    return text;
}

getSelectedServiceElements();
function getSelectedServiceElements(){
    const selectedServiceContainer = document.getElementById('service-selected');
    const selectedServiceList = selectedServiceContainer.children;

    for (let index = 0; index < selectedServiceList.length; index++) {
        const selectedService = selectedServiceList[index];
        addSelectedServiceListener(selectedService);
    }
}

function addSelectedServiceListener(selectedService){
    selectedService.addEventListener('click', function () {
        const selectedServiceCode = selectedService.querySelector('input').value;

        const originalService = document.getElementById(`category${selectedServiceCode}`);
        if (originalService) {
            originalService.closest('.row').classList.remove('disabled-options');
        }

        const selectedContainer = document.getElementById('service-selected');
        selectedContainer.removeChild(selectedService);
    });
}