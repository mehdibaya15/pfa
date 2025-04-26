<?php  
session_start();
include("../config/database.php");
if (!isset($_SESSION['email'])) {
    header('Location: ../signup.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modif_pass'])) {
    // Récupération des données
    $old_pass = trim($_POST['old_password']);
    $new_pass = trim($_POST['new_password']);
    $confirme_pass = trim($_POST['confirm_password']);
    $id = (int)$_POST['idu'];

    // Vérification des champs vides
    if (empty($old_pass) || empty($new_pass) || empty($confirme_pass)) {
        $_SESSION['error'] = "Tous les champs sont obligatoires";
        header('Location: ../view/user_profile.php');
        exit();
    }

    // Vérification de la correspondance des nouveaux mots de passe
    if ($new_pass !== $confirme_pass) {
        $_SESSION['error'] = "Les nouveaux mots de passe ne correspondent pas";
        header('Location: ../view/user_profile.php');
        exit();
    }

    try {
        // Récupération du mot de passe actuel
        $req = "SELECT password FROM utilisateur WHERE id_utilisateur = ?";
        $stm = $cnx->prepare($req);
        $stm->execute([$id]);
        $user = $stm->fetch();

        if (!$user) {
            $_SESSION['error'] = "Utilisateur non trouvé";
            header('Location: ../view/user_profile.php');
            exit();
        }

        // Vérification de l'ancien mot de passe avec MD5
        if (md5($old_pass) !== $user['password']) {
            $_SESSION['error'] = "Ancien mot de passe incorrect";
            header('Location: ../view/user_profile.php');
            exit();
        }

        // Hachage MD5 du nouveau mot de passe
        $hashed_password = md5($new_pass);

        // Mise à jour du mot de passe
        $requete = "UPDATE utilisateur SET password = ? WHERE id_utilisateur = ?";
        $stm = $cnx->prepare($requete);
        $resultat = $stm->execute([$hashed_password, $id]);

        if ($resultat) {
            $_SESSION['success'] = "Mot de passe mis à jour avec succès";
        } else {
            $_SESSION['error'] = "Erreur lors de la mise à jour du mot de passe";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erreur de base de données";
    }

    header('Location: ../view/user_profile.php');
    exit();
}

header('Location: ../signup.php');
exit();
?>