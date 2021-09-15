<?php

namespace Appstract\Opcache\Test\Stubs;

/**
 * This fake class is to be compiled
 * @see \Appstract\Opcache\Test\CompileTest
 */
class FakeClass
{
    protected $a;
    protected $b;

    public function __construct()
    {
        $this->a = 'Hello';
        $this->b = 'World';
    }

    public function greet()
    {
        return $this->a . ' ' . $this->b;
    }
}
