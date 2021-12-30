<?php declare(strict_types=1);

namespace App;

use Core\Router\Router;
use Core\Container\Container;

class Application
{
    


    public function run()
    {
        $router = new Router();
        Router::setNameSpace('App\\Controller\\');
           
        $router->add('GET', '/', 'HomeController@index', 'home');
        $router->add('POST', '/login', 'AuthController@login', 'login');    
        $router->add('GET', '/login', 'AuthController@login', 'login');
        

        
        $router->add('GET', '/about', 'HomeController@about', 'about');
        $router->add('GET', '/contact', 'HomeController@contact', 'contact');
        $router->add('GET', '/blog', 'HomeController@blog', 'blog');
        $router->add('GET', '/blog/:123', 'HomeController@blogPost', 'blog_post');
        $router->add('GET', '/blog/category/:125', 'HomeController@blogCategory', 'blog_category');
        
       
      
        $router->dispatch();
    }
    

    
}
