<?php declare(strict_types=1);
require __DIR__ . '/../../vendor/autoload.php';

use Core\Database\Connection;
use Phinx\Console\Command\Create;

try {
    $db =   Connection::get()->connect();
} catch (\PDOException $e) {
    echo $e->getMessage();
}








