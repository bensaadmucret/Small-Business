<?php declare(strict_types=1);

namespace App;

use Core\Router\Router;
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
        $router = new Router();
        Router::setNameSpace('App\\Controller\\');
           
        $router->add('GET', '/', 'HomeController@index', 'home');
        $router->add('GET', '/about', 'HomeController@about', 'about');
        $router->add('GET', '/contact', 'HomeController@contact', 'contact');
        $router->add('GET', '/blog', 'HomeController@blog', 'blog');
        $router->add('GET', '/blog/{id:\d+}', 'HomeController@blogPost', 'blog_post');
        $router->add('GET', '/blog/category/{id:\d+}', 'HomeController@blogCategory', 'blog_category');
    }
    public function getContainer()
    {
        return $this->container;
    }
}
