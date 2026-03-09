<?php
include('config/connexion.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $telephone=$_POST['telephone'];
    $poste=$_POST['poste'];

    // Upload CV obligatoire
    $cv_path = "uploads/".uniqid()."_".$_FILES['cv']['name'];
    move_uploaded_file($_FILES['cv']['tmp_name'],$cv_path);

    // Upload lettre optionnelle
    $lettre_path = NULL;
    if(!empty($_FILES['lettre']['name'])){
        $lettre_path = "uploads/".uniqid()."_".$_FILES['lettre']['name'];
        move_uploaded_file($_FILES['lettre']['tmp_name'],$lettre_path);
    }

    $stmt = $conn->prepare("INSERT INTO candidats (nom,prenom,email,telephone,poste,cv,lettre) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss",$nom,$prenom,$email,$telephone,$poste,$cv_path,$lettre_path);

    if($stmt->execute()){
        echo "<script>alert('Candidature envoyée avec succès');window.location='index.php';</script>";
    }else{
        echo "Erreur: ".$conn->error;
    }
}
?>