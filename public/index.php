<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
use App\factory\AppFactory;
//use Core\Database\Connection;


    
$app = AppFactory::create();

$container = $app::getContainer();
$container->get('Database')->connect();



//dump($container->get('Router')->getPath());
//dump($container->get('Router'));



$app::run();



