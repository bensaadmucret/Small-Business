<?php declare(strict_types=1);

namespace App\Controller;
use Psr\Container\ContainerInterface;


use Symfony\Component\HttpFoundation\Response;

class HomeController extends BaseController
{
    public function __contruct()
    {
        parent::__construct();
    }

    public function index() : Response
    {
        return new Response('<html><body>Hello World!</body></html>');
    }

    


    
}