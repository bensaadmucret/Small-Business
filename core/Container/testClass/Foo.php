<?php
namespace Core\Container\testClass;

use Core\Container\testClass\Bar;

 class Foo
 {
     public function __construct(Bar $bar)
     {
         $bar->bar();
     }

     public function foo()
     {
         echo 'foo';
     }
 }
