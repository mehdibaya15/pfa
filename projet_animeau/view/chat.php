<?php
include("../controller/traitement.php");
include("../config/database.php");
$categorie="chat";
if (isset($_GET['search1']) && !empty($_GET['search1'])) {
    $animaux = rechercheAnimalCat($cnx, $_GET['search1'],$categorie);
} else {
    $animaux =insertAnimalByCategorie($cnx,$categorie);
}
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = strtolower(trim($_GET['search']));
    if ($search == 'chien') {
        header("Location: chien.php");
        exit();
    }
    elseif ($search == 'chat') {
         header("Location: chat.php");
         exit();
     }
     elseif ($search == 'oiseaux') {
        header("Location: oiseaux.php");
        exit();
    }
    elseif ($search == 'singe') {
        header("Location: singe.php");
        exit();
    }
    elseif ($search == 'poisson') {
        header("Location: poisson.php");
        exit();
    }
    elseif ($search == 'lapin') {
        header("Location: lapin.php");
        exit();
    }
    elseif ($search == 'hamster') {
        header("Location: hamster.php");
        exit();
    }
    elseif ($search == 'avis') {
        header("Location: avis.php");
        exit();
    }
    elseif ($search == 'contact') {
        header("Location: contact.php");
        exit();
    }
    elseif ($search == 'home') {
        header("Location: home_page.php");
        exit();
    }
    elseif ($search == 'home page') {
        header("Location: home_page.php");
        exit();
    }
    elseif ($search == 'accueil') {
        header("Location: home_page.php");
        exit();
    }
    elseif ($search == 'boutique') {
        header("Location: magasin.php");
        exit();
    }
    elseif ($search == 'magasin') {
        header("Location: magasin.php");
        exit();
    }
    else{
        header("Location: erreur.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="magasin.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="magasinprep.js"></script>
    <script src="pagination.js"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand"
                href="home_page.php">
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
                            href="home_page.php">ACCUEIL</a>
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

                <form method="GET" action="">
                    <div class="search-box">
                        <input type="search" class="form-control" placeholder="Rechercher ..." aria-label="Recipient's username" aria-describedby="button-addon2" name="search" value="<?php if(isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

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
            <div class="filters-container">
                <div class="filters-section">
                    <div class="animal-types">
                        <a href="magasin.php" class="animal-type-btn">Tous</a>
                        <a href="chien.php" class="animal-type-btn">Chien</a>
                        <a href="chat.php" class="animal-type-btn active">Chat</a>
                        <a href="hamster.php" class="animal-type-btn">Hamster</a>
                        <a href="oiseaux.php" class="animal-type-btn">Oiseaux</a>
                        <a href="poisson.php" class="animal-type-btn">Poisson</a>
                        <a href="lapin.php" class="animal-type-btn">Lapin</a>
                        <a href="singe.php" class="animal-type-btn">Singe</a>
                    </div>
                    
                    <div class="search-sort-row">
                    <form method="GET" action="">
                        <div class="search-box">
                            <input type="text" class="form-control" placeholder="Rechercher un animal..." aria-label="Recipient's username" aria-describedby="button-addon2" name="search1" value="<?php if(isset($_GET['search1'])) echo htmlspecialchars($_GET['search1']); ?>">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                        <div class="sort-options">
                            <span>Trier par :</span>
                            <select id="sort-select">
                                <option value="relevant">Race</option>
                                <option value="recent">Age</option>
                                <option value="recent">Localisation</option>
                            </select>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
            <div class="animals-listing">
                <div class="container">
                    <div class="row">
                        <?php foreach ($animaux as $animal): ?>  
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card animal-card">
                                <div class="animal-badge"></div>
                                <img src="<?= htmlspecialchars($animal['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($animal['race']) ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($animal['nom']) ?> - <?= htmlspecialchars($animal['race']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($animal['description']) ?></p>
                                    <div class="animal-details">
                                        <span><i class="fas fa-venus-mars"></i> <?= $animal['sexe'] === 'F' ? 'Femelle' : 'Mâle' ?></span>
                                        <span><i class="fas fa-birthday-cake"></i> <?= htmlspecialchars($animal['age']) ?> an(s)</span>
                                        <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($animal['ville']) ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <a href="adaptationInfo.php" class="btn btn-adopt">Adopter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item" id="prev-page">
                                <a class="page-link" href="#" tabindex="-1">Précédent</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#" data-page="1">1</a></li>
                            <li class="page-item"><a class="page-link" href="#" data-page="2">2</a></li>
                            <li class="page-item"><a class="page-link" href="#" data-page="3">3</a></li>
                            <li class="page-item" id="next-page">
                                <a class="page-link" href="#">Suivant</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="join-section">
        <div class="container">
            <div>
                <h2 class="join-title">REJOIGNEZ-NOUS !</h2>
                <p>2025 EASE, TOTHE PURE BEAUX S.A.T. DE NOM + NOM / PAROLES DE LA VOIX + FÉTROPARTIS.</p>
                <p>4700RT/18W - DAT ATTEMPORAILLION</p>
            </div>
            <div>
                <img src="../images/logo.png" alt="Logo">
                <p class="footer-p"><span>Contact:</span> petty@gmail.com</p>
                <p class="footer-p"><span>Tel:</span> +216 25 124 009</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>© 2025 Adoption Animaux. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>