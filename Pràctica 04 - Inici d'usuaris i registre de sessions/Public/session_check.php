<?php
// @autor Sumit Mahi
session_start(); 

//Per comprovar si l'usuari està autenticat
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit();
}
?>
