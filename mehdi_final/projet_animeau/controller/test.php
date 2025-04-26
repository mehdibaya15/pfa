<?php
include("../config/database.php");
/*
//test recherche
$chien = [];
$req = "SELECT * FROM animaux WHERE categorie = 'chien'";
$res = $cnx->query($req);
$chien = $res->fetchAll(PDO::FETCH_ASSOC); // pour avoir un tableau associatif
if (!$chien) {
    echo "Aucun chien n'est trouvé pour le moment";
} else {
    $nbr_chien=count($chien);
    echo "nombre de chien : " .$nbr_chien ."\n";
    for ($i = 0; $i < $nbr_chien; $i++) {
        echo "ID : " . $chien[$i]['id_animal'] ."\t";
        echo "Nom : " . $chien[$i]['nom'] ."\t";
        echo "Âge : " . $chien[$i]['age'] ."\t";
        echo "Race : " . $chien[$i]['race'] ."\t";
        echo "ville : " . $chien[$i]['ville'] ."\t";
        echo "sexe : " . $chien[$i]['sexe'] ."\t";
        echo "description : " . $chien[$i]['description']."\n";
    }
}*/

// test êrformance

/*
$start = microtime(true);
$animaux = $cnx->query("
    SELECT id_animal, nom, race, image_url 
    FROM animaux 
")->fetchAll();
$end = microtime(true);
$temps = round(($end - $start)*1000, 2);
echo "Test Performance Liste Animaux";
echo "Temps d'exécution :{$temps} ms";*/

// test 2 performance
/*$start = microtime(true);
$ville = 'sousse';

    $sql = "SELECT id_animal, nom, ville FROM animaux WHERE 1=1";
    $params = [];
    
    if ($ville) {
        $sql .= " AND ville LIKE ?";
        $params[] = "%$ville%";
    }  
    
    $stmt = $cnx->prepare($sql);
    $stmt->execute($params);
    $resultats = $stmt->fetchAll();
$end = microtime(true);
$temps = round(($end - $start)*1000, 2);
echo "Temps de reponse :{$temps} ms";*/


?>

