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
    $req = "INSERT INTO utilisateur(nom, prenom, email, password) VALUES ('".$data['nom']."', '".$data['prenom']."', '".$data['email']."', '".$mdpHash."')";
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
    $req = "SELECT email, password FROM utilisateur WHERE email = ?";
    $stm = $cnx->prepare($req);
    
    // Exécution avec le paramètre de l'email
    $stm->execute([$email]);
    $user = $stm->fetch();

    // Vérification si l'utilisateur existe et si le mot de passe correspond
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
?>
