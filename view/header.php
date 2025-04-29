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
    <style>
        /* Styles responsives supplémentaires */
        @media (max-width: 992px) {
            .search-box {
                width: 100%;
                margin: 10px 0;
                order: 3;
            }
            
            .navbar-nav.ms-auto {
                flex-direction: row;
                justify-content: space-around;
                width: 100%;
            }
            
            .nav-item .btn {
                padding: 5px 10px;
                font-size: 0.9rem;
            }
            
            .navbar-brand img {
                max-height: 40px;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-nav .nav-link {
                padding: 0.5rem 0.5rem;
                font-size: 0.9rem;
            }
            
            .dropdown-menu {
                position: absolute;
            }
            
            .search-box input {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home_page.php">
                <img src="../images/logo.png" alt="Logo">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="home_page.php">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="magasin.php">BOUTIQUE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">CONTACT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">À PROPOS</a>
                    </li>
                </ul>

                <form method="GET" action="" class="d-flex mx-lg-3 mb-2 mb-lg-0">
                    <div class="search-box input-group">
                        <input type="search" class="form-control" placeholder="Rechercher..." name="search" 
                               value="<?php if(isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>">
                        <button class="btn btn-outline-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if(isset($_SESSION['email']) && $_SESSION['email'] != ADMIN_EMAIL): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>
                                <span class="d-none d-lg-inline"><?= htmlspecialchars($user['prenom'] ?? $user['email']) ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="user_profile.php"><i class="fas fa-user me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="?logout=1"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
                            </ul>
                        </li>
                    <?php elseif(isset($_SESSION['email']) && $_SESSION['email'] == ADMIN_EMAIL): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php" title="Admin">
                                <i class="fas fa-cog"></i>
                                <span class="d-none d-lg-inline">Admin</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?logout=1" title="Déconnexion">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="d-none d-lg-inline">Déconnexion</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="index.php" class="btn btn-outline-light me-2"><i class="fas fa-sign-in-alt me-1"></i><span class="d-none d-md-inline">Connexion</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="signup.php" class="btn btn-primary"><i class="fas fa-user-plus me-1"></i><span class="d-none d-md-inline">Inscription</span></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <script>
    // Fermer le menu lorsqu'on clique sur un lien
    document.querySelectorAll('#navbarContent .nav-link').forEach(link => {
        link.addEventListener('click', () => {
            const navbarCollapse = bootstrap.Collapse.getInstance(document.getElementById('navbarContent'));
            if (navbarCollapse) {
                navbarCollapse.hide();
            }
        });
    });

    // Fermer le menu lorsqu'on clique à l'extérieur
    document.addEventListener('click', function(event) {
        const navbar = document.querySelector('.navbar');
        const navbarToggler = document.querySelector('.navbar-toggler');
        const isClickInside = navbar.contains(event.target);
        
        if (!isClickInside && document.getElementById('navbarContent').classList.contains('show')) {
            navbarToggler.click(); // Ferme le menu
        }
    });
</script>
</body>
</html>