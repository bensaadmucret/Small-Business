<?php declare(strict_types=1);


namespace App\factory;

use App\Application;



// create the AppFactory class for the application factory pattern

class AppFactory 
{
    public function create()
    {
        
        // create the application
        $application = (new Application())->run();
        
       

        
        // create the container
        $container = $application->getContainer();

        // create the database connection
        $container['db'] = function ($container) {
            try {
                $db =   Connection::get()->connect(); 
              } catch (\PDOException $e) {
                  echo $e->getMessage();
              }
        };
        /*
        // create the view
        $container['view'] = function ($container) {
            $view = new \Slim\Views\Twig(__DIR__ . '/../../resources/views', [
                'cache' => false
            ]);

            // Instantiate and add Slim specific extension
            $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
            $view->addExtension(new \Slim\Views\TwigExtension($container['router'], $basePath));

            return $view;
        };

        // create the logger
        $container['logger'] = function ($container) {
            $logger = new \Monolog\Logger('slim-app');
            $file_handler = new \Monolog\Handler\StreamHandler(__DIR__ . '/../../logs/app.log');
            $logger->pushHandler($file_handler);
            return $logger;
        };

        // create the flash
        $container['flash'] = function ($container) {
            return new \Slim\Flash\Messages;
        };

        // create the session
        $container['session'] = function ($container) {
            return new \SlimSession\Helper;
        };

        // create the CSRF
        $container['csrf'] = function ($container) {
            return new \Slim\Csrf\Guard;
        };

        // create the auth
        $container['auth'] = function ($container) {
            return new \App\Auth\   
        };
        */
    }
}