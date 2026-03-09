<?php
include('../config/connexion.php');
if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

$where = "1";

// Filtre recherche nom/prenom
if(isset($_GET['search']) && $_GET['search']!=''){
    $search = $conn->real_escape_string($_GET['search']);
    $where .= " AND (nom LIKE '%$search%' OR prenom LIKE '%$search%')";
}

// Filtre statut
if(isset($_GET['statut']) && $_GET['statut']!=''){
    $statut = $conn->real_escape_string($_GET['statut']);
    $where .= " AND statut='$statut'";
}

// Filtre poste
if(isset($_GET['poste']) && $_GET['poste']!=''){
    $poste = $conn->real_escape_string($_GET['poste']);
    $where .= " AND poste='$poste'";
}

// Entretien filter 

$res = $conn->query("SELECT * FROM candidats WHERE $where");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste Candidats</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
html,body{height:100%;margin:0;}
body{display:flex;flex-direction:column;min-height:100vh;background:#f2f4f7;font-family:'Segoe UI',sans-serif;}
.navbar{background: linear-gradient(90deg,#e2e2f1,#3b8bfd) !important;padding:15px 0;}
.navbar-brand{display:flex;align-items:center;font-size:1.3rem;font-weight:600;}
.navbar-brand img{height:60px;margin-right:15px;}
.navbar-nav .nav-link{margin-left:20px;font-size:1rem;font-weight:500;color:#000 !important;}
.navbar-nav .nav-link:hover{color:#0d6efd !important;}
.container{flex:1;max-width:1000px;margin-bottom:20px;}
table th,table td{vertical-align:middle;}
footer{flex-shrink:0;padding:15px;background:#8f9196;text-align:center;font-size:14px;color:#fff;}
</style>
</head>

<body>
<nav class="navbar navbar-expand-lg mb-4">
<div class="container">
    <a class="navbar-brand" href="#">
        <img src="../admin/image/logo.png">
        CV_Tracking Systéme
    </a>
    <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Candidats</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>
</div>
</nav>

<div class="container">
<a href="dashboard.php" class="btn btn-primary mb-3">← Retour Dashboard</a>
<h2 class="mb-4">Liste des Candidats</h2>

<!-- FILTRE -->
<form class="row g-3 mb-3" method="GET">
<div class="col-md-3">
<input type="text" name="search" class="form-control" placeholder="Recherche nom/prenom"
value="<?php echo isset($_GET['search'])?htmlspecialchars($_GET['search']):''; ?>">
</div>
<div class="col-md-2">
<select name="statut" class="form-select">
<option value="">Statut</option>
<option value="Reçu" <?php if(isset($_GET['statut']) && $_GET['statut']=='Reçu') echo 'selected'; ?>>Reçu</option>
<option value="Accepté" <?php if(isset($_GET['statut']) && $_GET['statut']=='Accepté') echo 'selected'; ?>>Accepté</option>
<option value="Refusé" <?php if(isset($_GET['statut']) && $_GET['statut']=='Refusé') echo 'selected'; ?>>Refusé</option>
</select>
</div>
<div class="col-md-2">
<input type="text" name="poste" class="form-control" placeholder="Poste"
value="<?php echo isset($_GET['poste'])?htmlspecialchars($_GET['poste']):''; ?>">
</div>
<div class="col-md-2">
<button class="btn btn-success w-100" type="submit">Filtrer</button>
</div>
<!-- زر لإعادة عرض كل المترشحين -->
<div class="col-md-2">
<a href="candidats.php" class="btn btn-secondary w-100">Tout afficher</a>
</div>
</form>

<!-- TABLE -->
<table class="table table-bordered table-striped shadow-sm bg-white">
<thead class="table-primary">
<tr>
<th>Nom</th>
<th>Prénom</th>
<th>Poste</th>
<th>Date Envoi</th>
<th>Statut</th>
<th>Date Entretien</th>
<th>Actions</th>
</tr>
</thead>
<tbody>

<?php while($row=$res->fetch_assoc()){ ?>
<tr>
<td><?php echo $row['nom']; ?></td>
<td><?php echo $row['prenom']; ?></td>
<td><?php echo $row['poste']; ?></td>
<td><?php echo $row['date_envoi']; ?></td>
<td>
<?php
if($row['statut']=="Accepté"){ echo "<span class='badge bg-success'>Accepté</span>"; }
elseif($row['statut']=="Refusé"){ echo "<span class='badge bg-danger'>Refusé</span>"; }
else{ echo "<span class='badge bg-primary'>Reçu</span>"; }
?>
</td>
<td>
<?php
// نعرض تاريخ entretien مباشرة بلا Oui/Non
echo isset($row['date_entretien']) && $row['date_entretien'] != NULL 
    ? "🗓️ ".$row['date_entretien'] 
    : "—";
?>
</td>
<td>
<a href="voir.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Voir</a>
<a href="modifier_statut.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
<a href="supprimer.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Êtes-vous sûr ?');">Supprimer</a>
</td>
</tr>
<?php } ?>

</tbody>
</table>
</div>

<footer>
© <?php echo date("Y"); ?> CV Tracking System — Tous droits réservés
</footer>
</body>
</html>