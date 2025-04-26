<?php
include("../config/database.php");
include("../controller/traitement.php");

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // cast to int for safety
    $stmt = $cnx->prepare("SELECT * FROM `animaux` WHERE `id_animal` = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch();

    echo "<script>console.log('Animaux:', " . json_encode($res) . ");</script>";
};

if (isset($_POST["update-animal"]) && isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Get form data
    $nom = $_POST['nom'];
    $race = $_POST['race'];
    $categorie = $_POST['categorie'];
    $sexe = $_POST['gender'];
    $ville = $_POST['ville'];
    $description = $_POST['description'];
    $age = $_POST['age'];

    $stmt = $cnx->prepare("UPDATE `animaux` 
        SET `nom` = :nom,
            `race` = :race,
            `categorie` = :categorie,
            `sexe` = :sexe,
            `ville` = :ville,
            `description` = :description,
            `age` = :age
        WHERE `id_animal` = :id");

    $success = $stmt->execute([
        ':nom' => $nom,
        ':race' => $race,
        ':categorie' => $categorie,
        ':sexe' => $sexe,
        ':ville' => $ville,
        ':description' => $description,
        ':age' => $age,
        ':id' => $id
    ]);

    if ($success) {
        echo "<script>alert('Animal updated successfully.'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('Error updating animal.');</script>";
    }
}





?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Adoptant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #5F6F52;
            --secondary-color: #eeece2;
            --dark-color: #333;
            --light-color: #FEFAE0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--secondary-color);
            color: var(--dark-color);
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 3px;
            background: var(--primary-color);
            border-radius: 3px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
        }

        h2 {
            font-size: 1.5rem;
            margin-top: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--secondary-color);
            color: var(--primary-color);
        }

        .highlight {
            color: var(--primary-color);
        }

        .intro-text {
            text-align: center;
            margin-bottom: 30px;
            color: #666;
        }

        .form-label {
            font-weight: 600;
            margin-top: 15px;
            color: #555;
        }

        .form-control,
        .form-select {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 140, 66, 0.25);
        }

        .form-check {
            margin-top: 8px;
        }

        .form-check-label {
            font-weight: 400;
        }

        .checkbox-group,
        .radio-group {
            background-color: var(--secondary-color);
            padding: 15px;
            border-radius: 10px;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #e67a35;
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .legal-text {
            font-size: 0.85rem;
            color: #777;
            margin-top: 20px;
        }

        .required-field::after {
            content: " *";
            color: #dc3545;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0 0 15px 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home_page.html"><i class="bi bi-house-door"></i> Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil Adoptant</li>
            </ol>
        </nav>

        <div class="header">
            <h1>VOTRE PROFIL <span class="highlight">ADOPTANT</span></h1>
            <p class="intro-text">Merci pour votre volonté d'adopter un de nos pensionnaires !<br>Veuillez remplir le
                formulaire ci-dessous.</p>
        </div>

        <form method="POST" action="">


            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label required-field">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $res["nom"] ?>"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="race" class="form-label required-field">Race</label>
                    <input type="text" class="form-control" id="race" name="race" value="<?php echo $res["race"] ?>"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label for="categorie" class="form-label required-field">Categorie</label>
                <input type="text" class="form-control" id="categorie" name="categorie"
                    value="<?php echo $res["categorie"] ?>" required>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="gender" class="form-label required-field">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="M" <?php echo (isset($res["sexe"]) && $res["sexe"] == "M") ? "selected" : ""; ?>>M
                        </option>
                        <option value="F" <?php echo (isset($res["sexe"]) && $res["sexe"] == "F") ? "selected" : ""; ?>>F
                        </option>
                    </select>

                </div>
                <div class="col-md-8 mb-3">
                    <label for="ville" class="form-label required-field">Ville</label>
                    <input type="text" class="form-control" id="ville" name="ville" value="<?php echo $res["ville"] ?>"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label required-field">Description</label>
                <input type="tel" class="form-control" id="description" name="description"
                    value="<?php echo $res["description"] ?>" required>
            </div>


            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="age" class="form-label required-field">Age</label>
                    <input type="number" class="form-control" id="age" name="age" value="<?php echo $res["age"] ?>">
                </div>
                <div class="col-md-8 mb-3">
                    <label for="image_url" class="form-label required-field">image</label>
                    <input type="text" class="form-control" id="image_url" name="image_url">
                </div>
            </div>


            <p class="legal-text">* Champs obligatoires</p>
            <p class="legal-text">Je comprends et j'accepte que les données personnelles indiquées dans ce formulaire
                soient transmises à la SPA dans le cadre du traitement de ma démarche d'adoption.</p>

            <div class="btn-group">
                <button type="reset" class="btn btn-outline flex-grow-1"><i class="bi bi-arrow-counterclockwise"></i>
                    Recommencer</button>
                <button type="submit" name="update-animal" class="btn btn-primary flex-grow-1"><i class="bi bi-arrow-right"></i>
                    Suivant</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>