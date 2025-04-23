<?php
include("../config/database.php");

function AddQuestion($cnx,$data){

    $req =" INSERT INTO contact(name,email,message) VALUES ('".$data['name']."','".$data['email']."','".$data['message']."')";  
    $res = $cnx->query($req);
    if($res){
        echo "<script>console.log('question ajouté avec succès: " . json_encode($data) . "');</script>";
        return true;

    }else {
        return false;
    }
}
?>