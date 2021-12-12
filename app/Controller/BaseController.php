<?php declare(strict_types=1);

namespace App\Controller;

use Psr\Container\ContainerInterface;



// class BaseController with container and view

abstract  class BaseController implements ContainerInterface
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

    public function __set($property, $value)
    {
        $this->container->{$property} = $value;
    }

    public function __call($method, $args)
    {
        if ($this->container->{$method}) {
            return $this->container->{$method}(...$args);
        }
    }

    public function view($view, $data = [])
    {
        $view = $this->container->view->render($view, $data);
        return $view;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function get($id){
        return $this->container->get($id);
    }

      /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     */
    public function has($id)
    {   try{
        return $this->container->has($id);
        }catch (\Exception $e){
        return false;
     }   
    }

}