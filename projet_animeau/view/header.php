<?php
if (isset($_GET['logout'])) {
    // Nettoyage complet de la session
    $_SESSION = array();
    session_unset();
    
   if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
   redirect('index.php'); 
   exit();
}
session_start();
$user = null;
if (isset($_SESSION['email'])) {
    $req = "SELECT * FROM utilisateur WHERE email = ?";
    $stm = $cnx->prepare($req);
    $stm->execute([$_SESSION['email']]);
    $user = $stm->fetch();
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
    <title>PETTY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_home.css">
    <script >
        document.addEventListener('DOMContentLoaded', function() {
        var dropdowns = document.querySelectorAll('.dropdown-toggle');
        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('click', function(e) {
                e.preventDefault();
                var dropdownMenu = this.nextElementSibling;
                dropdownMenu.classList.toggle('show');
        });
    });
    });
    </script>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home_page.php">
                <img src="../images/logo.png" alt="Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home_page.php">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="magasin.php">BOUTIQUE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">CONTACT</a>
                    </li>
                </ul>

                <form method="GET" action="">
                    <div class="search-box">
                        <input type="search" class="form-control" placeholder="Rechercher ..." name="search" value="<?php if(isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>">
                        <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

                <ul class="navbar-nav ms-auto">
                    <?php if(isset($_SESSION['email'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> 
                                <?= htmlspecialchars($user['prenom'] ?? $user['email']) ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="profile.php">Profil</a></li>
                                <li><a class="dropdown-item" href="?logout=1" >Déconnexion</a></li>
                                
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="signup.php" class="btn btn-register">
                                <i class="fas fa-user-plus me-2"></i>ENREGISTRER
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    </body>
    </html>
