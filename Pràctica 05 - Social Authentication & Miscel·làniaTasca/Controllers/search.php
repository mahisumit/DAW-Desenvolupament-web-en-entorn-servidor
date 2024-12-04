<?php
//Sumit Mahi
session_start();
require_once '../config.php'; 

// Get consulta de cerca
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Cerca rellotges coincidents
$stmt = $pdo->prepare("
    SELECT watches.*, users.username 
    FROM watches 
    JOIN users ON watches.created_by = users.id 
    WHERE watches.name LIKE ? OR watches.information LIKE ? OR users.username LIKE ?
");
$searchTerm = '%' . $query . '%';
$stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
$matchingWatches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch els rellotges restants
$stmt = $pdo->prepare("
    SELECT watches.*, users.username 
    FROM watches 
    JOIN users ON watches.created_by = users.id 
    WHERE watches.name NOT LIKE ? AND watches.information NOT LIKE ? AND users.username NOT LIKE ?
");
$stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
$remainingWatches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Combina (Merge) els resultats
$watches = array_merge($matchingWatches, $remainingWatches);

// Truncate text to a specified number of lines
function truncateText($text, $lines = 2) {
    $linesArray = explode("\n", wordwrap($text, 100));
    return implode("\n", array_slice($linesArray, 0, $lines));
}

// Genereu l'HTML per als resultats de la cerca
foreach ($watches as $watch) {
    echo '<div class="watch">';
    echo '<a href="' . htmlspecialchars($watch['official_url']) . '" target="_blank">';
    echo '<img src="data:image/jpeg;base64,' . base64_encode($watch['image_upload']) . '" alt="' . htmlspecialchars($watch['name']) . '">';
    echo '</a>';
    echo '<h2>' . htmlspecialchars($watch['name']) . '</h2>';
    echo '<p>Price: ' . str_replace(',', ' ', number_format($watch['price'], 0, ',', ' ')) . '€</p>';
    echo '<p>' . nl2br(htmlspecialchars(truncateText($watch['information']))) . '</p>';
    echo '<a href="?watch_id=' . htmlspecialchars($watch['id']) . '">Continue Reading</a>';
    echo '<p>Published on: ' . htmlspecialchars(date('F j, Y', strtotime($watch['created_at']))) . '</p>';
    echo '<p>Published by: ' . htmlspecialchars($watch['username']) . '</p>';
    if (isset($_SESSION['user_id']) && ($_SESSION['is_admin'] || $watch['created_by'] == $_SESSION['user_id'])) {
        echo '<div class="watch-actions">';
        echo '<a href="edit.php?id=' . htmlspecialchars($watch['id']) . '" class="icon-button"><i class="fas fa-edit"></i></a>';
        echo '<a href="delete.php?id=' . htmlspecialchars($watch['id']) . '" class="icon-button"><i class="fas fa-trash"></i></a>';
        echo '</div>';
    }
    echo '</div>';
}
?>