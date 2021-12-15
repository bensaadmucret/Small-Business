<?php
namespace App\Container\testClass;

 class Foo
 {
     public function __construct(Bar $bar)
     {
         $this->bar = $bar;
     }
 }
