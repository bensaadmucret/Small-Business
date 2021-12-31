<?php declare(strict_types=1);

namespace Core\Controller;


use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class BaseController
{
    public $actions;
    
    protected $request;
  

    public function __contructor(
        Request $request,
       
        
    ) {
        $this->request = Request::createFromGlobals();
      
    
       
    }

    public function getContainer()
    {
        return $this->container;
    }

    
       
    
    public function redirect( string $url, int $statusCode): bool
    {
        try {
            $redirection = new RedirectResponse($url, $statusCode);
            return $redirection->send();
        } catch (\Exception $e) {
            return false;
        }
    }

    
    /**
     * @param string $view
     * @param array $data
     * @return Response
     */
    protected function render(string $tpl, array $parameters = [])
    {
        if ($parameters) {
            extract($parameters);
        }
       
        ob_start();
     

        require_once(APP_PATH.'Layouts'. DS . $tpl . '.php');
     
        $content = ob_get_clean();
        

        require_once(APP_PATH.'Layouts'. DS .'default.php');

        
    }
}
