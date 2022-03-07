<?php declare(strict_types=1);

namespace Core\Router;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{
    private string $url;
    private array $routes = [];
    public static $namespace;
    public $callable;
    private string $method;
    public string $generateUri;

    public function __construct()
    {
        $request = Request::createFromGlobals();
        $this->url = $request->getPathInfo();
        $this->method = $request->getMethod();
       
        
    }


    /**
     * add route with callable function or class
     * @param string $url
     * @param $callable
     * @param string $method
     * @param string $name
     */
    public function add(string $method, string $path, $callable, string $name)
    {
        $route = new Route($method, $path, $callable, $name);     
        $this->routes[] = [$route];    
       
      
    }

    


    /**
     * boucle sur les routes pour trouver une correspondance avec l'url courante
     * si une correspondance est trouvée, on retourne le nom de la route
     *
     * @return string
     * @throws \Exception
     */
    public function getName(): string
    {
        foreach ($this->routes as $route) {
            foreach ($route as $r) {
                if ($r->match($this->url)) {
                    return $r->name;
                }
            }
        }
        throw new \Exception('No route found for this url');
    }
   
    /**
     * retourne la méthode courante
     * @param string $name
     * @return Route
     */
    public function getMethod()
    {
        if ($this->method !== null) {
            return $this->method;
        }
        throw new \Exception('No method found');
    }
    
    
        


    /**
     * Retourne la route correspondante à l'url courante
     * @return Route
     */
    public function getRoute($callable)
    {
        foreach ($this->routes as $route) {
            foreach ($route as $r) {
                if ($r->callable === $callable):
                return '/' . $r->path;
                endif;
            }
        }
        throw new \Exception('No route found for this url');
    }


    /**
     * retourne l'url courante
     * @return string
     */
    public function getPath()
    {
        return $this->url;
    }
        
   
    /**
     *
     * @param string $url
     * @return void
     * @throws RouterException
     * @throws \Exception
     */
    public function run()
    {
        foreach ($this->routes as $route) {
            foreach ($route as $r) {
                if (!isset($r->method)) {
                    throw new RouterException('REQUEST_METHOD does not exist');
                }
                if ($r->match($this->url)) {
                    return $r->call();
                }
            }
        }
        throw new RouterException('No matching routes');
    }

    
    


    /**
     * set namespace for controller
     *
     * @param [type] $namespace
     * @return void
     */
    public static function setNameSpace($namespace)
    {
        return self::$namespace = $namespace;
    }


    /**
     * get namespace for controller
     *
     * @return string
     */
    public static function getNameSpace(): string
    {
        return self::$namespace;
    }
    
    /**
     * display the url of the route
     *
     * @return void
     */
    public function dispatch()
    {
        try {
            $response = $this->run();
        } catch (RouterException $e) {
            $response = new Response($e->getMessage(), 404);
        }
        if ($response instanceof Response) {
            $response->send();
        }
    }
}
