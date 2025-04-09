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
?>
