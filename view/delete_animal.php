<?php
include "../config/database.php";
session_start();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $cnx->prepare("DELETE FROM animaux WHERE id_animal = ?");
    $stmt->execute([$id]);

    $_SESSION['message'] = "Animal supprimé avec succès.";
} else {
    $_SESSION['message'] = "ID non valide.";
}

header("Location: admin.php");
exit();
?>
