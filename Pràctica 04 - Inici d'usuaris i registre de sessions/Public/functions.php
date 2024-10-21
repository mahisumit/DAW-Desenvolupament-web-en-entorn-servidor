<?php
// @autor Sumit Mahi

// Per establir missatges de informació, error, advertència etc. 
function setFlashMessage($type, $message) {
    if (!isset($_SESSION['flash_messages'])) {
        $_SESSION['flash_messages'] = [];
    }
    $_SESSION['flash_messages'][] = ['type' => $type, 'message' => $message];
}

// Mostra els missatges flash i els elimina de la sessió
function displayFlashMessages() {
    if (isset($_SESSION['flash_messages'])) {
        foreach ($_SESSION['flash_messages'] as $flash_message) {
            echo '<div class="flash-message ' . $flash_message['type'] . '">' . $flash_message['message'] . '</div>';
        }
        unset($_SESSION['flash_messages']);
    }
}

// Canvia la contrasenya d'un usuari
function changePassword($userId, $oldPassword, $newPassword) {
    // funció per obtenir l'usuari per ID
    $user = getUserById($userId);

    if (!$user) {
        setFlashMessage('error', 'Usuari no trobat.');
        return false;
    }

    // Verifica la contrasenya antiga
    if (!password_verify($oldPassword, $user['password'])) {
        setFlashMessage('error', 'La contrasenya antiga és incorrecta.');
        return false;
    }

    //La nova contrasenya
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // funció per actualitzar la contrasenya de l'usuari
    if (updateUserPassword($userId, $hashedPassword)) {
        setFlashMessage('success', 'Contrasenya canviada amb èxit.');
        return true;
    } else {
        setFlashMessage('error', 'No s\'ha pogut canviar la contrasenya.');
        return false;
    }
}

// Funció de marcador de posició per obtenir l'usuari per ID
function getUserById($userId) {
    return [
        'id' => $userId,
        'password' => '$2y$10$examplehashedpassword'
    ];
}

// Funció de marcador de posició per actualitzar la contrasenya de l'usuari
function updateUserPassword($userId, $hashedPassword) {
    return true;
}

?>