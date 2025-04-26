<?php
include("../controller/traitement.php");
include("../config/database.php");
$categorie = "lapin";

// Configuration de la pagination
$itemsPerPage = 6;
$currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1; 
$offset = ($currentPage - 1) * $itemsPerPage; 

// Récupération des paramètres
$search = $_GET['search1'] ?? '';
$sort = $_GET['sort'] ?? '';

if (!empty($search)) {
    $allAnimaux = rechercheAnimalCat($cnx, $search, $categorie);
} else {
    $allAnimaux = insertAnimalByCategorie($cnx, $categorie);
}

// Tri des animaux si paramètre de tri présent
if (!empty($allAnimaux) && !empty($sort)) {
    usort($allAnimaux, function ($a, $b) use ($sort) {
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

// Calcul du nombre total d'animaux et de pages
$totalAnimaux = count($allAnimaux ?? []);
$totalPages = ceil($totalAnimaux / $itemsPerPage);
$animaux = array_slice($allAnimaux ?? [], $offset, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapins</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_home.css">
    <link rel="stylesheet" href="magasin.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- Navbar -->
    <?php include("header.php");?>

    <div class="main-content">
        <div class="container">
            <div class="filters-container">
                <div class="filters-section">
                    <div class="animal-types">
                        <a href="magasin.php" class="animal-type-btn">Tous</a>
                        <a href="chien.php" class="animal-type-btn">Chien</a>
                        <a href="chat.php" class="animal-type-btn ">Chat</a>
                        <a href="hamster.php" class="animal-type-btn">Hamster</a>
                        <a href="oiseaux.php" class="animal-type-btn">Oiseaux</a>
                        <a href="poisson.php" class="animal-type-btn">Poisson</a>
                        <a href="lapin.php" class="animal-type-btn active">Lapin</a>
                        <a href="singe.php" class="animal-type-btn">Singe</a>
                    </div>
                    
                    <div class="search-sort-row">
                        <form method="GET" action="">
                            <div class="search-box">
                                <input type="text" class="form-control" placeholder="Rechercher un animal..." 
                                       name="search1" value="<?= htmlspecialchars($search) ?>">
                                <?php if (!empty($sort)): ?>
                                    <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                                <?php endif; ?>
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                        <div class="sort-options">
                            <span>Trier par :</span>
                            <form method="GET" action="">
                                <?php if (!empty($search)): ?>
                                    <input type="hidden" name="search1" value="<?= htmlspecialchars($search) ?>">
                                <?php endif; ?>
                                <select name="sort" class="form-select" onchange="this.form.submit()">
                                    <option value="">-- Sélectionner --</option>
                                    <option value="race" <?= $sort === 'race' ? 'selected' : '' ?>>Race</option>
                                    <option value="age" <?= $sort === 'age' ? 'selected' : '' ?>>Age</option>
                                    <option value="localisation" <?= $sort === 'localisation' ? 'selected' : '' ?>>Localisation</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="animals-listing">
                <div class="container">
                    <?php if (!empty($search)): ?>
                        <div class="alert alert-info mb-3">
                            <?= $totalAnimaux ?> résultat(s) trouvé(s) pour "<?= htmlspecialchars($search) ?>"
                        </div>
                    <?php endif; ?>
                    
                    <div class="row">
                        <?php if (!empty($animaux)): ?>   
                            <?php foreach ($animaux as $animal): ?>  
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card animal-card">
                                        <div class="animal-badge"></div>
                                        <img src="<?= htmlspecialchars($animal['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($animal['race']) ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($animal['nom']) ?> - <?= htmlspecialchars($animal['race']) ?></h5>
                                            <p class="card-text"><?= htmlspecialchars($animal['description']) ?></p>
                                            <div class="animal-details">
                                                <span><i class="fas fa-venus-mars"></i> <?= $animal['sexe'] === 'F' ? 'Femelle' : 'Mâle' ?></span>
                                                <span><i class="fas fa-birthday-cake"></i> <?= htmlspecialchars($animal['age']) ?> an(s)</span>
                                                <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($animal['ville']) ?></span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <a href="adaptationInfo.php?id=<?= $animal['id'] ?? '' ?>" class="btn btn-adopt">Adopter</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                        http_build_query(array_filter([
                                            'search1' => $search,
                                            'sort' => $sort,
                                            'page' => $currentPage - 1
                                        ])) 
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
                                         http_build_query(array_filter([
                                             'search1' => $search,
                                             'sort' => $sort,
                                             'page' => 1
                                         ])) . '">1</a></li>';
                                    if ($startPage > 2) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                }
                                
                                // Pages centrales
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    echo '<li class="page-item ' . ($i == $currentPage ? 'active' : '') . '">';
                                    echo '<a class="page-link" href="?' . 
                                         http_build_query(array_filter([
                                             'search1' => $search,
                                             'sort' => $sort,
                                             'page' => $i
                                         ])) . '">' . $i . '</a>';
                                    echo '</li>';
                                }
                                
                                // Dernière page + ... si nécessaire
                                if ($endPage < $totalPages) {
                                    if ($endPage < $totalPages - 1) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    echo '<li class="page-item"><a class="page-link" href="?' . 
                                         http_build_query(array_filter([
                                             'search1' => $search,
                                             'sort' => $sort,
                                             'page' => $totalPages
                                         ])) . '">' . $totalPages . '</a></li>';
                                }
                                ?>
                                
                                <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?<?= 
                                        http_build_query(array_filter([
                                            'search1' => $search,
                                            'sort' => $sort,
                                            'page' => $currentPage + 1
                                        ])) 
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