<?php
include('../config/connexion.php');
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Récupérer les fichiers pour supprimer du dossier uploads
    $candidat = $conn->query("SELECT cv, lettre FROM candidats WHERE id=$id")->fetch_assoc();

    if($candidat['cv'] && file_exists("../".$candidat['cv'])){
        unlink("../".$candidat['cv']); // supprimer CV
    }

    if($candidat['lettre'] && file_exists("../".$candidat['lettre'])){
        unlink("../".$candidat['lettre']); // supprimer lettre si existante
    }

    // Supprimer de la base
    $conn->query("DELETE FROM candidats WHERE id=$id");

    echo "<script>alert('Candidat supprimé avec succès!');window.location='candidats.php';</script>";
}else{
    header("Location: candidats.php");
}
?>