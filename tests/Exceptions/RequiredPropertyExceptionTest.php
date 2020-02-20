<?php

use Caspian\Exceptions\RequiredPropertyException;
use PHPUnit\Framework\TestCase;

class RequiredPropertyExceptionTest extends TestCase
{
    /** @test */
    public function ensure_default_exception_message()
    {
        $this->expectExceptionMessage('A required property is not set.');

        throw new RequiredPropertyException();
    }

    /** @test */
    public function ensure_custom_exception_message_when_name_is_given()
    {
        $this->expectExceptionMessage('Setting a value for "name" property is required.');

        throw new RequiredPropertyException('name');
    }
}