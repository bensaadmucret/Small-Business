<?php declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';

use Core\Database\Connection;


try {
    $db =   Connection::get()->connect();
} catch (\PDOException $e) {
    echo $e->getMessage();
}
//var_dump($argv);
($username = $argv[1]) || die('Please provide a username');
($password = $argv[2]) || die('Please provide a password');
($email = $argv[3]) || die('Please provide a email');
($role = $argv[4]) || die('Please provide a role');

$query = $db->prepare('INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role, NOW())');
$query->bindParam(':username', $username);
$query->bindParam(':password', $password);
$query->bindParam(':email', $email);
$query->bindParam(':role', $role);
$query->bindParam(':created_at', DateTime::now());


$query->execute();


echo 'User created';








