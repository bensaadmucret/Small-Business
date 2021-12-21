<?php declare(strict_types=1);


namespace App\factory;

use App\Application;
use Core\Container\testClass\Bar;
use Core\Container\testClass\Foo;
use Core\Database\Connection;

// create the AppFactory class for the application factory pattern

class AppFactory
{
    public function create()
    {
        
        // create the application
        $application = new Application();
        $application->run();
       

        
        // create the container
        $container = $application->getContainer();
        $container->set('Foo', new Foo(new Bar()));
        $container->set('Connection', new Connection());

        $container->get('Connection')->connect();

        $container->get('Foo');
    }
}
