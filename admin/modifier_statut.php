<?php
include('../config/connexion.php');

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD']=='POST'){
    $statut = $_POST['statut'];
    $date_entretien = $_POST['date_entretien'];

    $conn->query("UPDATE candidats 
        SET statut='$statut', 
            date_entretien='$date_entretien' 
        WHERE id=$id");

    header("Location: candidats.php");
    exit;
}

$c = $conn->query("SELECT * FROM candidats WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modifier Statut</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f2f4f7;
    font-family: 'Segoe UI', sans-serif;
}
.navbar {
    background: linear-gradient(90deg,#e2e2f1,#3b8bfd) !important;
    padding: 15px 0;
}
.navbar-brand {
    display: flex;
    align-items: center;
    font-size: 1.3rem;
    font-weight: 600;
}
.navbar-brand img {
    height: 60px;
    margin-right: 10px;
}
.navbar-nav .nav-link {
    margin-left: 15px;
    font-size: 1rem;
    font-weight: 500;
    color: #000 !important;
}
.navbar-nav .nav-link:hover {
    color: #0d6efd !important;
}
.card-modifier {
    max-width: 500px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    background: #fff;
}
.card-modifier h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #4d6180;
}
footer {
    padding: 15px;
    background: #8f9196;
    text-align: center;
    font-size: 14px;
    color: #fff;
    margin-top: auto;
}
</style>
</head>

<body>
<nav class="navbar navbar-expand-lg mb-4">
<div class="container">
    <a class="navbar-brand">
        <img src="../admin/image/logo.png">
        CV_Tracking Systéme
    </a>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="candidats.php">Candidats</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>
</div>
</nav>

<div class="card-modifier">
<h2>Modifier statut de <?php echo $c['nom'].' '.$c['prenom']; ?></h2>

<form method="POST">
    <label>Statut</label>
    <select name="statut" class="form-select mb-3" required>
        <option value="Reçu" <?php if($c['statut']=="Reçu") echo "selected"; ?>>Reçu</option>
        <option value="Accepté" <?php if($c['statut']=="Accepté") echo "selected"; ?>>Accepté</option>
        <option value="Refusé" <?php if($c['statut']=="Refusé") echo "selected"; ?>>Refusé</option>
    </select>

    <label>Date entretien</label>
    <input type="date" name="date_entretien" class="form-control mb-3" 
           value="<?php echo isset($c['date_entretien']) ? $c['date_entretien'] : ''; ?>">

    <button class="btn btn-success w-100 mb-2">Modifier</button>
    <a href="candidats.php" class="btn btn-secondary w-100">← Retour à la liste</a>
</form>
</div>

<footer>
© <?php echo date("Y"); ?> CV Tracking System — Tous droits réservés
</footer>
</body>
</html>