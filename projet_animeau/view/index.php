<?php
session_start();
if (isset($_SESSION['email'])) { // Vérification AVANT session_start()
    header('Location: user_profile.php');
    exit();
}
include("../controller/traitement.php");
include("../config/database.php");

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($email) && !empty($password)) {
        $user = validLogIn($cnx, $email, $password);

        if ($user) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['nom'] = $user['nom'];
            redirect('./home_page.php');
        } else {
            $error = "Identifiants invalides !";
        }
    } else {
        $error = "Veuillez remplir tous les champs !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="auth-layout">
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h2>Content de vous revoir</h2>
                    <img src="../images/logo.png" alt="Logo" class="logo">
                </div>
                <div class="card-content">
                    <form action="" method="POST" id="loginForm">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                        <div class="input-group">
                            <label for="email">Adresse Email</label>
                            <div class="input-icon">
                                <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
                                <span class="icon">📧</span>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="password">Mot de passe</label>
                            <div class="input-icon">
                                <input type="password" id="password" name="password" placeholder="••••••" required>
                                <span class="icon">🔒</span>
                                <span class="toggle-password">🙈</span> 
                            </div>
                        </div>
                        <button type="submit" id="registerBtn" name="submit_user">Se connecter</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="http://localhost/projet_animeau/view/signup.php">Créer un compte/</a>
                    <a href="http://localhost/projet_animeau/view/mdpOublier.php">Mot de passe oublié ?</a>
                </div>
            </div>
        </div>

        <!-- Arrière-plan Blob -->
        <div class="blob-container">
            <svg viewBox="0 0 500 500" width="100%" id="blobSvg">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color: #5F6F52;" />
                        <stop offset="100%" style="stop-color: #A9B388;" />
                    </linearGradient>
                </defs>
                <path id="blob" d="M398.5,320.5Q362,391,280.5,433Q199,475,128.5,409Q58,343,55,249Q52,155,133.5,126.5Q215,98,299.5,90Q384,82,409.5,166Q435,250,398.5,320.5Z" fill="url(#gradient)" />
            </svg>
        </div>
    </div>
</body>
</html>