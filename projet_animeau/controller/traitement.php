<?php
include("../config/database.php");
function AddQuestion($cnx,$data){
    $req= "INSERT INTO contact(name,email,message) VALUES ('".$data['name']."','".$data['email']."','".$data['message']."')";  
    $res = $cnx->query($req);
    if($res){
        
        echo "<script>console.log('question ajouté avec succès: " . json_encode($data) . "');</script>";
        return true;

    }else {
        return false;
    }
}
function AjouterAvis($cnx,$data){
    $req="INSERT INTO avis(name,review,rating) VALUES ('".$data['name']."','".$data['review']."','".$data['rating']."')";  
    $res = $cnx->query($req);
    if($res){
        echo "<script>console.log('question ajouté avec succès: " . json_encode($data) . "');</script>";
        return true;

    }else {
        return false;
    }
}
function AjouterUtilisateur($cnx, $data) {
    $mdpHash = md5($data['password']);
    $req = "INSERT INTO utilisateur(nom, prenom, email, telephone,adresse,password) VALUES ('".$data['nom']."', '".$data['prenom']."', '".$data['email']."','".$data['telephone']."','".$data['adresse']."', '".$mdpHash."')";
    $res = $cnx->query($req);
    if ($res) {
        $reqUser = "SELECT * FROM utilisateur WHERE email = '".$data['email']."'";
        $user = $cnx->query($reqUser)->fetch();
        return $user; 
    } else {
        return false;
    }
}
function insertAnimals($cnx){
    $req="SELECT * from animaux";
    $res=$cnx->query($req);
    $animaux=$res->fetchAll();
    return $animaux;

}
function insertAnimalByCategorie($cnx, $categorie) {
    $req = "SELECT * FROM animaux WHERE categorie = :categorie";
    $stmt = $cnx->prepare($req);
    $stmt->bindParam(':categorie', $categorie);
    $stmt->execute();
    
    return $stmt->fetchAll();
}
function rechercheAnimal($cnx,$data){
    $req="SELECT * FROM animaux where nom LIKE '%$data%' or sexe LIKE '%$data%' or age LIKE '%$data%' or ville LIKE '%$data%' or categorie LIKE '%$data%' or race LIKE '%$data%' or description LIKE '%$data%'";
    $res = $cnx->query($req);
    $animaux = $res->fetchAll();
    return $animaux;

}

    function rechercheAnimalCat(PDO $cnx, string $searchTerm, string $category): array
    {
        // Validation des entrées
        $searchTerm = trim($searchTerm);
        $category = trim($category);
        
        // Requête sécurisée avec préparation
        $query = "SELECT * FROM animaux 
                  WHERE categorie = :category 
                  AND (nom LIKE :search 
                       OR sexe LIKE :search 
                       OR age LIKE :search 
                       OR ville LIKE :search
                       OR race LIKE :search 
                       OR description LIKE :search)";
        
        $stmt = $cnx->prepare($query);
        
        // Bind des paramètres avec le bon typage
        $searchParam = "%$searchTerm%";
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
/**
 * Vérifie les identifiants de l'utilisateur.
 *
 * @param PDO    $cnx      Instance PDO pour la connexion
 * @param string $email    L'email de l'utilisateur
 * @param string $password Le mot de passe en clair
 *
 * @return mixed L'utilisateur si authentification réussie, false sinon.
 */
function validLogIn($cnx, $email, $password) {
    if ($email === ADMIN_EMAIL && md5($password) === md5(ADMIN_PASS)) {
        return [
            'email' => ADMIN_EMAIL, 
            'prenom' => 'Admin', 
            'role' => 'admin',
            'nom' => 'Administrateur'
        ];
    }
    $req = "SELECT *  FROM utilisateur WHERE email = ?";
    $stm = $cnx->prepare($req);
    $stm->execute([$email]);
    $user = $stm->fetch();
    if ($user && md5($password) === $user['password']) {
        return $user;
    }
    
    return false;
}

/**
 * Redirige l'utilisateur vers une URL donnée.
 *
 * @param string $url L'URL de destination.
 */
function modifierMotdePass($cnx, $email,$nouveauPassword) {
    $req = "SELECT password FROM utilisateur WHERE email = ?";
    $stm = $cnx->prepare($req);
    $stm->execute([$email]);
    $user = $stm->fetch();
    if ($user) {
        $nouveauHashedPassword = password_hash($nouveauPassword, PASSWORD_DEFAULT);
        $updateReq = "UPDATE utilisateur SET password = ? WHERE email = ?";
        $updateStm = $cnx->prepare($updateReq);
        return $updateStm->execute([$nouveauHashedPassword, $email]);
    }

    return false;
}
function is_logged_in() {
    return isset($_SESSION['nom']);
}

function redirect($url) {
    header("Location: $url");
    exit;
}
function rechercheAnimalIndexee($cnx, $searchTerm) {
    require_once __DIR__.'/../vendor/autoload.php';
    $results = [];

    try {
        // Détection spéciale pour la recherche par âge
        if (preg_match('/^(\d+)\s*(ans?)?$/i', trim($searchTerm), $matches)) {
            $ageRecherche = (int)$matches[1];
            
            // Recherche exacte par âge
            $stmt = $cnx->prepare("SELECT *, 1.0 as score FROM animaux WHERE age = ?");
            $stmt->execute([$ageRecherche]);
            return $stmt->fetchAll();
        }

        // Recherche sémantique standard
        $stmt = $cnx->query("SELECT id_animal, nom, race, description, categorie, ville, age FROM animaux");
        $animaux = $stmt->fetchAll();
        
        if (empty($animaux)) {
            return [];
        }
        
        $documents = [];
        foreach ($animaux as $animal) {
            $documents[$animal['id_animal']] = strtolower(implode(' ', [
                $animal['nom'],
                $animal['race'],
                $animal['description'],
                $animal['categorie'],
                $animal['ville'],
                'age_'.$animal['age']  
            ]));
        }

        // Initialisation des composants TF-IDF
        $tfIdf = new \Phpml\FeatureExtraction\TfIdfTransformer();
        $vectorizer = new \Phpml\FeatureExtraction\TokenCountVectorizer(
            new \Phpml\Tokenization\WordTokenizer()
        );
        
        // Vectorisation
        $samples = array_values($documents);
        $vectorizer->fit($samples);
        $vectorizer->transform($samples);
        $tfIdf->fit($samples);
        $tfIdf->transform($samples);
        
        // Traitement de la requête
        $querySample = [strtolower(str_replace([' ans', 'an'], '', $searchTerm))]; // Nettoie et met en minuscules
        $vectorizer->transform($querySample);
        $tfIdf->transform($querySample);
        $queryVector = current($querySample);
        
        // Calcul des similarités
        $similarities = [];
        foreach ($samples as $id => $docVector) {
            $similarities[$id] = cosineSimilarity($queryVector, $docVector);
        }
        
        // Tri des résultats
        arsort($similarities);
        
        // Récupération des animaux pertinents
        $animalIds = array_keys($documents);
        foreach ($similarities as $id => $score) {
            if ($score > 0.1) {
                $stmt = $cnx->prepare("SELECT * FROM animaux WHERE id_animal = ?");
                $stmt->execute([$animalIds[$id]]);
                $animal = $stmt->fetch();
                if ($animal) {
                    $animal['score'] = $score;
                    $results[] = $animal;
                }
            }
        }
    } catch (Exception $e) {
        error_log("Erreur recherche: ".$e->getMessage());
        return [];
    }

    return $results;
}

function cosineSimilarity(array $vecA, array $vecB): float {
    $dotProduct = 0.0;
    $normA = 0.0;
    $normB = 0.0;
    
    foreach ($vecA as $key => $value) {
        $dotProduct += $value * ($vecB[$key] ?? 0);
        $normA += $value ** 2;
    }
    
    foreach ($vecB as $value) {
        $normB += $value ** 2;
    }
    
    return $normA > 0 && $normB > 0 ? $dotProduct / (sqrt($normA) * sqrt($normB)) : 0;
}
?>