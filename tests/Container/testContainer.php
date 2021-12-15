<?php declare(strict_types=1);


namespace App\Tests\Container;

use App\Container\Container;
use PHPUnit\Framework\TestCase;
use App\Container\testClass\Bar;
use App\Container\testClass\Foo;
use App\Container\Exception\NotFound;
use Psr\Container\ContainerInterface;
use App\Container\Exception\ContainerException;
use App\Container\Exception\ExceptionContainer;
use DeepCopy\f001\B;
use Exception;
use SebastianBergmann\Exporter\Exporter;

class testContainer extends TestCase
{
    private $container;
    private $bar;
    private $foo;

    public function setUp():void
    {
        $this->container = new Container();
        $this->bar = new Bar();
        $this->foo = new Foo(new Bar());
    }
    public function testContainer()
    {
        $this->container->set('foo', $this->foo);
        $instance_1 = $this->container->get('foo');
        $instance_2 = $this->container->get('foo');
        $this->container->set('bar', $this->bar);
        $this->assertEquals(\spl_object_id($instance_1), \spl_object_id($instance_2));
        $this->assertInstanceOf(Foo::class, $instance_1);
        $this->assertInstanceOf(ContainerInterface::class, $this->container);
        $this->assertInstanceOf(Container::class, $this->container);
        $this->assertInstanceOf(Foo::class, $this->container->get('foo'));
        $this->assertInstanceOf(Bar::class, $this->container->get('bar'));
    }
   
    public function testGet()
    {
        $container = new Container();

        $container->set('foo', 'bar');
        $this->assertEquals('bar', $container->get('foo'));
    }
   


    public function testGetNotFound()
    {
        $this->expectException(NotFound::class);
        $this->expectErrorMessage("The identifier 'foo' is not defined");
        $this->container->get('foo');
    }

   

    public function testSet()
    {
        $container = new Container();
        $container->set('foo', 'bar');
        $this->assertEquals('bar', $container->get('foo'));
    }

   

    public function testHas()
    {
        $container = new Container();
        $container->set('foo', 'bar');
        $this->assertTrue($container->has('foo'));
        $this->assertFalse($container->has('bar'));
    }


    public function testSetException()
    {
        $container = new Container();
        $this->expectException(ExceptionContainer::class);
        $container->set('foo', 'bar');
        $container->set('foo', 'bar');
    }
    

    public function testSetOverwrite()
    {
        $container = new Container();
        $this->expectException(ExceptionContainer::class);

        $container->set('foo', 'bar');
        $container->set('foo', 'baz');
    }

    public function testRemoveException()
    {
        $container = new Container();
        $this->expectException(NotFound::class);
        $container->remove('foo');
    }
}
