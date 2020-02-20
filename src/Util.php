<?php

namespace Caspian;

class Util
{
    public static function defineOnce($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }
}