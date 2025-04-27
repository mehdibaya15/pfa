<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php'); // Redirige vers la page de login
    exit();
}
include("../config/database.php");
// Récupérer les informations utilisateur depuis la base de données
$user = null;
if ($_SESSION['email'] == ADMIN_EMAIL) {
    $user = [
        'id_utilisateur' => 0,
        'prenom' => 'Admin',
        'nom' => '',
        'email' => ADMIN_EMAIL,
        'telephone' => '',
        'adresse' => ''
    ];
} else {
    $req = "SELECT * FROM utilisateur WHERE email = ?";
    $stm = $cnx->prepare($req);
    $stm->execute([$_SESSION['email']]);
    $user = $stm->fetch();
    
    if (!$user) {
        session_destroy();
        header('Location: signup.php');
        exit();
    }
}

// Gestion des messages de feedback
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
$success = isset($_SESSION['success']) ? $_SESSION['success'] : null;
unset($_SESSION['error']);
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Profil Utilisateur</title>
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
        
        .dashboard-container {
            display: flex;
            max-width: 1200px;
            margin: 30px auto;
            gap: 30px;
            flex-wrap: wrap;
        }
        
        .left-section, .right-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .left-section {
            flex: 2;
            min-width: 300px;
        }
        
        .right-section {
            flex: 1;
            min-width: 300px;
        }
        
        .header {
            text-align: center;
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
        
        h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        h2 {
            font-size: 1.5rem;
            margin-top: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--secondary-color);
            color: var(--primary-color);
        }
        
        .adoption-preferences {
            background-color: #e8f4fc;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .contact-info {
            margin-bottom: 20px;
        }
        
        .contact-info strong {
            display: block;
            margin-bottom: 5px;
            color: var(--primary-color);
        }
        
        .password-form .input-group {
            margin-bottom: 15px;
            position: relative;
        }
        
        .password-form input {
            display: block;
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .password-form input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(95, 111, 82, 0.25);
            outline: none;
        }
        
        .password-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--primary-color);
        }
        
        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-submit:hover {
            background-color: #4a5a3d;
            transform: translateY(-2px);
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0 0 15px 0;
            margin-bottom: 20px;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .highlight {
            color: var(--primary-color);
        }
        
        .alert {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="left-section">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home_page.php"><i class="bi bi-house-door"></i> Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil Utilisateur</li>
                </ol>
            </nav>
            
            <div class="header">
                <h1>PROFIL <span class="highlight">UTILISATEUR</span></h1>
            </div>
            
            <section class="adoption-preferences">
                <h2><i class="bi bi-heart-fill"></i> VOS PRÉFÉRENCES</h2>
                <p>Vous aimeriez adopter un Chat</p>
                <p>Vous cherchez à adopter une Femelle</p>
                <p>Vous cherchez à adopter un animal Jeune</p>
                <p>Vous vivez en maison</p>
                <p>Vous souhaitez adopter un animal aux alentours de Paris</p>
                <p>Vous êtes prêt(e) à vous déplacer de 50 km</p>
                <p>Oui, vous souhaitez faire du sport avec votre animal</p>
            </section>
        </div>
        
        <div class="right-section">
            <section class="contact-info">
                <h2><i class="bi bi-person-lines-fill"></i> COORDONNÉES</h2>
                <p><strong><?= htmlspecialchars($user['prenom'] ?? '') ?> <?= htmlspecialchars($user['nom'] ?? '') ?></strong></p>
                <p>Téléphone: <strong><?= htmlspecialchars($user['telephone'] ?? 'Non renseigné') ?></strong></p>
                <p>Adresse: <strong><?= htmlspecialchars($user['adresse'] ?? 'Non renseignée') ?></strong></p>
                <p>Email: <strong><?= htmlspecialchars($user['email'] ?? '') ?></strong></p>
            </section>
            
            <section class="password-change">
                <h2><i class="bi bi-lock-fill"></i> CHANGER LE MOT DE PASSE</h2>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>
                
                <form action="../controller/update_pass.php" method="post" class="password-form">
                    <input type="hidden" name="idu" value="<?= $user['id_utilisateur'] ?>">
                    
                    <div class="input-group">
                        <input type="password" name="old_password" id="old_password" placeholder="Ancien mot de passe" required>
                        <i class="bi bi-eye-slash password-icon toggle-password" data-target="old_password"></i>
                    </div>
                    
                    <div class="input-group">
                        <input type="password" name="new_password" id="new_password" placeholder="Nouveau mot de passe" required>
                        <i class="bi bi-eye-slash password-icon toggle-password" data-target="new_password"></i>
                    </div>
                    
                    <div class="input-group">
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer le nouveau mot de passe" required>
                        <i class="bi bi-eye-slash password-icon toggle-password" data-target="confirm_password"></i>
                    </div>
                    
                    <button type="submit" class="btn-submit" name="modif_pass">METTRE À JOUR</button>
                </form>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script pour basculer la visibilité du mot de passe
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                // Changer l'icône
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        });
    </script>
</body>
</html>