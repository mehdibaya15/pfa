<!DOCTYPE html>
<html lang="fr">
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
    session_start();

if (isset($_POST['submit_user'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM utilisateur WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Stocker les infos utilisateur en session
            $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
            $_SESSION['nom'] = $user['nom'];

            
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Mot de passe incorrect";
        }
    } else {
        $error = "Email non trouvé";
    }
}
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="script.js"></script>
</head>

<body>
    <script>
        console.log(document.title);
        console.log(document.URL);

    </script>

    <!-- Navbar  -->
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

                <!-- User Section -->

        <ul class="navbar-nav ms-auto">
            <?php if(isset($_SESSION['id_utilisateur'])) :?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-1"></i> <?php echo htmlspecialchars($_SESSION['nom']); ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                 <li><a class="dropdown-item" href="#">Profil</a></li>
                    <li><a class="dropdown-item" href="#">Paramètres</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
             
        </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">Offrons-leur tout l'amour qu'ils nous donnent !</h1>
            <p class="hero-subtitle">Donnez une seconde chance à un animal dans le besoin</p>
            <a href="magasin.php"><button class="btn btn-primary btn-lg">Voir les animaux</button></a>
        </div>
    </section>

    <!-- Why Adopt Section -->
    <section class="why-adopt">
        <div class="container">
            <h2 class="section-title">Pourquoi adopter un animal ?</h2>
            <p class="why-title">Adopter un animal, c’est offrir une seconde chance à ceux qui attendent un foyer. En choisissant
                l’adoption, vous offrez à un animal abandonné un avenir plein d’amour et de soins, tout en contribuant à
                réduire la surpopulation dans les refuges. C’est un geste de solidarité qui crée un lien unique et
                enrichissant entre l’animal et son nouveau compagnon humain. Adopter, c’est changer une vie, et la vôtre
                aussi.

            </p>
            <div class="testimonial-container">
                <div class="testimonial-card">
                    <div class="quote-icon">❝</div>
                    <p class="testimonial-text">
                        J’ai adopté un chien il y a quelques semaines. Il est très gentil et affectueux. Toute la
                        famille est heureuse avec lui.
                    </p>
                    <div class="testimonial-footer">
                        <img src="../images/user1.jpg" alt="User" class="user-img">
                        <div class="stars">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="quote-icon">❝</div>
                    <p class="testimonial-text">
                        L’adoption de mon chat s’est très bien passée. Il s’est vite adapté à la maison. Merci pour
                        votre aide et votre accueil.
                    </p>
                    <div class="testimonial-footer">
                        <img src="../images/user1.jpg" alt="User" class="user-img">
                        <div class="stars">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="quote-icon">❝</div>
                    <p class="testimonial-text">
                        Je suis très contente d’avoir adopté un lapin. Il est calme, propre et très mignon. Je
                        recommande cette expérience.
                    </p>
                    <div class="testimonial-footer">
                        <img src="../images/user1.jpg" alt="User" class="user-img">
                        <div class="stars">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                </div>
            </div>
            <a href="http://localhost/projet_animeau/view/avis.php">Donner vos avis</a>
        </div>

    </section>



    <div class="divider"></div>

    <!-- Animals Section -->
    <h2 class="Image-title">Nos animaux</h2>
    <div class="img-flex-container">
        <div class="Image-container">
            <img src="https://images.unsplash.com/photo-1495360010541-f48722b34f7d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y2hhdHxlbnwwfHwwfHx8MA%3D%3D"
                alt="">
            <img src="https://images.unsplash.com/photo-1557431177-d277c24390e5?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDV8fHxlbnwwfHx8fHw%3D"
                alt="">
            <img src="https://images.unsplash.com/photo-1588942173353-0c53a1bf9081?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8bW91dG9ufGVufDB8fDB8fHww"
                alt="">
            <img src="https://images.unsplash.com/photo-1605559911160-a3d95d213904?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8bW9ua2V5fGVufDB8fDB8fHww"
                alt="">
        </div>
        <div class="Image-container-2">
            <img src="https://images.unsplash.com/photo-1495360010541-f48722b34f7d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y2hhdHxlbnwwfHwwfHx8MA%3D%3D"
                alt="">
            <img src="https://images.unsplash.com/photo-1557431177-d277c24390e5?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDV8fHxlbnwwfHx8fHw%3D"
                alt="">
            <img src="https://images.unsplash.com/photo-1588942173353-0c53a1bf9081?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8bW91dG9ufGVufDB8fDB8fHww"
                alt="">
            <img src="https://images.unsplash.com/photo-1605559911160-a3d95d213904?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8bW9ua2V5fGVufDB8fDB8fHww"
                alt="">
        </div>
    </div>
    <!-- Steps Section -->
    <section class="steps-section">
        <div class="container">
            <h2 class="section-title">Les étapes à suivre!</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-icon">
                            <i class="fas fa-paw"></i>
                        </div>
                        <h3 class="step-title">Choisir votre animal</h3>
                        <p>Parcourez nos profils d'animaux et trouvez celui qui correspond à votre mode de vie.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-icon">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <h3 class="step-title">Remplir le formulaire</h3>
                        <p>Complétez notre formulaire d'adoption pour nous aider à trouver la meilleure famille.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3 class="step-title">Accueillir chez vous</h3>
                        <p>Préparez votre maison et accueillez votre nouveau compagnon à quatre pattes!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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