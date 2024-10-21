<?php
// @autor Sumit Mahi
session_start(); // Inicia o reprèn la sessió
session_destroy(); // Destrueix totes les dades de la sessió
header("Location: index.php"); 
exit; 
?>