<?php 

include("../config/database.php");
include("../controller/traitement.php");

if (!empty($_POST)) {

    if (isset($_POST['name'], $_POST['review'], $_POST['rating'])&& isset($_POST['submit_avis'])) {
        AjouterAvis($cnx, $_POST);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style_home.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="file:///C:/Users/ezzah/Desktop/projet%20animeau/faty/home%20page/home_page.html">
                <img src="logo.png" alt="Logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Liens de navigation -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="file:///C:/Users/ezzah/Desktop/projet%20animeau/faty/home%20page/home_page.html">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">BOUTIQUE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ADOPTIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="file:///C:/Users/ezzah/Desktop/projet%20animeau/faty/home%20page/contact_page.html">CONTACT</a>
                    </li>
                </ul>
                
                <!-- Zone de recherche -->
                <div class="search-box">
                    <input type="search" class="form-control" placeholder="Rechercher...">
                    <button class="btn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <!-- Bouton d'enregistrement -->
                <div class="ms-3">
                    <a href="file:///C:/Users/ezzah/Desktop/projet%20animeau/faty/home%20page/logIn.html" class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i>ENREGISTRER
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <section class="reviews-section">
        <h2>Vos Avis Nous Importent!</h2>
        
        <!-- Formulaire -->
        <form id="review-form" action="avis.php" method="post">
            <div class="form-group">
                <label for="name">Votre nom*</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="review">Votre avis*</label>
                <textarea id="review" name="review" required></textarea>
            </div>
            <div class="form-group">
                <label for="rating">Note*</label>
                <select id="rating" name="rating" class="stars-select" required>
                    <option value="">-- Choisissez --</option>
                    <option value="5">★★★★★ - Excellent</option>
                    <option value="4">★★★★☆ - Très bien</option>
                    <option value="3">★★★☆☆ - Moyen</option>
                    <option value="2">★★☆☆☆ - Décevant</option>
                    <option value="1">★☆☆☆☆ - Mauvais</option>
                </select>
            </div>
            
            <button type="submit" name="submit_avis" class="submit-btn">Publier mon avis</button>
        </form>
        
        <!-- Liste des avis -->
       <!--  
        <div id="reviews-list">
           
            <div class="review">
                <div class="review-header">
                    <span class="review-author">faty.jh</span>
                    <span class="review-rating">★★★★★</span>
                </div>
                <p class="review-content">Service rapide et professionnel ! Je recommande vivement.</p>
            </div>
        </div>
    </section>

    <script>
    // Soumission du formulaire
        document.getElementById("review-form").addEventListener("submit", function(e) {
            e.preventDefault();
            
            // Récupération des valeurs
            const name = document.getElementById("name").value;
            const reviewText = document.getElementById("review").value;
            const ratingValue = document.getElementById("rating").value;
            const ratingStars = '★'.repeat(ratingValue) + '☆'.repeat(5 - ratingValue);
            // Création de l'avis
            const reviewElement = document.createElement("div");
            reviewElement.className = "review";
            
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    reviewElement.innerHTML = `
                        <div class="review-header">
                            <span class="review-author">${name}</span>
                            <span class="review-rating">${ratingStars}</span>
                        </div>
                        <p class="review-content">${reviewText}</p>
                    `;
                    document.getElementById("reviews-list").prepend(reviewElement);
                    e.target.reset();
                    alert("Merci pour votre avis !");
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                reviewElement.innerHTML = `
                    <div class="review-header">
                        <span class="review-author">${name}</span>
                        <span class="review-rating">${ratingStars}</span>
                    </div>
                    <p class="review-content">${reviewText}</p>
                `;
                document.getElementById("reviews-list").prepend(reviewElement);
                e.target.reset();
                alert("Merci pour votre avis !");
            }
        });
    </script>
    -->
</body>
</html>