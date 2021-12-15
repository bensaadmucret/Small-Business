<?php declare(strict_types=1);

namespace App\Container;

use Reflection;
use ReflectionClass;
use ReflectionFunction;
use App\Container\Exception\NotFound;
use Psr\Container\ContainerInterface;
use App\Container\Exception\ExceptionContainer;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use Symfony\Component\Console\Helper\Dumper;

class Container implements ContainerInterface
{
    public array $_container = [];
    


    public function set($id, $value)
    {
        if (isset($this->_container[$id])) {
            throw new ExceptionContainer("The id '$id' is already set");
        }
        if ($value instanceof \Closure) {
            $refFunction = new ReflectionFunction($value);
         
            $parameters = $refFunction->getParameters();

            $validParameters = [];
            foreach ($parameters as $parameter) {
                if (!array_key_exists($parameter->getName(), $valuesToProcess) && !$parameter->isOptional()) {
                    throw new ExceptionContainer('Cannot resolve the parameter' . $parameter->getName());
                }

                if (!array_key_exists($parameter->getName(), $valuesToProcess)) {
                    continue;
                }

                $validParameters[$parameter->getName()] = $valuesToProcess[$parameter->getName()];
            }

            $this->_container[$id] =  $refFunction->invoke(...$validParameters);
        }
        
        $this->_container[$id] = $reflected_class = new ReflectionClass($value);
        // On récupère la class depuis la chaine de caractère
        if ($reflected_class->isInstantiable()) { // On a bien une class instanciable (et pas une interface)
            $constructor = $reflected_class->getConstructor(); // On récupère le constructeur
            if ($constructor) {
                // Si le constructeur existe alors on va analyser ses paramètres
                $parameters = $constructor->getParameters();
                $constructor_parameters = [];
                foreach ($parameters as $parameter) {
                    if ($parameter->getType()) {
                        $constructor_parameters[] = $this->get(
                            $parameter->getName(),
                        );
                    } else {
                        $constructor_parameters[] = $parameter->getDefaultValue();
                    }
                }
                $this->_container[$id] =
                $reflected_class->newInstanceArgs(
                    $constructor_parameters
                );
                return $this->_container;
            } else {
                // sinon on peut directement instancier notre objet à vide.
                $this->_container[$i] = $reflected_class->newInstance($value);
                return $this->_container;
            }
        } else {
            throw new ExceptionContainer($id . " is not an instanciable Class");
        }
    }

    

    
   

    /**
      * Finds an entry of the container by its identifier and returns it.
      *
      * @param string $id Identifier of the entry to look for.
      *
      * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
      * @throws ContainerExceptionInterface Error while retrieving the entry.
      *
      * @return mixed Entry.
      */

    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new NotFound("The identifier '$id' is not defined");
        } else {
            return $this->_container[$id];
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function has($id): bool
    {
        return isset($this->_container[$id]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function remove($id)
    {
        if (!$this->has($id)) {
            throw new NotFound("The identifier '$id' is not defined");
        } else {
            unset($this->_container[$id]);
        }
    }

    /**
     * get all keys
     */
    public function getContainer(): array
    {
        return $this->_container;
    }

    /**
     * clear all container
     * @return void
     */
    public function clear()
    {
        $this->_container = [];
    }
}
