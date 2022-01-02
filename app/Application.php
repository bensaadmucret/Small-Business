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
        $router->add('GET', '/dashboard', 'AuthController@dashboard', 'dashboard');
        $router->add('GET', '/logout', 'AuthController@logout', 'logout');

        $router->add('GET', '/product', 'ProductController@index', 'product_index');
        $router->add('GET', '/product/:id', 'ProductController@show', 'product_show');
        $router->add('GET', '/product/create', 'ProductController@create', 'product_create');
        $router->add('POST', '/product/create', 'ProductController@store', 'product_store');
        $router->add('GET', '/product/:id/edit', 'ProductController@edit', 'product_edit');
        $router->add('POST', '/product/:id/edit', 'ProductController@update', 'product_update');
        $router->add('GET', '/product/:id/delete', 'ProductController@delete', 'product_delete');
        $router->add('POST', '/product/:id/delete', 'ProductController@destroy', 'product_destroy');

        

        
        $router->add('GET', '/about', 'HomeController@about', 'about');
        $router->add('GET', '/contact', 'HomeController@contact', 'contact');
        $router->add('GET', '/blog', 'HomeController@blog', 'blog');
        $router->add('GET', '/blog/:123', 'HomeController@blogPost', 'blog_post');
        $router->add('GET', '/blog/category/:125', 'HomeController@blogCategory', 'blog_category');
        
       
      
        $router->dispatch();
    }
    

    
}
