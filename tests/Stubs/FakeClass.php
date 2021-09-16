<?php

namespace Appstract\Opcache\Test\Stubs;

/**
 * This fake class is to be compiled
 * @see \Appstract\Opcache\Test\CompileTest
 */
class FakeClass
{
    protected string $a;
    protected string $b;

    public function __construct()
    {
        $this->a = 'Hello';
        $this->b = 'World';
    }

    public function greet(): string
    {
        return $this->a . ' ' . $this->b;
    }
}
