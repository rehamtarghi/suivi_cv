<?php include('config/connexion.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Multiceram</title>

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

/* HEADER */

.header-top {
background: linear-gradient(90deg,#e2e2f1,#3b8bfd);
color:#fff;
padding:15px 0; /* نقصنا الارتفاع */
text-align:center;
border-bottom-left-radius:20px;
border-bottom-right-radius:20px;
margin-bottom:30px;
}

.header-top img{
height:90px;
width:130px;
margin-bottom:5px;
}

.header-top h1{
margin:0;
font-size:1.6rem;
font-weight:600;
}

.header-top p{
margin:2px 0 0;
font-size:0.9rem;
color:#e0eaff;
}

/* CARD LOGIN */

.card{
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,0.15);
max-width:520px; /* كبرنا الفورم */
margin:auto;
}

.card-header{
background:#fff;
color:#0d6efd;
font-weight:600;
font-size:1.6rem;
text-align:center;
border-radius:15px 15px 0 0;
padding:1.3rem;
}

/* INPUT */

form .input-group-text{
background-color:#e9ecef;
border-right:0;
font-size:1.2rem;
}

form .form-control{
border-left:0;
height:45px;
}

/* BUTTON */

.btn-success{
background-color:#198754;
border:none;
font-weight:500;
padding:10px 40px;
font-size:1.1rem;
transition:0.3s;
}

.btn-success:hover{
background-color:#157347;
}

/* FOOTER */

footer{
background-color:#343a40;
color:#fff;
font-size:0.9rem;
padding:15px 0;
margin-top:auto;
text-align:center;
}

</style>
</head>

<body>

<!-- HEADER -->

<div class="header-top">

<img src="admin/image/logo.png">

<h1>Espace Administrateur</h1>

<p>Connectez-vous pour gérer les candidatures</p>

</div>


<!-- LOGIN CARD -->

<div class="card">

<div class="card-header">

Connexion

</div>

<div class="card-body">

<form action="traitement_login.php" method="POST">

<div class="mb-3 input-group">

<span class="input-group-text">

<i class="bi bi-person-fill"></i>

</span>

<input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required>

</div>


<div class="mb-3 input-group">

<span class="input-group-text">

<i class="bi bi-lock-fill"></i>

</span>

<input type="password" name="password" class="form-control" placeholder="Mot de passe" required>

</div>


<div class="text-center">

<button type="submit" class="btn btn-success px-4">

Se connecter

</button>

</div>

</form>

</div>

</div>


<footer>

© 2026 Multiceram. Tous droits réservés.

</footer>

</body>
</html>