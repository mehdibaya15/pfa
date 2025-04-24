<?php
include("../config/database.php");

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // Type-cast for security

    // Prepare the DELETE statement
    $stmt = $cnx->prepare("DELETE FROM `animaux` WHERE `id_animal` = :id");
    $stmt->execute([':id' => $id]);

    // Optional: redirect to home or list page after deletion
    header("Location: admin.php?deleted=true");
    exit;
} else {
    echo "ID invalide.";
}
?>
