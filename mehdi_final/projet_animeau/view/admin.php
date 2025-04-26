<?php
include "../config/database.php";
include "../controller/traitement.php";
// session_start();
// if (!isset($_SESSION['email']) || $_SESSION['email'] !== ADMIN_EMAIL) {
//     header('Location: ../index.php');
//     exit();
// }
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $allAnimaux = rechercheAnimalIndexee($cnx, $searchTerm);
} else {
    $allAnimaux = insertAnimals($cnx);
}

// Récupération des données
$animaux = insertAnimals($cnx);
//$users = getUsers($cnx); // Décommentez quand la fonction sera disponible
//$adoptions = getAdoptionRequests($cnx); // Décommentez quand la fonction sera disponible
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #5F6F52;
            --secondary-color: #A9B388;
            --light-color: #FEFAE0;
            --dark-color: #333;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: var(--primary-color);
            color: white;
            padding: 2rem 1rem;
        }

        .sidebar h4 {
            color: var(--light-color);
            margin-bottom: 2rem;
            text-align: center;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sidebar a:hover {
            background-color: var(--secondary-color);
            transform: translateX(5px);
        }

        .admin-header h2 {
            font-weight: 700;
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: #4a5a3d;
        }

        .btn-info {
            background-color: var(--secondary-color);
            border: none;
            color: white;
        }

        .btn-info:hover {
            background-color: #8a9772;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h4>Tableau de bord Admin</h4>
                <a onclick="showSection('animals-section')"><i class="fas fa-paw me-2"></i>Animaux</a>
                <a onclick="showSection('users-section')"><i class="fas fa-users me-2"></i>Utilisateurs</a>
                <a onclick="showSection('adoptions-section')"><i class="fas fa-heart me-2"></i>Demandes d'adoption</a>
                <a href="../view/home_page.php"><i class="fas fa-home me-2"></i>Retour au site</a>
            </div>

            <div class="col-md-9 p-4">
                <!-- Section Animaux -->
                <div id="animals-section" class="section">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Tous les animaux</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="" class="d-flex mb-3">
                                <div class="input-group me-2">
                                    <input type="text" name="search" class="form-control" placeholder="Rechercher un animal..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                    <button class="btn btn-outline-light" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <?php if(isset($_GET['search'])): ?>
                                        <a href="admin_dashboard.php" class="btn btn-secondary"><i class="fas fa-times"></i></a>
                                    <?php endif; ?>
                                </div>
                                <a href="add_animal.php" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Ajouter un animal
                                </a>
                            </form>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Catégorie</th>
                                        <th>Race</th>
                                        <th>Sexe</th>
                                        <th>Âge</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($animaux as $animal): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($animal['id_animal']) ?></td>
                                            <td><?= htmlspecialchars($animal['nom']) ?></td>
                                            <td><?= htmlspecialchars($animal['categorie']) ?></td>
                                            <td><?= htmlspecialchars($animal['race']) ?></td>
                                            <td><?= htmlspecialchars($animal['sexe']) ?></td>
                                            <td><?= htmlspecialchars($animal['age']) ?></td>
                                            <td><?= htmlspecialchars($animal['description']) ?></td>
                                            <td>
                                                <a href="admin_update.php?id=<?= $animal['id_animal'] ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="delete_animal.php?id=<?= $animal['id_animal'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Section Utilisateurs -->
                <div id="users-section" class="section" style="display:none">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Tous les utilisateurs</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Les données utilisateurs seront affichées ici -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Section Demandes d'adoption -->
                <div id="adoptions-section" class="section" style="display:none">
                    <div class="card">
                        <div class="card-header">
                            <h5>Demandes d'adoption</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ID d'utilisateur</th>
                                        <th>ID d'animal</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Les données d'adoption seront affichées ici -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(id) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.style.display = 'none');
            document.getElementById(id).style.display = 'block';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>