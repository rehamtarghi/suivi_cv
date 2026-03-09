<?php
include('../config/connexion.php');
if(!isset($_SESSION['admin'])){ header("Location: ../login.php"); exit; }
$id=$_GET['id'];
$c=$conn->query("SELECT * FROM candidats WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Voir Candidat</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
html, body {
    height: 100%;
    margin:0;
}
body{
    display:flex;
    flex-direction:column;
    min-height:100vh;
    background-color:#f2f4f7;
    font-family: 'Segoe UI', sans-serif;
}

/* HEADER */
.navbar{
    background: linear-gradient(90deg,#e2e2f1,#3b8bfd) !important;
    padding:15px 0;
}
.navbar-brand{
    display:flex;
    align-items:center;
    font-size:1.3rem;
    font-weight:600;
}
.navbar-brand img{
    height:60px; /* مطابق لباقي الصفحات */
    margin-right:20px;
}
.navbar-nav .nav-link{
    margin-left:20px;
    font-size:1rem;
    font-weight:500;
    color:#000 !important;
}
.navbar-nav .nav-link:hover{
    color:#0d6efd !important;
}

/* CARD CANDIDAT */
.card-candidat {
    max-width: 600px; /* نفس العرض الأصلي */
    margin: 5px auto;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    background-color: #fff;
}

.card-candidat h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #0d6efd;
}

.list-group-item strong {
    width: 120px;
    display: inline-block;
}

/* BUTTON BACK */
.btn-back {
    display: block;
    width: 100%;
    margin-top: 20px;
    border-radius: 50px;
}

/* FOOTER */
footer{
    background-color:#8f9196;
    color:#fff;
    padding:10px 0;
    text-align:center;
    margin-top:1px; /* يبقى Footer ديما لتحت */
}
.card-candidat {
    max-width: 650px;        /* عرض متوسط، لا صغير لا كبير بزاف */
    width: 90%;              /* responsive على شاشات صغيرة */
    margin: 50px auto;       /* يبقى في الوسط */
    padding: 30px;           /* مساحة داخلية مريحة */
    border-radius: 15px;     /* حواف مستديرة لطيفة */
    box-shadow: 0 12px 30px rgba(0,0,0,0.18); /* ظل يعطي depth */
    background-color: #fff;  /* خلفية بيضاء */
    transition: transform 0.3s, box-shadow 0.3s; /* effect عند hover */
}

.card-candidat:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 35px rgba(0,0,0,0.22);
}

.card-candidat h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #0d6efd;
    font-weight: 600;
    font-size: 1.8rem;
}

.list-group-item {
    padding: 14px 20px;
    font-size: 1rem;
}

.list-group-item strong {
    width: 130px; /* يسهّل القراءة */
    display: inline-block;
}

.btn-back {
    display: block;
    width: 100%;
    margin-top: 25px;
    border-radius: 50px;
    padding: 10px;
    font-weight: 500;
    transition: background 0.3s;
}

.btn-back:hover {
    background-color: #0b5ed7;
    color: #fff;
}
</style>
</head>
<body>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg mb-4">
<div class="container">
<a class="navbar-brand" href="#">
<img src="../admin/image/logo.png" alt="Logo">
CV_Tracking Systéme
</a>
<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
<li class="nav-item"><a class="nav-link" href="candidats.php">Candidats</a></li>
<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
</ul>
</div>
</nav>

<!-- Card Candidat -->
<div class="card-candidat">
<h2>Détails du Candidat</h2>
<ul class="list-group list-group-flush">
<li class="list-group-item"><strong>Nom:</strong> <?php echo $c['nom']; ?></li>
<li class="list-group-item"><strong>Prénom:</strong> <?php echo $c['prenom']; ?></li>
<li class="list-group-item"><strong>Email:</strong> <?php echo $c['email']; ?></li>
<li class="list-group-item"><strong>Téléphone:</strong> <?php echo $c['telephone']; ?></li>
<li class="list-group-item"><strong>Poste:</strong> <?php echo $c['poste']; ?></li>
<li class="list-group-item"><strong>Statut:</strong> <?php echo $c['statut']; ?></li>
<li class="list-group-item"><strong>CV:</strong> <a href="../<?php echo $c['cv']; ?>" target="_blank" class="btn btn-sm btn-primary">Télécharger</a></li>
<li class="list-group-item"><strong>Lettre:</strong> 
<?php if($c['lettre']){ ?>
<a href="../<?php echo $c['lettre']; ?>" target="_blank" class="btn btn-sm btn-success">Télécharger</a>
<?php }else{ echo '<span class="text-muted">Non fournie</span>'; } ?>
</li>
</ul>

<a href="candidats.php" class="btn btn-secondary btn-back">← Retour à la liste</a>
</div>

<!-- FOOTER -->
<footer>
© <?php echo date("Y"); ?> CV Tracking System — Tous droits réservés
</footer>

</body>
</html>