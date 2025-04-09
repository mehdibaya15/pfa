<?php
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poisson</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_home.css">
    <script src="script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="magasin.css">
    <script src="magasinprep.js"></script>
    <script src="pagination.js"></script>
</head>

<body>
    <!-- Navbar -->
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
                    <a href="http://localhost/projet_animeau/view/signup.php"
                        class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i>ENREGISTRER
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="container">
            <!-- Filtres -->
            <div class="filters-container">
                <div class="filters-section">
                    <div class="animal-types">
                        <a href="http://localhost/projet_animeau/view/magasin.php"><button class="animal-type-btn">Tous</button></a>
                        <a href="http://localhost/projet_animeau/view/chien.php"><button class="animal-type-btn ">Chien</button></a>
                        <a href="http://localhost/projet_animeau/view/chat.php"><button class="animal-type-btn ">Chat</button></a>
                        <a href="http://localhost/projet_animeau/view/hamster.php"><button class="animal-type-btn ">Hamster</button></a>
                        <a href="http://localhost/projet_animeau/view/oiseaux.php"><button class="animal-type-btn">Oiseaux</button></a>
                        <a href="http://localhost/projet_animeau/view/poisson.php"><button class="animal-type-btn active">Poisson</button></a>
                        <a href="http://localhost/projet_animeau/view/lapin.php"><button class="animal-type-btn">Lapin</button></a>
                        <a href="http://localhost/projet_animeau/view/singe.php"><button class="animal-type-btn">Singe</button></a>
                    </div>
                    
                    <div class="search-sort-row">
                        <div class="search-box">
                            <input type="text" placeholder="Rechercher un animal...">
                            <button><i class="fas fa-search"></i></button>
                        </div>
                        
                        <div class="sort-options">
                            <span>Trier par :</span>
                            <select id="sort-select">
                                <option value="relevant">Pertinence</option>
                                <option value="recent">Plus récents</option>
                                <option value="price-asc">Prix croissant</option>
                                <option value="price-desc">Prix décroissant</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="animals-listing">
                <div class="container">
                    <div class="row">
                        <!-- Animal Card 1 avec badge -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card animal-card">
                                <a href="http://localhost/projet_animeau/view/adaptationInfo.php">
                                    <div class="animal-badge"></div>
                                    <img src="" class="card-img-top" alt="" loading="lazy" name="photo">
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text"></p>
                                        <div class="animal-details">
                                            <span><i class="fas fa-venus-mars"></i> </span>
                                            <span><i class="fas fa-birthday-cake"></i> </span>
                                            <span><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <a href="http://localhost/projet_animeau/view/adaptationInfo.php"><button class="btn btn-adopt">Adopter</button></a> 
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Join Section -->
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