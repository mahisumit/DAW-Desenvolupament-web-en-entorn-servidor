 <?php
 // @author Sumit Mahi
$host = 'localhost';
$db = 'pt04_sumit_mahi';   // conexió a la base de dades
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No s'ha pogut connectar a la base de dades $db :" . $e->getMessage());
}
?>