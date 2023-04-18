<?php

require_once 'User.php';

class Auth {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($first_name, $last_name, $email, $password) {
        $user = new User($this->pdo);
        if ($user->checkEmailExists($email)) {
            throw new Exception('Email already exists');
        }
        $user->createUser($first_name, $last_name, $email, $password);
        return true;
    }

    public function login($email, $password) {
        $user = new User($this->pdo);
        $userData = $user->getUserByEmail($email);
            
        if ($userData && password_verify($password, $userData->getPassword())) {
            $_SESSION['user_id'] = $userData->getId();
            $_SESSION['is_admin'] = $userData->isAdmin();
            return true;
        }
        return false;
    }
    

    public function checkAdmin() {
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
            return true;
        }
        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['is_admin']);
        session_destroy();
    }
}

?>
