<!DOCTYPE html>
<html lang="fr">
<?php
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Profil Adoptant</title>
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
        
        .form-control, .form-select {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 140, 66, 0.25);
        }
        
        .form-check {
            margin-top: 8px;
        }
        
        .form-check-label {
            font-weight: 400;
        }
        
        .checkbox-group, .radio-group {
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
                <li class="breadcrumb-item"><a href="file:///C:/xampp/htdocs/projet_animeau/view/home_page.html"><i class="bi bi-house-door"></i> Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil Adoptant</li>
            </ol>
        </nav>

        <div class="header">
            <h1>VOTRE PROFIL <span class="highlight">ADOPTANT</span></h1>
            <p class="intro-text">Merci pour votre volonté d'adopter un de nos pensionnaires !<br>Veuillez remplir le formulaire ci-dessous.</p>
        </div>

        <form>
            <div class="mb-3">
                <label for="civilite" class="form-label required-field">Civilité</label>
                <select class="form-select" id="civilite">
                    <option>M</option>
                    <option>Mme</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="prenom" class="form-label required-field">Prénom</label>
                    <input type="text" class="form-control" id="prenom" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label required-field">Nom</label>
                    <input type="text" class="form-control" id="nom" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label required-field">Email</label>
                <input type="email" class="form-control" id="email" placeholder="monadresse@email.com" required>
            </div>

            <div class="mb-3">
                <label for="adresse" class="form-label required-field">Numéro et nom de voie</label>
                <input type="text" class="form-control" id="adresse" required>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="codepostal" class="form-label required-field">Code postal</label>
                    <input type="text" class="form-control" id="codepostal" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="ville" class="form-label required-field">Ville</label>
                    <input type="text" class="form-control" id="ville" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label required-field">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" placeholder="+33" required>
            </div>

            <div class="mb-3 checkbox-group">
                <label class="form-label">Animal déjà possédé</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="aucun-animal" checked>
                    <label class="form-check-label" for="aucun-animal">Aucun animal</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="chien">
                    <label class="form-check-label" for="chien">Un chien (ou +)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="chat">
                    <label class="form-check-label" for="chat">Un chat (ou +)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="equide">
                    <label class="form-check-label" for="equide">Un équidé (ou+)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="nac">
                    <label class="form-check-label" for="nac">Un lapin, hamster ou autre NAC</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="autre-animal">
                    <label class="form-check-label" for="autre-animal">Un autre animal</label>
                </div>
            </div>

            <h2><i class="bi bi-heart-fill"></i> VOTRE EXPÉRIENCE ET VOS MOTIVATIONS</h2>

            <div class="mb-3">
                <label for="motivation" class="form-label required-field">Pourquoi souhaitez-vous adopter un animal ?</label>
                <textarea class="form-control" id="motivation" placeholder="Votre message..."></textarea>
            </div>

            <div class="mb-3 radio-group">
                <label class="form-label required-field">Quel type d'animal souhaitez-vous accueillir ?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="animal-type" id="animal-chien">
                    <label class="form-check-label" for="animal-chien">Chien</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="animal-type" id="animal-chat">
                    <label class="form-check-label" for="animal-chat">Chat</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="animal-type" id="animal-nac">
                    <label class="form-check-label" for="animal-nac">NAC (Rongeur)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="animal-type" id="animal-equide">
                    <label class="form-check-label" for="animal-equide">Équidé</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="animal-type" id="animal-ferme">
                    <label class="form-check-label" for="animal-ferme">Animaux de ferme</label>
                </div>
            </div>

            <h2><i class="bi bi-people-fill"></i> VOTRE FAMILLE</h2>

            <div class="mb-3 checkbox-group">
                <label class="form-label">Décrivez-nous un peu votre caractère et votre mode de vie :</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="calme">
                            <label class="form-check-label" for="calme">Calme</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="casanier">
                            <label class="form-check-label" for="casanier">Casanier</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="dynamique">
                            <label class="form-check-label" for="dynamique">Dynamique</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="aventurier">
                            <label class="form-check-label" for="aventurier">Aventurier</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sportif">
                            <label class="form-check-label" for="sportif">Sportif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="urbain">
                            <label class="form-check-label" for="urbain">Urbain</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="nature">
                            <label class="form-check-label" for="nature">Amoureux de la nature</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 radio-group">
                <label class="form-label required-field">Avez-vous des enfants ?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="enfants" id="enfants-oui">
                    <label class="form-check-label" for="enfants-oui">Oui</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="enfants" id="enfants-non">
                    <label class="form-check-label" for="enfants-non">Non</label>
                </div>
            </div>

            <div class="mb-3 radio-group">
                <label class="form-label required-field">Souhaitez-vous recevoir nos communications ?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="communications" id="com-oui">
                    <label class="form-check-label" for="com-oui">Oui</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="communications" id="com-non">
                    <label class="form-check-label" for="com-non">Non</label>
                </div>
            </div>

            <p class="legal-text">* Champs obligatoires</p>
            <p class="legal-text">Je comprends et j'accepte que les données personnelles indiquées dans ce formulaire soient transmises à la SPA dans le cadre du traitement de ma démarche d'adoption.</p>

            <div class="btn-group">
                <button type="button" class="btn btn-outline flex-grow-1"><i class="bi bi-arrow-counterclockwise"></i><a href="adaptationInfo.php">Recommencer</a></button>
                <button type="submit" class="btn btn-primary flex-grow-1"><i class="bi bi-arrow-right"></i><a href="demandeEnvoyer.html">Suivant</a></button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>