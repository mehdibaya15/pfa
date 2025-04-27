document.addEventListener('DOMContentLoaded', function() {
    // Configuration
    const itemsPerPage = 6;
    let currentPage = 1;
    const animalCards = document.querySelectorAll('.animal-card');
    const totalItems = animalCards.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const paginationControls = document.getElementById('pagination-controls');
    
    // Éléments d'affichage du compteur
    const pageStartElement = document.getElementById('page-start');
    const pageEndElement = document.getElementById('page-end');
    const totalItemsElement = document.getElementById('total-items');

    // Afficher une page spécifique
    function showPage(page) {
        currentPage = Math.max(1, Math.min(page, totalPages));
        
        // Calcul des éléments à afficher
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
        
        // Masquer tous les éléments
        animalCards.forEach(card => card.style.display = 'none');
        
        // Afficher seulement les éléments de la page courante
        for (let i = startIndex; i < endIndex; i++) {
            animalCards[i].style.display = 'block';
        }
        
        // Mettre à jour l'affichage "X-Y sur Z"
        pageStartElement.textContent = startIndex + 1;
        pageEndElement.textContent = endIndex;
        totalItemsElement.textContent = totalItems;
        
        updatePaginationUI();
    }

    // Mettre à jour l'interface de pagination
    function updatePaginationUI() {
        // Supprimer les numéros de page existants
        const existingPageNumbers = document.querySelectorAll('.page-number');
        existingPageNumbers.forEach(el => el.remove());
        
        // Déterminer les pages à afficher (max 5 autour de la page courante)
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        
        // Ajuster si on est proche de la fin
        if (endPage - startPage < 4 && startPage > 1) {
            startPage = Math.max(1, endPage - 4);
        }
        
        // Ajouter le bouton "1" et "..." si nécessaire
        if (startPage > 1) {
            addPageNumber(1);
            if (startPage > 2) {
                addEllipsis();
            }
        }
        
        // Ajouter les numéros de page
        for (let i = startPage; i <= endPage; i++) {
            addPageNumber(i);
        }
        
        // Ajouter "..." et le dernier numéro si nécessaire
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                addEllipsis();
            }
            addPageNumber(totalPages);
        }
        
        // Mettre à jour l'état des boutons Précédent/Suivant
        document.getElementById('prev-page').classList.toggle('disabled', currentPage === 1);
        document.getElementById('next-page').classList.toggle('disabled', currentPage === totalPages);
    }

    // Ajouter un numéro de page
    function addPageNumber(pageNumber) {
        const li = document.createElement('li');
        li.className = `page-item page-number ${pageNumber === currentPage ? 'active' : ''}`;
        
        const a = document.createElement('a');
        a.className = 'page-link';
        a.href = '#';
        a.textContent = pageNumber;
        a.dataset.page = pageNumber;
        
        li.appendChild(a);
        paginationControls.insertBefore(li, document.getElementById('next-page'));
    }

    // Ajouter des points de suspension
    function addEllipsis() {
        const li = document.createElement('li');
        li.className = 'page-item disabled';
        
        const span = document.createElement('span');
        span.className = 'page-link';
        span.textContent = '...';
        
        li.appendChild(span);
        paginationControls.insertBefore(li, document.getElementById('next-page'));
    }

    // Gérer les clics sur la pagination
    paginationControls.addEventListener('click', function(e) {
        e.preventDefault();
        const target = e.target.closest('a');
        
        if (!target) return;
        
        if (target.parentElement.id === 'prev-page') {
            showPage(currentPage - 1);
        } else if (target.parentElement.id === 'next-page') {
            showPage(currentPage + 1);
        } else if (target.dataset.page) {
            showPage(parseInt(target.dataset.page));
        }
        
        // Faire défiler vers le haut
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Initialiser
    showPage(1);
});