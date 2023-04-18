<?php

class User {
    private $pdo;
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $is_admin;
    private $password;

    public function __construct($pdo, $id = null) {
        $this->pdo = $pdo;
        if ($id) {
            $user_data = $this->readUserById($id);
            if ($user_data) {
                $this->id = $user_data['id'];
                $this->first_name = $user_data['first_name'];
                $this->last_name = $user_data['last_name'];
                $this->email = $user_data['email'];
                $this->is_admin = $user_data['is_admin'];
                $this->password = $user_data['password'];
            }
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function isAdmin() {
        return $this->is_admin;
    }

    public function getPassword() {
        return $this->password;
    }
    public function readUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user_data;
    }

    public function readAllUsers() {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        $users_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users_data;
    }

    public function searchUser($search_term) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE first_name LIKE ? OR last_name LIKE ?");
        $stmt->execute(["%$search_term%", "%$search_term%"]);
        $users_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users_data;
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function checkEmailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    
    public function createUser($first_name, $last_name, $email, $password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $email, $password_hash]);
    }
    
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user_data) {
            return null;
        }
        $user = new User($this->pdo, $user_data['id']);
        return $user;
    }
    
}

    
