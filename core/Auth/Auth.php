<?php

declare(strict_types=1);


namespace Core\Auth;

use Core\Database\Connection;

class auth
{
    public function __construct()
    {
        $this->db = Connection::get()->connect();
    }
    
    public function login($email, $password)
    {
        $query = $db->prepare('SELECT * FROM users WHERE email = :email');               
        $query->execute([
            'email' => $email,
            ]);
        $user = $query->fetch();   
        
        if(!$user) {
            return false;
        }
        
        if(!password_verify($password, $user['password'])) {
            return false;
        }
        
        $_SESSION['user'] = $user;
        return true;
    }

    public function isAdmin()
    {
        if(!isset($_SESSION['user'])) {
            return false;
        }
        
        $user = $_SESSION['user'];
        if($user['role'] == 'admin') {
            return true;
        }
        
        return false;
    }
    
    public function logout()
    {
        unset($_SESSION['user']);
    }
    
    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }
    
    public function getUser()
    {
        return $_SESSION['user'];
    }
}