<?php declare(strict_types=1);

namespace Core\Container;

use ReflectionClass;
use ReflectionMethod;
use Core\Container\Exception\NotFound;
use Psr\Container\ContainerInterface;
use Core\Container\ResolverContainerInterface;
use Core\Container\Exception\ExceptionContainer;



class Container implements ContainerInterface
{

    /**
     * @var array
     */
    private array $services = [];


    public function __construct(array $services = [])
    {
        $this->services = $services;
    }
    
    

    /**
     * {@inheritDoc}
     * @see \Psr\Container\ContainerInterface::get()
     */
    public function get($id): object
    {
        try {
            return !$this->has($id)
                ? $this->services[$id] = (new ReflectionClass($id))->newInstance()
                : $this->services[$id];
        } catch (NotFound $e) {
            throw $e;
        } catch (ExceptionContainer $e) {
            throw $e;
        }
    }

    /**
     * {@inheritDoc}
     * @see \Psr\Container\ContainerInterface::has()
     */
    public function has($id): bool
    {
        return array_key_exists($id, $this->services) && is_object($this->services[$id]);
    }


    /**
     * @var ResolverContainerInterface
     * @var array
     * trow new ExceptionContainer
     */
    public function resolve(ReflectionMethod $method)
    {
        
        if (!$method->isPublic()) {
            throw new ExceptionContainer('Method is not public');
        }
        $parameters = $method->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[] = $this->get($parameter->getType()->getName());
        }
        $this->services[$method->getDeclaringClass()->getName()] = $method->invoke(null, ...$args);
        return $method->invokeArgs(null, $args);
    }


    /**
     * {@inheritDoc}
     * @see ContainerInterface::call()
     */
    public function call(string $id, string $action, array $arguments = [])
    {
        try {
            $service = $this->get($id);
            $arguments = $this->resolve(
                (new ReflectionClass($id))->getMethod($action),
                $this->services,
                $arguments
            );
        } catch (ExceptionContainer $e) {
            throw new NotFound('Action "' . $action . '" Not Found');
        }
        return $service->{$action}(...$arguments);
    }

    /**
     * {@inheritDoc}
     * @see ContainerInterface::set()
     */
    public function set(string $id, $service): void
    {
        $this->services[$id] = $service;
    }

    /**
     * {@inheritDoc}
     * @see ContainerInterface::getResolver()
     */
    public function getResolver(): ResolverContainerInterface
    {
        return $this->resolver;
    }

    /**
     * {@inheritDoc}
     * @see ContainerInterface::setResolver()
     */
    public function setResolver(ResolverContainerInterface $resolver): void
    {
        $this->resolver = $resolver;
    }

    /**
     * {@inheritDoc}
     * @see ContainerInterface::getServices()
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * {@inheritDoc}
     * @see ContainerInterface::setServices()
     */
    public function setServices(array $services): void
    {
        $this->services = $services;
    }

    /**
     * {@inheritDoc}
     * @see ContainerInterface::get()
     */
    public function __invoke(string $id)
    {
        return $this->get($id);
    }

    /**
     * {@inheritDoc}
     * @see ContainerInterface::has()
     */
    public function __isset(string $id)
    {
        return $this->has($id);
    }
}
