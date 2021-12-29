<?php declare(strict_types=1);

namespace App\Controller;

use Core\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends BaseController
{
    public function __contruct()
    {
        parent::__construct();
    }

    public function index()
    {
        return  $this->render('home/index');
    }

    public function about()
    {
      
        return  $this->render('home/about');
    }
   


    public function blog() 
    {
        return $this->render('home/blog');
    }

    public function contact()
    {
        return $this->render('home/contact');
    }

    
}
