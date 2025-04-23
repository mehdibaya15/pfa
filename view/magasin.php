<?php
include("../controller/traitement.php");
include("../config/database.php");
$animaux = [];

try {
    if (isset($_GET['search1']) && !empty($_GET['search1'])) {
        $animaux = rechercheAnimalIndexee($cnx, $_GET['search1']) ?? [];
        if (!empty($animaux)) {
            usort($animaux, function($a, $b) {
                return ($b['score'] ?? 0) <=> ($a['score'] ?? 0);
            });
        }
    } else {
        $animaux = getAnimals($cnx) ?? [];
    }
} catch (Exception $e) {
    error_log("Erreur lors de la récupération des animaux: " . $e->getMessage());
    $animaux = [];
}
$animaux = is_array($animaux) ? $animaux : [];
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
    <script src="pagination.js"></script>
</head>

<body>
 <?php include("header.php");?>

    <div class="main-content">
        <div class="container">
            <div class="filters-container">
                <div class="filters-section">
                    <div class="animal-types">
                        <a href="magasin.php" class="animal-type-btn active">Tous</a>
                        <a href="chien.php" class="animal-type-btn">Chien</a>
                        <a href="chat.php" class="animal-type-btn">Chat</a>
                        <a href="hamster.php" class="animal-type-btn">Hamster</a>
                        <a href="oiseaux.php" class="animal-type-btn">Oiseaux</a>
                        <a href="poisson.php" class="animal-type-btn">Poisson</a>
                        <a href="lapin.php" class="animal-type-btn">Lapin</a>
                        <a href="singe.php" class="animal-type-btn">Singe</a>
                    </div>
                    
                    <div class="search-sort-row">
                        <form method="GET" action="">
                            <div class="search-box">
                                <input type="text" class="form-control" placeholder="Rechercher un animal..." 
                                       name="search1" value="<?= htmlspecialchars($_GET['search1'] ?? '') ?>">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                        <div class="sort-options">
                            <span>Trier par :</span>
                            <select id="sort-select">
                                <option value="relevant">Race</option>
                                <option value="recent">Age</option>
                                <option value="recent">Localisation</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="animals-listing">
                <div class="container">
                    <?php if (isset($_GET['search1']) && !empty($_GET['search1'])): ?>
                        <div class="alert alert-info mb-3">
                            <?= count($animaux) ?> résultat(s) trouvé(s) pour "<?= htmlspecialchars($_GET['search1']) ?>"
                        </div>
                    <?php endif; ?>
    
                    <div class="row">
                        <?php if (!empty($animaux)): ?>
                            <?php foreach ($animaux as $animal): ?>
                                <?php if (is_array($animal)): // Vérification supplémentaire ?>
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="card animal-card"> 
                                            <img src="<?= htmlspecialchars($animal['image_url'] ?? '') ?>" class="card-img-top" alt="<?= htmlspecialchars($animal['race'] ?? '') ?>">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?= htmlspecialchars($animal['nom'] ?? '') ?> - <?= htmlspecialchars($animal['race'] ?? '') ?>
                                                </h5>
                                                <p class="card-text"><?= htmlspecialchars($animal['description'] ?? '') ?></p>
                                                <div class="animal-details">
                                                    <span><i class="fas fa-venus-mars"></i> <?= ($animal['sexe'] ?? '') === 'F' ? 'Femelle' : 'Mâle' ?></span>
                                                    <span><i class="fas fa-birthday-cake"></i> <?= htmlspecialchars($animal['age'] ?? '') ?> an(s)</span>
                                                    <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($animal['ville'] ?? '') ?></span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <a href="adaptationInfo.php" class="btn btn-adopt">Adopter</a>
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
                    
                    <?php if (!empty($animaux)): ?>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item" id="prev-page">
                                    <a class="page-link" href="#" tabindex="-1">Précédent</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#" data-page="1">1</a></li>
                                <li class="page-item"><a class="page-link" href="#" data-page="2">2</a></li>
                                <li class="page-item"><a class="page-link" href="#" data-page="3">3</a></li>
                                <li class="page-item" id="next-page">
                                    <a class="page-link" href="#">Suivant</a>
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
