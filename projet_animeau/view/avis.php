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
<?php include("header.php");?>
    
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
