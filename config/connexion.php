<?php
$conn = new mysqli("localhost","root","","suivi_cv");
if($conn->connect_error){
    die("Erreur connexion: " . $conn->connect_error);
}
session_start();
?>