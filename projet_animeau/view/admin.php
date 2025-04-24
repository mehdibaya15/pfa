<?php
include "../config/database.php";
include "../controller/traitement.php";
session_start();
if (!isset($_SESSION['email']) || $_SESSION['email'] !== ADMIN_EMAIL) {
    header('Location: ../index.php');
    exit();
}
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $allAnimaux = rechercheAnimalIndexee($cnx, $searchTerm) ;
} else {
    $allAnimaux = insertAnimals($cnx) ; 
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: var(--dark-color);
        }
        
        .sidebar {
            min-width: 250px;
            height: 100vh;
            background-color: var(--primary-color);
            color: white;
            padding: 2rem 0.7rem;
            position: fixed;
        }
        
        .sidebar h4 {
            color: var(--light-color);
            margin-bottom: 2rem;
            font-weight: 600;
            text-align: center;
        }
        
        .sidebar a {
            color: white;
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .sidebar a:hover {
            background-color: var(--secondary-color);
            transform: translateX(5px);
        }
        
        .content {
            margin-left: 250px;
            padding: 2rem;
            flex: 1;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--secondary-color);
        }
        
        .admin-header h2 {
            color: var(--primary-color);
            font-weight: 700;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #4a5a3d;
            border-color: #4a5a3d;
        }
        
        .btn-info {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }
        
        .btn-info:hover {
            background-color: #8a9772;
            border-color: #8a9772;
        }
        
        .table {
            margin-top: 1rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .table thead {
            background-color: var(--primary-color);
            color: white;
        }
        
        .table th {
            font-weight: 600;
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .input-group {
            width: auto;
            min-width: 250px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 1rem;
            }
            
            .content {
                margin-left: 0;
            }
            
            .admin-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            .input-group {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4>Tableau de bord Admin</h4>
        <a href="#animals"><i class="fas fa-paw me-2"></i>Animaux</a>
        <a href="#users"><i class="fas fa-users me-2"></i>Utilisateurs</a>
        <a href="#adoptions"><i class="fas fa-heart me-2"></i>Demandes d'adoption</a>
        <a href="../view/home_page.php"><i class="fas fa-home me-2"></i>Retour au site</a>
    </div>

    <div class="content">
        <!-- Section Animaux -->
       
    <div class="admin-header">
    <h2 id="animals">Tous les animaux</h2>
    <div class="d-flex">
        <form method="GET" action="" class="me-2">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un animal..." 
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                <?php if(isset($_GET['search'])): ?>
                    <a href="admin_dashboard.php" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                    </a>
                <?php endif; ?>
            </div>
        </form>
        <a href="add_animal.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Ajouter un animal
        </a>
        </div>
        </div>
            
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
                        <td class="action-buttons">
                            <a href="admin_update.php?id=<?= $animal['id_animal'] ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="delete_animal.php?id=<?= $animal['id_animal'] ?>"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');"
                                class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Section Utilisateurs -->
        <div class="admin-header mt-5">
            <h2 id="users">Tous les utilisateurs</h2>
        </div>
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

        <!-- Section Demandes d'adoption -->
        <div class="admin-header mt-5">
            <h2 id="adoptions">Demandes d'adoption</h2>
        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>