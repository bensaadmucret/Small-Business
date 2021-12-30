<?php declare(strict_types=1);

namespace Core\Controller;

use Core\Router\Router;
use Core\Container\Container;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController
{
    public $actions;
    
    protected $request;
    protected $response;
    protected $httpClient;
    protected $router;
    protected $container;
    protected $pdo;

    public function __contructor(
        Request $request,
        Response $response,
        $httpClient,
        $router,
        $container,
        
    ) {
        $this->request = Request::createFromGlobals();
        $this->response = new Response();
        $this->httpClient = HttpClient::create();
        $this->router = new Router();
        $this->container = new Container();
        
       
    }

    public function getContainer()
    {
        return $this->container;
    }

    
       
    
    public function redirect(string $method, string $url, int $statusCode): bool
    {
        try {
            $response = $this->httpClient->request($method, $url, $statusCode);
            return $response;
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
