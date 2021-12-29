<?php declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';

use Core\Database\Connection;
use Phinx\Console\Command\Create;

try {
    $db =   Connection::get()->connect();
} catch (\PDOException $e) {
    echo $e->getMessage();
}

$name = $argv[1];
$password = $argv[2];

$query = $db->prepare('INSERT INTO admins (username, email, password, created_at, updated_at) VALUES (:username, :email, :password, :created_at, :updated_at)')
    ->execute([
        'username' => '' . $name. '',
        'email' => '' . $password . '',
        'password' => password_hash('admin', PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => null,   
    ]);

echo 'Admin created';








