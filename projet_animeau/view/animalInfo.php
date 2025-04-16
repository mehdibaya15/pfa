<?php
include("../controller/traitement.php");
include("../config/database.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Animal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="magasin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_home.css">
    <script src="magasinprep.js"></script>
    <script src="pagination.js"></script>
    <style>
        :root {
            --primary-color: #5F6F52;
            --secondary-color: #eeece2;
            --dark-color: #333;
            --light-color: #FEFAE0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--secondary-color);
            color: var(--dark-color);
        }
        
        .container{
            left:20px;
            max-width: 800px;
            margin: 40px 40px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .header {
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 3px;
            background: var(--primary-color);
            border-radius: 3px;
        }
        .animal-container{
            display: flex;
            gap:20px;
            margin-bottom:20px;
        }
        
        .imageAnimal img{
            width: 400px;
            height: 400px;
            border-radius: 15px;
        }
        .animal-info {
            left:550px;
            padding: auto;
        }

        h5 {
            font-size: 2rem;
            font-weight: 700;
        }
        
        .a {
            color: var(--primary-color);
            text-decoration: none;
        }
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0 0 15px 0;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php include("header.php");?>
<div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home_page.html"><i class="bi bi-house-door"></i> Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Animal Information</li>
            </ol>
        </nav>
        <div class="animal-container">
        <div class="imageAnimal"  >
            <img src="https://images.unsplash.com/photo-1561037404-61cd46aa615b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" > 
        </div>                          
            <div class="animal-infp">
                <h5 class="card-title">Max - Labrador</h5>
                <p class="card-text">Labrador mâle de 2 ans, très affectueux et joueur. Vacciné et stérilisé.</p>
                <div class="animal-details">
                        <span><i class="fas fa-venus-mars"></i> Mâle</span>
                        <span><i class="fas fa-birthday-cake"></i> 2 ans</span>
                        <span><i class="fas fa-map-marker-alt"></i> Tunis</span>
                </div> 
                <div class="d-flex justify-content-between align-items-center mt-3">
                        <a  href="adaptationInfo.php"><button class="btn btn-adopt">Adopter</button></a> 
                </div>
            </div>   
        </div>                             
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
