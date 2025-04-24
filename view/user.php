<?php
include "../config/database.php";
include "../controller/traitement.php";

// Replace these with your actual functions to fetch data
$animaux = getAnimals($cnx);
// $users = getUsers($cnx);
// $adoptions = getAdoptionRequests($cnx);
echo "<script>console.log('question ajouté avec succès: " . $animaux . "');</script>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }

        .sidebar {
            min-width: 200px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding: 1rem;
        }

        .sidebar a {
            color: white;
            display: block;
            margin: 10px 0;
            text-decoration: none;
        }

        .sidebar a:hover {
            text-decoration: underline;
        }

        .content {
            flex: 1;
            padding: 2rem;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 26px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4>Admin Panel</h4>
        <a href="#animals">Animals</a>
        <a href="#users">Users</a>
        <a href="#adoptions">Adoption Requests</a>
    </div>

    <div class="content">
        <div class="admin-header">
            <h2 id="animals">All Animals</h2>
            <a href="add_animal.php" class="btn btn-primary">add animal</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>categorie</th>
                    <th>race</th>
                    <th>sexe</th>
                    <th>Age</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($animaux as $animal): ?>
                    <tr>
                        <td><?= $animal['id_animal'] ?></td>
                        <td><?= $animal['nom'] ?></td>
                        <td><?= $animal['categorie'] ?></td>
                        <td><?= $animal['race'] ?></td>
                        <td><?= $animal['sexe'] ?></td>
                        <td><?= $animal['age'] ?></td>

                        <td><?= $animal['description'] ?></td>
                        <td>
                            <a href="admin_update.php?id=<?= $animal['id_animal'] ?> " class="btn btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                </svg>
                            </a>
                            <a href="delete_animal.php?id=<?= $animal['id_animal'] ?>"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?');"
                                class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                </svg>
                            </a>

                        </td>


                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- 
        <h2 id="users" class="mt-5">All Users</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th><th>Username</th><th>Email</th>
                </tr>
            </thead>
            <tbody>
                <
            </tbody>
        </table>

        <h2 id="adoptions" class="mt-5">Adoption Requests</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th><th>User ID</th><th>Animal ID</th><th>Status</th><th>Date</th>
                </tr>
            </thead>
            
        </table> -->
    </div>
</body>

</html>