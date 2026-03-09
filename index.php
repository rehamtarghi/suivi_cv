<?php include('config/connexion.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Déposer CV - Multiceram</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>

html,body{
height:100%;
margin:0;
}

body {
    background-color: #f2f4f7;
    font-family: 'Segoe UI', sans-serif;
    display:flex;
    flex-direction:column;
}

.header-top {
    background: linear-gradient(90deg, #e2e2f1, #3b8bfd);
    color: #fff;
    padding: 30px 0;
    text-align: center;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
    margin-bottom: 30px;
}

.header-top img {
    height: 150px;
    width: 190px; /* كبرنا اللوغو */
    margin-bottom: 15px;
}

.header-top h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 600;
}

.header-top p {
    margin: 5px 0 0;
    font-size: 1rem;
    color: #e0eaff;
}

.card {
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    max-width: 600px;
    margin: -50px auto 50px;
    position: relative;
    z-index: 2;
}

.card-header {
    background-color: #fff;
    color: #0d6efd;
    font-weight: 600;
    font-size: 1.3rem;
    text-align: center;
    border-radius: 15px 15px 0 0;
    padding: 1rem;
}

form .input-group-text {
    background-color: #e9ecef;
    border-right: 0;
    font-size: 1.1rem;
}

form .form-control {
    border-left: 0;
}

.btn-success {
    background-color: #198754;
    border: none;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-success:hover {
    background-color: #157347;
}

footer {
    background-color: #343a40;
    color: #fff;
    font-size: 0.9rem;
    padding: 15px 0;
    margin-top:auto; /* كيخلي الفوتر يبقى لتحت */
}

</style>
</head>
<body>

<!-- HEADER STYLE -->
<div class="header-top">
    <img src="admin/image/logo.png" alt="Logo Multiceram">
    <h1>Déposer votre candidature</h1>
    <p>Remplissez ce formulaire pour soumettre votre CV à Multiceram.</p>
</div>

<!-- FORMULAIRE CARD -->
<div class="card">
    <div class="card-header">Informations personnelles et professionnelles</div>
    <div class="card-body">
        <form action="traitement_candidature.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input type="text" name="nom" class="form-control" placeholder="Nom" required>
            </div>
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
            </div>
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                <input type="text" name="telephone" class="form-control" placeholder="Téléphone" required>
            </div>
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-briefcase-fill"></i></span>
                <input type="text" name="poste" class="form-control" placeholder="Poste souhaité" required>
            </div>
            <div class="mb-3">
                <label>CV (PDF)</label>
                <input type="file" name="cv" class="form-control" accept=".pdf" required>
            </div>
            <div class="mb-3">
                <label>Lettre de motivation (PDF) - optionnel</label>
                <input type="file" name="lettre" class="form-control" accept=".pdf">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success px-5 py-2">Envoyer</button>
            </div>
        </form>
    </div>
</div>

<footer class="text-center text-lg-start mt-5">
    <div class="container">© 2026 Multiceram. Tous droits réservés.</div>
</footer>

</body>
</html>