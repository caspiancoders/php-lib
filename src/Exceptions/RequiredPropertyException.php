<?php

namespace Caspian\Exceptions;

class RequiredPropertyException extends \Exception
{
    public function __construct($name = '')
    {
        $message = 'A required property is not set.';

        if ($name) {
            $message = sprintf('Setting a value for "%s" property is required.', $name);
        }

        parent::__construct($message);
    }
}