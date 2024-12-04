<?php
//Sumit Mahi
// Configuració de la connexió a la base de dades
$host = 'localhost';
$db = 'pt05_sumit_mahi';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No s'ha pogut connectar a la base de dades $db :" . $e->getMessage());
}
?>