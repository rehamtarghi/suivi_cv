<?php
include('config/connexion.php');
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    $res = $conn->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if($res->num_rows==1){
        $_SESSION['admin']=$username;
        header("Location: admin/dashboard.php");
    }else{
        echo "<script>alert('Login incorrect');window.location='login.php';</script>";
    }
}
?>