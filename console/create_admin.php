<?php declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';

use App\Application;
use Core\Database\Connection;

$db = Application::getContainer()->get('Database')->connect();
/*
try {
    $db =   Connection::get()->connect();
} catch (\PDOException $e) {
    echo $e->getMessage();
}*/


($username = $argv[1]) || die('Please provide a username');
($password = $argv[2]) || die('Please provide a password');
($email = $argv[3]) || die('Please provide a email');
($role = $argv[4]) || die('Please provide a role');

$query = $db->prepare('INSERT INTO users (username, password, email, role, created_at, updated_at) VALUES (:username, :password, :email, :role, NOW(), NOW())');
$query->execute([
    'username' => $username,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'email' => $email,
    'role' => $role,
    
    
]);


echo 'User created';








