<?php declare(strict_types=1);


namespace App\factory;

use App\Application;
use App\Container\testClass\Bar;
use App\Container\testClass\Foo;
use App\Database\Connection;
use DeepCopy\f001\B;
use Symfony\Component\Console\Helper\Dumper;

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

       

        // create the database connection
        $container->set('db', Connection::class);
       
      

        $container->set('foo', Foo::class);

        $container->set(
            'bar',
            function () {
                return new Bar();
            }
        );
    }
}
