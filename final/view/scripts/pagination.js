// Gestion de la pagination
document.addEventListener('DOMContentLoaded', function() {
    const itemsPerPage = 6; // Nombre d'animaux par page
    let currentPage = 1;
    const animalCards = document.querySelectorAll('.animal-card');
    const totalPages = Math.ceil(animalCards.length / itemsPerPage);
    
    // Fonction pour afficher les animaux de la page sélectionnée
    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        
        animalCards.forEach((card, index) => {
            card.style.display = (index >= startIndex && index < endIndex) ? 'block' : 'none';
        });
        
        // Mettre à jour l'état actif des boutons
        document.querySelectorAll('.page-number').forEach(btn => {
            btn.parentElement.classList.toggle('active', parseInt(btn.dataset.page) === page);
        });
        
        // Gérer l'état des boutons Précédent/Suivant
        document.getElementById('prev-page').classList.toggle('disabled', page === 1);
        document.getElementById('next-page').classList.toggle('disabled', page === totalPages);
    }
    
    // Écouteurs d'événements
    document.querySelectorAll('.page-number').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            currentPage = parseInt(this.dataset.page);
            showPage(currentPage);
        });
    });
    
    document.getElementById('next-page').addEventListener('click', function(e) {
        e.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
        }
    });
    
    document.getElementById('prev-page').addEventListener('click', function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });
    
    // Afficher la première page au chargement
    showPage(1);
});