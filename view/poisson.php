<?php
include("../controller/traitement.php");
include("../config/database.php");
$categorie = "poisson";
$animaux = [];
$itemsPerPage = 6;
$currentPage = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$offset = ($currentPage - 1) * $itemsPerPage;
if (!empty($search)) {
    $animaux = rechercheAnimalCat($cnx, $search, $categorie);
} else {
    $animaux = insertAnimalByCategorie($cnx, $categorie);
}
try {
    if (!empty($animaux) && isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        usort($animaux, function ($a, $b) use ($sort) {
            switch ($sort) {
                case 'age':
                    return ($a['age'] ?? 0) <=> ($b['age'] ?? 0);
                case 'localisation':
                    return strcmp($a['ville'] ?? '', $b['ville'] ?? '');
                case 'race':
                    return strcmp($a['race'] ?? '', $b['race'] ?? '');
                default:
                    return 0;
            }
        });
    }
    // Get total count for pagination
    $totalAnimaux = count($animaux);
    $totalPages = ceil($totalAnimaux / $itemsPerPage);
    // Apply pagination
    $animaux = array_slice($animaux, $offset, $itemsPerPage);
} catch (Exception $e) {
    error_log("Erreur lors de la récupération des animaux: " . $e->getMessage());
    $animaux = [];
    $totalAnimaux = 0;
    $totalPages = 1;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="magasin.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="magasinprep.js"></script>
    <style>
        /* Custom styles for adoption buttons */
        .btn-adopt {
            background-color: #5F6F52;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-adopt:not(.disabled) {
            background-color: #5F6F52;
        }

        .btn-adopt:not(.disabled):hover {
            background-color: #4a5a3d;
            transform: translateY(-2px);
            color: white;
        }

        .btn-adopt.disabled {
            background-color: #e0e0e0;
            color: #9e9e9e;
            cursor: not-allowed;
            opacity: 1;
            box-shadow: none;
            transform: none;
            border: 1px solid #d0d0d0;
        }

        .btn-primary:disabled {
            background-color: #e0e0e0;
            color: #9e9e9e;
            border-color: #d0d0d0;
            cursor: not-allowed;
            opacity: 1;
        }

        /* Adopted badge style */
        .adopted-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .adopted-badge i {
            font-size: 1rem;
        }

        /* Card styling */
        .animal-card {
        position: relative;
        transition: transform 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        width: -webkit-fill-available;
    }

    .card-img-top {
        object-fit: cover; /* Ensures images maintain aspect ratio */
        width: 100%;
    }

    .card-body {
        flex: 1; /* Makes the card body grow to fill available space */
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .card-text {
        flex-grow: 1; /* Makes the description take up available space */
        overflow: hidden; /* Hides overflow text */
        text-overflow: ellipsis; /* Adds ellipsis if text is too long */
        display: -webkit-box;
        -webkit-line-clamp: 3; /* Limits to 3 lines */
        -webkit-box-orient: vertical;
    }

    /* Ensure the adoption button stays at the bottom */
    .mt-3 {
        margin-top: auto !important; /* Pushes the button to the bottom */
    }

    /* Make sure all cards in a row have equal height */
    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .mb-4 {
        display: flex;
    }

        .animal-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .animal-details {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .animal-details span {
            display: flex;
            align-items: center;
            gap: 3px;
        }
        .card-body {
        flex: 1; /* Makes the card body grow to fill available space */
        display: flex;
        flex-direction: column;
    }
    
        
    </style>
</head>

<body>
    <?php include("header.php"); ?>

    <div class="main-content">
        <div class="container">
            <div class="filters-container">
                <div class="filters-section">
                    <div class="animal-types">
                        <a href="magasin.php" class="animal-type-btn ">Tous</a>
                        <a href="chien.php" class="animal-type-btn">Chien</a>
                        <a href="chat.php" class="animal-type-btn">Chat</a>
                        <a href="hamster.php" class="animal-type-btn">Hamster</a>
                        <a href="oiseaux.php" class="animal-type-btn">Oiseaux</a>
                        <a href="poisson.php" class="animal-type-btn active">Poisson</a>
                        <a href="lapin.php" class="animal-type-btn">Lapin</a>
                        <a href="singe.php" class="animal-type-btn ">Singe</a>
                    </div>

                    <div class="search-sort-row">
                        <form method="GET" action="">
                            <div class="search-box">
                                <input type="text" class="form-control" placeholder="Rechercher un animal..." 
                                       name="search1" value="<?= htmlspecialchars($_GET['search1'] ?? '') ?>">
                                <?php if (isset($_GET['sort'])): ?>
                                    <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort']) ?>">
                                <?php endif; ?>
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                        <div class="sort-options">
                            <span>Trier par :</span>
                            <form method="GET" action="" id="sort-form">
                                <?php if (isset($_GET['search1']) && !empty($_GET['search1'])): ?>
                                    <input type="hidden" name="search1" value="<?= htmlspecialchars($_GET['search1']) ?>">
                                <?php endif; ?>
                                <select name="sort" id="sort-select" onchange="this.form.submit()">
                                    <option value="">-- Sélectionner --</option>
                                    <option value="race" <?= (isset($_GET['sort']) && $_GET['sort'] === 'race' ? 'selected' : '' )?>>Race</option>
                                    <option value="age" <?= (isset($_GET['sort']) && $_GET['sort'] === 'age' ? 'selected' : '' )?>>Age</option>
                                    <option value="localisation" <?= (isset($_GET['sort']) && $_GET['sort'] === 'localisation' ? 'selected' : '' )?>>Localisation</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="animals-listing">
                <div class="container">
                    <?php if (isset($_GET['search1']) && !empty($_GET['search1'])): ?>
                        <div class="alert alert-info mb-3">
                            <?= $totalAnimaux ?> résultat(s) trouvé(s) pour "<?= htmlspecialchars($_GET['search1']) ?>"
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <?php if (!empty($animaux)): ?>
                            <?php foreach ($animaux as $animal): ?>
                                <?php if (is_array($animal)): ?>
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="card animal-card">
                                            <img src="<?= htmlspecialchars($animal['image_url'] ?? '') ?>" class="card-img-top"
                                                alt="<?= htmlspecialchars($animal['race'] ?? '') ?>">
                                            <?php if (($animal['adopter'] ?? '') == 1): ?>
                                                <div class="adopted-badge">
                                                    <i class="fas fa-check-circle"></i> Adopté
                                                </div>
                                            <?php endif; ?>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?= htmlspecialchars($animal['nom'] ?? '') ?> -
                                                    <?= htmlspecialchars($animal['race'] ?? '') ?>
                                                </h5>
                                                <p class="card-text"><?= htmlspecialchars($animal['description'] ?? '') ?></p>
                                                <div class="animal-details">
                                                    <span><i class="fas fa-venus-mars"></i>
                                                        <?= ($animal['sexe'] ?? '') === 'F' ? 'Femelle' : 'Mâle' ?></span>
                                                    <span><i class="fas fa-birthday-cake"></i>
                                                        <?= htmlspecialchars($animal['age'] ?? '') ?> an(s)</span>
                                                    <span><i class="fas fa-map-marker-alt"></i>
                                                        <?= htmlspecialchars($animal['ville'] ?? '') ?></span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <?php if (isset($_SESSION['email'])): ?>
                                                        <a href="adaptationInfo.php?id=<?= $animal['id_animal'] ?? '' ?>"
                                                           class="btn btn-adopt <?= ($animal['adopter'] ?? '') == 1 ? 'hidden' : '' ?>"
                                                           <?= ($animal['adopter'] ?? '') == 1 ? 'aria-disabled="true" tabindex="-1"' : '' ?>>
                                                            <?= ($animal['adopter'] ?? '') == 1 ? 'Déjà adopté' : 'Adopter' ?>
                                                        </a>
                                                    <?php else: ?>
                                                        <button class="btn btn-primary" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#loginRequiredModal"
                                                                <?= ($animal['adopter'] ?? '') == 1 ? 'hidden' : '' ?>
                                                                >
                                                            <?= ($animal['adopter'] ?? '') == 1 ? 'Déjà adopté' : 'Adopter' ?>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="alert alert-warning">Aucun animal disponible pour le moment.</div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($totalPages > 1): ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?<?=
                                        http_build_query(array_merge($_GET, ['page' => $currentPage - 1]))
                                        ?>" aria-label="Précédent">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                <?php
                                // Afficher maximum 5 pages autour de la page courante
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($totalPages, $startPage + 4);

                                // Ajuster si on est proche de la fin
                                if ($endPage - $startPage < 4) {
                                    $startPage = max(1, $endPage - 4);
                                }

                                // Première page + ... si nécessaire
                                if ($startPage > 1) {
                                    echo '<li class="page-item"><a class="page-link" href="?' .
                                        http_build_query(array_merge($_GET, ['page' => 1])) . '">1</a></li>';
                                    if ($startPage > 2) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                }

                                // Pages centrales
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '">';
                                    echo '<a class="page-link" href="?' .
                                        http_build_query(array_merge($_GET, ['page' => $i])) . '">' . $i . '</a>';
                                    echo '</li>';
                                }

                                // Dernière page + ... si nécessaire
                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="?' .
                                        http_build_query(array_merge($_GET, ['page' => $totalPages])) . '">' . $totalPages . '</a></li>';
                                }
                                ?>

                                <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?<?=
                                        http_build_query(array_merge($_GET, ['page' => $currentPage + 1]))
                                        ?>" aria-label="Suivant">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Required Modal -->
    <div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-labelledby="loginRequiredModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginRequiredModalLabel">Connexion requise</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Vous devez être connecté pour adopter un animal. Souhaitez-vous vous connecter ou créer un compte ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <a href="signup.php" class="btn btn-primary">S'inscrire / Se connecter</a>
                </div>
            </div>
        </div>
    </div>

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
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>© 2025 Adoption Animaux. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>