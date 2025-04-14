<?php
include("../config/database.php");
include("../controller/traitement.php");

if (isset($_POST['submit_user'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $cnx->prepare("SELECT email FROM utilisateur WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $emailEx = $stmt->fetch();
    if ($emailEx) {
        $error_message = "Cet email est déjà enregistré.";
    } 
    else {
        if (AjouterUtilisateur($cnx, $_POST)) {
            $_SESSION['user'] = [
                'email' => $email,
                'nom' => $nom,
                'prenom' => $prenom
            ];
            header("Location: dashboard.php");
            exit();
        } 
        else {
            $error_message = "Une erreur s'est produite lors de l'inscription.";
        }
    
    
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="auth-layout">
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <h2>CRÉEZ VOTRE COMPTE</h2>
                    <img src="../images/logo.png" alt="Logo" class="logo">
                </div>
                <div class="card-content">
                    <form action="" method="POST" id="registerForm">
                        <div class="flex">
                            <div class="input-group">
                                <label for="nom">Nom</label>
                                <div class="input-icon">
                                    <input type="text" id="nom" name="nom" placeholder="Doe" required>
                                    <span class="icon">🧑</span>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="prenom">Prénom</label>
                                <div class="input-icon">
                                    <input type="text" id="prenom" name="prenom" placeholder="John" required>
                                    <span class="icon">🧑</span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="email">Email</label>
                            <div class="input-icon">
                                <input type="email" id="email" name="email" placeholder="john.doe@example.com" required>
                                <span class="icon">📧</span>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <div class="input-icon">
                                <input type="password" id="password" name="password" placeholder="******" required>
                                <span class="icon">🔒</span>
                                <span class="toggle-password">👁️</span>
                            </div>
                        </div>
                        <?php if (isset($error_message)) { echo "<p class='error-message'>$error_message</p>"; } ?>
                        <button type="submit" id="registerBtn" name="submit_user">Register</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="http://localhost/projet_animeau/view/">Already have an account? Se connecter</a>
                </div>
            </div>
        </div>

        <!-- Blob Background -->
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