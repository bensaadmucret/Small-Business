<?php declare(strict_types=1);

namespace App;

use App\router\Router;
use Core\Container\Container;

class Application
{
    protected $container;

    public function __construct()
    {
        $this->container = new Container();
    }
    

    public function run()
    {

           
            // router
        $router = new Router();
        Router::setNameSpace('App\\Controller\\');
           
        $router->add('GET', '/', 'HomeController@index', 'home');
        $router->add('GET', '/', function () {
            echo 'hello';
        }, 'home');
        $router->dispatch();
    }

    public function getContainer()
    {
        return $this->container;
    }
}
