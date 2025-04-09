<?php 
include("../config/database.php");
include("../controller/traitement.php");

if (!empty($_POST)) {
    if (isset($_POST['name'], $_POST['review'], $_POST['rating']) && isset($_POST['submit_avis'])) {
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
    <link rel="stylesheet" href="style_home.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand"
                href="home_page.html">
                <img src="../images/logo.png" alt="Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Liens de navigation -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="home_page.html">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="magasin.php">BOUTIQUE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ADOPTIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="contact.php">CONTACT</a>
                    </li>
                </ul>

                <!-- Zone de recherche -->
                <div class="search-box">
                    <input type="search" class="form-control" placeholder="Rechercher...">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <!-- Bouton d'enregistrement -->
                <div class="ms-3">
                    <a href="signup.php"
                        class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i>ENREGISTRER
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <section class="reviews-section mb-5">
            <h2 class="text-center mb-4">Vos Avis Nous Importent!</h2>
            
            <form id="review-form" action="avis.php" method="post" class="col-lg-8 mx-auto">
                <div class="mb-3">
                    <label for="name" class="form-label">Votre nom*</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label for="review" class="form-label">Votre avis*</label>
                    <textarea id="review" name="review" class="form-control" rows="4" required></textarea>
                </div>
                
                <div class="mb-4">
                    <label for="rating" class="form-label">Note*</label>
                    <select id="rating" name="rating" class="form-select" required>
                        <option value="">-- Choisissez --</option>
                        <option value="5">★★★★★ - Excellent</option>
                        <option value="4">★★★★☆ - Très bien</option>
                        <option value="3">★★★☆☆ - Moyen</option>
                        <option value="2">★★☆☆☆ - Décevant</option>
                        <option value="1">★☆☆☆☆ - Mauvais</option>
                    </select>
                </div>
                
                <button type="submit" name="submit_avis" class="btn btn-primary submit-btn w-100">Publier mon avis</button>
            </form>
        </section>
    </main>

    <!-- Section Rejoindre-nous -->
    <section class="join-section">
        <div class="container">
            <div>
                <h2 class="join-title">REJOIGNEZ-NOUS !</h2>
                <p>2025 EASE, TOTHE PURE BEAUX S.A.T. DE NOM + NOM / PAROLES DE LA VOIX + FÉTROPARTIS.</p>
                <p>4700RT/18W - DAT ATTEMPORAILLION</p>
            </div>
            <div>
                <img src="../images/logo.png" alt="Logo">
                <p class="footer-p"><span>Contact:</span> petty@gmail.com </p>
                <p class="footer-p"><span>Tel:</span> +216 25 124 009</p>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>© 2025 Adoption Animaux. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>