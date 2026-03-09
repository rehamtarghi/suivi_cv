<?php
include('../config/connexion.php');
if(!isset($_SESSION['admin'])){ header("Location: ../login.php"); exit; }

// Comptage candidats
$total = $conn->query("SELECT COUNT(*) as t FROM candidats")->fetch_assoc()['t'];
$recu = $conn->query("SELECT COUNT(*) as t FROM candidats WHERE statut='Reçu'")->fetch_assoc()['t'];
$accepte = $conn->query("SELECT COUNT(*) as t FROM candidats WHERE statut='Accepté'")->fetch_assoc()['t'];
$refuse = $conn->query("SELECT COUNT(*) as t FROM candidats WHERE statut='Refusé'")->fetch_assoc()['t'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
html, body { height:100%; margin:0; }
body{ display:flex; flex-direction:column; min-height:100vh; background-color:#f2f4f7; font-family:'Segoe UI', sans-serif; }

/* NAVBAR */
.navbar{ background: linear-gradient(90deg,#e2e2f1,#3b8bfd) !important; padding:20px 0; border-radius:0 0 20px 20px; box-shadow:0 5px 15px rgba(0,0,0,0.1); }
.navbar-brand{ display:flex; align-items:center; font-size:1.4rem; font-weight:600; }
.navbar-brand img{ height:70px; margin-right:20px; }
.navbar-nav .nav-link{ margin-left:25px; font-size:1rem; font-weight:500; color:#000 !important; }
.navbar-nav .nav-link:hover{ color:#0d6efd !important; }

/* BIENVENUE ADMIN */
.welcome-card { text-align:center; margin-bottom:30px; }
.welcome-card h2{ font-size:1.8rem; font-weight:600; }

/* HEADER CARDS STATS */
.dashboard-header { display:flex; justify-content:center; gap:15px; flex-wrap:wrap; margin-bottom:30px; }
.header-card{ border-radius:15px; padding:20px; text-align:center; flex:1; min-width:120px; color:#fff; transition: transform 0.3s, box-shadow 0.3s; cursor:default; }
.header-card:hover{ transform: scale(1.05); box-shadow:0 10px 25px rgba(0,0,0,0.2); }
.header-card h6{ font-size:0.9rem; text-transform:uppercase; margin-bottom:5px; }
.header-card h4{ font-size:1.8rem; font-weight:bold; margin:0; }

/* COLORS HEADER CARDS */
.header-total{ background:#6c757d; }
.header-recu{ background: linear-gradient(135deg, #4dabf7, #0d6efd); }
.header-accepte{ background: linear-gradient(135deg, #57d28d, #198754); }
.header-refuse{ background: linear-gradient(135deg, #f77b7b, #dc3545); }

/* FOOTER */
footer{ padding:15px; background:#8f9196; text-align:center; font-size:14px; color:#fff; margin-top:5px; flex-shrink:0; border-top-left-radius:20px; border-top-right-radius:20px; }
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg mb-4">
<div class="container">
<a class="navbar-brand" href="#">
<img src="../admin/image/logo.png">
CV_Tracking Systéme
</a>
<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link" href="candidats.php">Candidats</a></li>
<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
</ul>
</div>
</nav>

<!-- BIENVENUE ADMIN -->
<div class="container welcome-card">
<h2>Bienvenue Admin</h2>
</div>

<!-- HEADER CARDS STATS -->
<div class="container dashboard-header">
  <div class="header-card header-total"><h6>Total CV</h6><h4 id="totalCount">0</h4></div>
  <div class="header-card header-recu"><h6>Reçu</h6><h4 id="recuCount">0</h4></div>
  <div class="header-card header-accepte"><h6>Accepté</h6><h4 id="accepteCount">0</h4></div>
  <div class="header-card header-refuse"><h6>Refusé</h6><h4 id="refuseCount">0</h4></div>
</div>

<!-- PIE CHART -->
<div class="container mb-4">
<canvas id="pieChart" style="max-width:450px;margin:auto;display:block;" height="220"></canvas>
</div>

<footer>© <?php echo date("Y"); ?> CV Tracking System — Tous droits réservés</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// PIE CHART
const ctx = document.getElementById('pieChart');
new Chart(ctx,{
type:'pie',
data:{
labels:['Reçu','Accepté','Refusé'],
datasets:[{ 
    label:'Statut CV', 
    data:[<?php echo $recu; ?>,<?php echo $accepte; ?>,<?php echo $refuse; ?>], 
    backgroundColor:['#0d6efd','#198754','#dc3545'] 
}]
},
options:{plugins:{legend:{position:'bottom'}}}
});

// ANIMATION COUNTERS
function animateValue(id, start, end, duration) {
    let obj = document.getElementById(id);
    if (start === end) { obj.innerText = end; return; }
    let range = end - start;
    let current = start;
    let increment = end > start ? 1 : -1;
    let stepTime = Math.max(Math.floor(duration / Math.abs(range)), 1);
    let timer = setInterval(function() {
        current += increment;
        obj.innerText = current;
        if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
            obj.innerText = end;
            clearInterval(timer);
        }
    }, stepTime);
}

document.addEventListener("DOMContentLoaded", function(){
    animateValue("totalCount",0,<?php echo $total; ?>,1500);
    animateValue("recuCount",0,<?php echo $recu; ?>,1500);
    animateValue("accepteCount",0,<?php echo $accepte; ?>,1500);
    animateValue("refuseCount",0,<?php echo $refuse; ?>,1500);
});
</script>

</body>
</html>