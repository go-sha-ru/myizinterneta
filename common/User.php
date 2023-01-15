<?php
require_once('DB.php');

class User {
    public $id;
    public $username;
    public $isLogged;

    function __construct()
    {
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== '') {
            $this->id = $_SESSION['user_id'];
            $this->username = $_SESSION['username'];
            $this->isLogged = true;
        } else {            
            $this->username = '';
            $this->isLogged = false;
        }
    }

    function login($username, $password)
    {
        $pdo = new DB;
        $data = $pdo->db->prepare('select id, username, password_hash from users where username=:username');
        $data->bindParam(':username', $username);
        $data->execute();
        $user = $data->fetch();
        if ($user && password_verify($password, $user['password_hash'])) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->isLogged = true;
            $_SESSION['user_id'] = $this->id;
            $_SESSION['username'] = $this->username;
            return true;
        }
        return false;
    }

    function logout()
    {
        $_SESSION['user_id'] = '';
        $_SESSION['username'] = '';
    }
}