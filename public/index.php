<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
use App\factory\AppFactory;
use Core\Database\Connection;

try {
    $db =   Connection::get()->connect();
} catch (\PDOException $e) {
    echo $e->getMessage();
}

    
$app = AppFactory::create();

$container = $app::getContainer();

$app::run();

