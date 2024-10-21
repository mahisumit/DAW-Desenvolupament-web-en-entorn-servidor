<?php
// @autor Sumit Mahi
include '../config.php';
include '../models/User.php';

class UserController {
    // Inicia sessió d'un usuari
    public function login($username, $password) {
        $user = new User();
        return $user->login($username, $password);
    }

    // Registra un nou usuari
    public function signup($username, $email, $password, $confirm_password) {
        if ($password !== $confirm_password) {
            return false; // Les contrasenyes no coincideixen
        }

        $user = new User();
        return $user->signup($username, $email, $password);
    }

    // Canvia la contrasenya d'un usuari
    public function changePassword($username, $oldPassword, $newPassword) {
        $user = new User();
        return $user->changePassword($username, $oldPassword, $newPassword);
    }
}
?>