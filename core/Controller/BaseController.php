<?php declare(strict_types=1);

namespace Core\Controller;


use Core\Session\Session;
use Core\Database\Connection;
use Core\FormBuilder\FormBuilder;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class BaseController
{
    
    protected $request;
    protected $connection;
    protected $formBuilder;
    protected $session;
  

    public function __construct() {
        $this->request = Request::createFromGlobals();
        $this->connection = Connection::get()->connect();
        $this->formBuilder = new FormBuilder(); 
        $this->session = new Session();
        $this->session->start();
       
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
    protected function render(string $tpl, array $parameters = [], string $model = null, )
    {
        if ($parameters) {
            extract($parameters);
        }
       
        ob_start();
     

        require_once(APP_PATH.'Layouts'. DS . $tpl . '.php');
        $content = ob_get_clean();
        $view =  $model ?? 'default';
        require_once(APP_PATH.'Layouts'. DS . $view . '.php');
        
    }

    
}
