<?php
include("../controller/traitement.php");
include("../config/database.php");
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
    <title>Aucune résultat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_home.css">
</head>
<body>
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

    <main class="container my-5">
        <section class="reviews-section mb-5">
            <h2 class="text-center mb-4">Aucune résultat est trouvée!!</h2>
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