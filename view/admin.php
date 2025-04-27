<?php
include "../config/database.php";
include "../controller/traitement.php";
session_start();
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $animaux = rechercheAnimalIndexee($cnx, $searchTerm);
} else {
    $animaux = insertAnimals($cnx);
}
$messages = getCommentaire($cnx);
$avis = getAvis($cnx);
$users = getUsers($cnx); // Décommentez quand la fonction sera disponible
$adoptions = getAdoptionRequests($cnx); // Décommentez quand la fonction sera disponible

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
            position: sticky;
            top: 0;
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

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .action-buttons {
            white-space: nowrap;
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
                <a onclick="showSection('contact-section')"><i class="fas fa-envelope me-2"></i>Messages des
                    utilisateurs</a>
                <a onclick="showSection('avis-section')"><i class="fas fa-star me-2"></i>Avis des utilisateurs</a>
                <a href="../view/home_page.php"><i class="fas fa-home me-2"></i>Retour au site</a>
            </div>

            <div class="col-md-9 p-4">
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_SESSION['message']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <!-- Section Animaux -->
                <div id="animals-section" class="section active">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Tous les animaux</h5>
                            <a href="add_animal.php" class="btn btn-light btn-sm">
                                <i class="fas fa-plus me-1"></i>Ajouter un animal
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="" class="mb-4">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Rechercher un animal..."
                                        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <?php if (isset($_GET['search'])): ?>
                                        <a href="admin.php" class="btn btn-secondary">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="thead-dark">
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
                                                    <a href="admin_update.php?id=<?= $animal['id_animal'] ?>"
                                                        class="btn btn-info btn-sm me-1" title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm delete-btn" title="Supprimer"
                                                        data-id="<?= $animal['id_animal'] ?>" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal">
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
                </div>

                <!-- Section Utilisateurs -->
                <div id="users-section" class="section">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Tous les utilisateurs</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Adresse</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($user['id_utilisateur']) ?></td>
                                                <td><?= htmlspecialchars($user['nom']) ?></td>
                                                <td><?= htmlspecialchars($user['prenom']) ?></td>
                                                <td><?= htmlspecialchars($user['email']) ?></td>
                                                <td><?= htmlspecialchars($user['telephone']) ?></td>
                                                <td><?= htmlspecialchars($user['adresse']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Demandes d'adoption -->
                <div id="adoptions-section" class="section">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Demandes d'adoption</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Gender</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>User Email</th>
                                            <th>Telephone</th>
                                            <th>Postal</th>
                                            <th>Ville</th>
                                            <th>Motivation</th>
                                            <th>Family</th>
                                            <th>Enfant</th>
                                            <th>Id Animal</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($adoptions as $adoption): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($adoption['id_demande']) ?></td>
                                                <td><?= htmlspecialchars($adoption['gender']) ?></td>
                                                <td><?= htmlspecialchars($adoption['nom']) ?></td>
                                                <td><?= htmlspecialchars($adoption['prenom']) ?></td>
                                                <td><?= htmlspecialchars($adoption['email']) ?></td>
                                                <td><?= htmlspecialchars($adoption['telephone']) ?></td>
                                                <td><?= htmlspecialchars($adoption['postal']) ?></td>
                                                <td><?= htmlspecialchars($adoption['ville']) ?></td>
                                                <td><?= htmlspecialchars($adoption['motivation']) ?></td>
                                                <td><?= htmlspecialchars($adoption['family']) ?></td>
                                                <td><?= htmlspecialchars($adoption['enfant'] == 0 ? 'non' : 'oui') ?></td>
                                                <td><?= htmlspecialchars($adoption['id_animal']) ?></td>


                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Messages des utilisateurs -->
                <div id="contact-section" class="section">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Messages des utilisateurs</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($messages as $message): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($message['id_contact']) ?></td>
                                                <td><?= htmlspecialchars($message['name']) ?></td>
                                                <td><?= htmlspecialchars($message['email']) ?></td>
                                                <td><?= htmlspecialchars($message['message']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Avis des utilisateurs -->
                <div id="avis-section" class="section">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Avis des utilisateurs</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Avis</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($avis as $avi): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($avi['id_avis']) ?></td>
                                                <td><?= htmlspecialchars($avi['name']) ?></td>
                                                <td><?= htmlspecialchars($avi['review']) ?></td>
                                                <td>
                                                    <?php
                                                    $rating = htmlspecialchars($avi['rating']);
                                                    for ($i = 1; $i <= 5; $i++):
                                                        $starClass = $i <= $rating ? 'fas fa-star text-warning' : 'far fa-star text-secondary';
                                                        ?>
                                                        <i class="<?= $starClass ?>"></i>
                                                    <?php endfor; ?>
                                                    (<?= $rating ?>/5)
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showSection(id) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(id).classList.add('active');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet animal ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a id="confirmDelete" href="#" class="btn btn-danger">Supprimer</a>

                </div>

            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const confirmDeleteLink = document.getElementById('confirmDelete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const animalId = this.getAttribute('data-id');
                    // Set the href dynamically with the correct animal ID
                    confirmDeleteLink.href = 'delete_animal.php?id=' + animalId;
                });
            });
        });
    </script>

</body>

</html>
