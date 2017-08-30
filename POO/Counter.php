<?php

class Counter
{
    private $_life = 1;

    private static $_counter = 0;

    public function __construct()
    {
        self::$_counter++;
    }

    public static function displayCounting()
    {
        echo self::$_counter;
    }
}
