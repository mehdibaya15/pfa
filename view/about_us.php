<?php
include("../config/database.php");
include("../controller/traitement.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - PETTY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_home.css">
    <style>
        
        .container {
            margin-top: 100px;
            margin-bottom: 50px;

        }
        .mission-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            border-top: 5px solid #5F6F52;
           
        }
        .team-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }
        .team-member {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .team-member img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #A9B388;
            margin-bottom: 15px;
        }
        
        .stats-item {
            text-align: center;
            padding: 20px;
        }
        
        .stats-number {
            font-size: 3rem;
            font-weight: bold;
            color: #5F6F52;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include("header.php"); ?>

    <!-- Our Story -->
    <section class="container mb-5">
        <h1 class="section-title"><strong>Notre Histoire</strong></h1>
        <div class="row">
            <div class="col-md-6">
                <p>Fondé en 2025 par un groupe de passionnés, PETTY est né d'une simple initiative locale pour aider les animaux abandonnés dans notre quartier. Ce qui a commencé comme un petit refuge improvisé dans un garage est rapidement devenu une organisation reconnue à l'échelle nationale.</p>
                <p>Notre premier sauvetage fut celui de Bella, une chienne croisée maltraitée qui est devenue notre mascotte et symbole d'espoir. Aujourd'hui, grâce au dévouement de notre équipe et à la générosité de nos donateurs, nous avons pu étendre nos activités à travers tout le pays.</p>
            </div>
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1665603287514-ec5189300054?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fHBldHN8ZW58MHx8MHx8fDA%3D" alt="Notre refuge" class="img-fluid rounded">
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="container mb-5">
        <h2 class="section-title"><strong>Notre Mission et Valeurs</strong></h2>
        <div class="row">
            <div class="col-md-4">
                <div class="mission-card">
                    <i class="fas fa-heart fa-3x mb-3" style="color: #5F6F52;"></i>
                    <h3>Protéger</h3>
                    <p>Offrir un refuge sûr et des soins médicaux à chaque animal dans le besoin, sans exception.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mission-card">
                    <i class="fas fa-home fa-3x mb-3" style="color: #5F6F52;"></i>
                    <h3>Adopter</h3>
                    <p>Trouver des foyers aimants et responsables pour nos protégés grâce à un processus rigoureux.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mission-card">
                    <i class="fas fa-graduation-cap fa-3x mb-3" style="color: #5F6F52;"></i>
                    <h3>Éduquer</h3>
                    <p>Sensibiliser le public à la protection animale et promouvoir la stérilisation responsable.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="container mb-5 py-4" style="background-color: #f9f9f9; border-radius: 15px;">
        <div class="row">
            <div class="col-md-3">
                <div class="stats-item">
                    <div class="stats-number">2,000+</div>
                    <p>Animaux sauvés</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-item">
                    <div class="stats-number">1,500+</div>
                    <p>Adoptions réussies</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-item">
                    <div class="stats-number">120+</div>
                    <p>Bénévoles actifs</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-item">
                    <div class="stats-number">15</div>
                    <p>Partenaires vétérinaires</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->
    <section class="container mb-5">
        <h2 class="section-title text-center"><strons>Notre Équipe</strons></h2>
        <div class="team-container">
            <div class="team-member">
                <img src="../images/chaima.png" alt="Membre de l'équipe">
                <h4>Chaima Ayed</h4>
                <p>Fondatrice & Directrice</p>
            </div>
            <div class="team-member">
                <img src="../images/fatma2.jpg" alt="Membre de l'équipe">
                <h4>Fatma Ezzahra Jenayah</h4>
                <p>Responsable adoptions</p>
            </div>
            <div class="team-member">
                <img src="../images/mahdi.jpg" alt="Membre de l'équipe">
                <h4>Mahdi Baya</h4>
                <p>Coordinateur bénévoles</p>
            </div>
        </div>
    </section>

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
                <p>© 2025 Adoption Animaux. Tous droits réservés.</p>
            </div>
        </div>
    </section>
</body>
</html>