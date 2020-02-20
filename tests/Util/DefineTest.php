<?php

use PHPUnit\Framework\TestCase;

class DefineTest extends TestCase
{
    /** @test */
    public function ensure_constants_gets_defined()
    {
        \Caspian\Util::defineOnce('CONST_1', '1');

        $this->assertEquals('1', CONST_1);
    }

    /** @test */
    public function ensure_constant_gets_defined_once()
    {
        define('EXAMPLE_CONST', 'a');

        \Caspian\Util::defineOnce('EXAMPLE_CONST', 'z');

        $this->assertEquals('a', EXAMPLE_CONST);
    }
}