<?php declare(strict_types=1);

namespace Core\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController
{
    public $actions;
    protected $_module;
    protected $_name;
    protected $_request;
    protected $_response;
    protected $_invoke_args;
    protected $_view;
    protected $_httpClient;

    public function __contructor(
        Request $request,
        Response $response,
        $_invoke_args,
        $_view,
        $_httpClient
    ) {
        $this->_request = new \App\Request\Request();
        $this->_response = new \App\Response\Response();
        $this->_invoke_args = $invoke_args;
        $this->_view = $_view;
        $this->_httpClient = HttpClient::create();
    }

    public function display(string $tpl, array $parameters = null): bool
    {
        $this->_view->display($tpl, $parameters);
    }

    public function getInvokeArg(string $name): string
    {
        return $this->_invoke_args[$name];
    }

    
    public function getInvokeArgs(): array
    {
        return $this->_invoke_args;
    }
    

    public function getModuleName(): string
    {
        return $this->_module;
    }
    public function getName(): string
    {
        return $this->_name;
    }
    public function getRequest(): Request
    {
        return $this->_request;
    }
    public function getResponse(): Response
    {
        return $this->_response;
    }
    public function getView(): View
    {
        return $this->_view;
    }
    public function getViewpath(): string
    {
        return $this->_view->getViewpath();
    }
    public function initView(array $options = null): void
    {
        $this->_view = new View($options);
    }
    public function redirect(string $method, string $url, int $statusCode): bool
    {
        try {
            $response = $this->_httpClient->request($method, $url, $satusCoode);
            return $response;
        } catch (\Exception $e) {
            return false;
        }
    }

    

    protected function render(string $tpl, array $parameters = null): string
    {
        return $this->_view->render($tpl, $parameters);
    }
}
