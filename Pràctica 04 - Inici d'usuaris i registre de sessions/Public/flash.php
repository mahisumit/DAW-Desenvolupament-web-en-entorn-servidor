<?php
// @author Sumit Mahi
session_start();

function setFlashMessage($type, $message) {
    $_SESSION['flash_messages'][$type][] = $message;
}

function displayFlashMessages() {
    if (isset($_SESSION['flash_messages'])) {
        foreach ($_SESSION['flash_messages'] as $type => $messages) {
            foreach ($messages as $message) {
                echo "<div class='flash-message {$type}'>{$message}</div>";
            }
        }
        // Esborra els missatges flash després de mostrar-los
        unset($_SESSION['flash_messages']);
    }
}
?>
