<?php declare(strict_types=1);
require __DIR__ . '/../vendor/autoload.php';
use App\factory\AppFactory;




//print_r(absolutePath('public/index.php'));

$app = new AppFactory();
$app->create();
