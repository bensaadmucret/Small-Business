<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Core\Router\Router;
use App\factory\AppFactory;

$app = AppFactory::create();

$app->run();
