<?php

namespace App;

use App\router\Router;


class Application{
    
        public function run(){

           
            // router
            $router = new Router();            
            Router::setNameSpace('App\\Controller\\');
           
            $router->add('GET', '/', 'HomeController@index', 'home');
            $router->add('GET','/', function(){
                echo 'hello';
            },'home');
            $router->dispatch();

          
            
        }

        
}