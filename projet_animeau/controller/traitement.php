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
function AjouterUtilisateur($cnx,$data){
    $mdpHash = md5($data['password']);
    $req="INSERT INTO utilisateur(nom,prenom,email,password) VALUES ('".$data['nom']."','".$data['prenom']."','".$data['email']."','".$mdpHash."')";  
    $res = $cnx->query($req);
    if($res){
        echo "<script>console.log('question ajouté avec succès: " . json_encode($data) . "');</script>";
        return true;

    }else {
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
function rechercheAnimalCat($cnx,$data,$categorie){
    $req="SELECT * FROM animaux where  categorie = $categorie and (nom LIKE '%$data%' or sexe LIKE '%$data%' or age LIKE '%$data%' or ville LIKE '%$data%'  or race LIKE '%$data%' or description LIKE '%$data%')";
    $res = $cnx->query($req);
    $animaux = $res->fetchAll();
    return $animaux;

}
function validLogIn($cnx, $email, $password) {
    $req = "SELECT email, password_hash FROM utilisateur WHERE email = ?";
    $stm = $cnx->prepare($req);
    $stm->execute([$email]);
    $user = $stm->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        return $user;
    }
    return false;
}
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

?>
