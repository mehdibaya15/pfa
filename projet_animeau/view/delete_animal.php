<?php
include("../config/database.php");
session_start();

// Vérification admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    try {
        // Vérification que l'animal existe
        $check = $cnx->prepare("SELECT id_animal FROM animaux WHERE id_animal = :id");
        $check->execute([':id' => $id]);
        
        if ($check->rowCount() === 0) {
            $_SESSION['error_message'] = "Animal non trouvé";
            header("Location: admin.php");
            exit;
        }

        // Suppression
        $stmt = $cnx->prepare("DELETE FROM animaux WHERE id_animal = :id");
        $stmt->execute([':id' => $id]);
        
        $_SESSION['success_message'] = "Animal supprimé avec succès";
        header("Location: admin.php");
        exit;
        
    } catch (PDOException $e) {
        error_log("Delete animal error: " . $e->getMessage());
        $_SESSION['error_message'] = "Erreur lors de la suppression: " . $e->getMessage();
        header("Location: admin.php");
        exit;
    }
} else {
    $_SESSION['error_message'] = "ID invalide";
    header("Location: admin.php");
    exit;
}
?>