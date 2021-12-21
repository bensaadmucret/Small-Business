<?php declare(strict_types=1);

namespace App\Container;

use ReflectionMethod;
use App\Container\Exception\NotFound;
use Psr\Container\ContainerInterface;

/**
 * Resolver interface
 */
interface ResolverContainerInterface extends ContainerInterface
{

    /**
     * Resolve service arguments
     *
     * @param ReflectionMethod $method
     * @return array
     *
     * @throws NotFound No parameter was found for constructor identifier
     */
    public function resolve(ReflectionMethod $method): array;
}
