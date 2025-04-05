document.addEventListener("DOMContentLoaded", function() {
    // Gestion des boutons de filtre
    const animalTypeBtns = document.querySelectorAll('.animal-type-btn');
    animalTypeBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            animalTypeBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            filterAnimals();
        });
    });

    // Gestion du slider de prix
    const priceRange = document.getElementById('priceRange');
    const minPrice = document.getElementById('min-price');
    
    priceRange.addEventListener('input', function() {
        minPrice.textContent = this.value + ',00 DT';
        filterAnimals();
    });

    // Gestion du tri
    const sortSelect = document.getElementById('sort-select');
    sortSelect.addEventListener('change', filterAnimals);

    // Fonction de filtrage (exemple)
    function filterAnimals() {
        const activeType = document.querySelector('.animal-type-btn.active').textContent;
        const maxPrice = priceRange.value;
        const sortValue = sortSelect.value;
        
        console.log(`Filtres appliqués: 
        Type: ${activeType}, 
        Prix max: ${maxPrice}, 
        Tri: ${sortValue}`);
        
        // Ici vous feriez une requête AJAX ou filtreriez les données locales
        // Pour l'exemple, on va juste afficher un message
        const animalsContainer = document.getElementById('animals-container');
        animalsContainer.innerHTML = `
            <div class="col-12 text-center py-5">
                <p class="text-muted">${activeType === 'Tous' ? 'Tous les animaux' : activeType} 
                à moins de ${maxPrice},00 DT - Tri: ${sortSelect.options[sortSelect.selectedIndex].text}</p>
                <p>(Fonctionnalité à implémenter)</p>
            </div>
        `;
    }

    // Initialisation
    filterAnimals();
});

