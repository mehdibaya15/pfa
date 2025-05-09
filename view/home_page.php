<?php
include("../config/database.php");
include("../controller/traitement.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PETTY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_home.css">
    <script src="script.js"></script>
</head>

<body>
    <script>
        console.log(document.title);
        console.log(document.URL);

    </script>

    <!-- Navbar  -->
    <?php include("header.php");?>

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
            <img src="https://images.unsplash.com/photo-1563538484631-e3a974e4263f?q=80&w=1578&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
            <img src="https://images.unsplash.com/photo-1683463170490-e6727ad94d09?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
            <img src="https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bGFwaW58ZW58MHx8MHx8fDA%3D"
                alt="">
            <img src="https://images.unsplash.com/photo-1654181925544-4b9f45943cc4?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Q2FuYXJpfGVufDB8fDB8fHww"
                alt="">
        </div>
        <div class="Image-container-2">
        <img src="https://images.unsplash.com/photo-1563538484631-e3a974e4263f?q=80&w=1578&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
            <img src="https://images.unsplash.com/photo-1683463170490-e6727ad94d09?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="">
            <img src="https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bGFwaW58ZW58MHx8MHx8fDA%3D"
                alt="">
            <img src="https://images.unsplash.com/photo-1654181925544-4b9f45943cc4?w=700&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Q2FuYXJpfGVufDB8fDB8fHww"
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