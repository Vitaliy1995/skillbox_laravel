<?php


namespace App;


class Bootstrap
{
    private static $colorsClasses = [
        'blue' => 'primary',
        'gray' => 'secondary',
        'green' => 'success',
        'red' => 'danger',
        'yellow' => 'warning',
        'aqua' => 'info',
        'white' => 'light',
        'black' => 'dark'
    ];

    public static function getBootstrapClassByColor($color)
    {
        return (isset(self::$colorsClasses[$color]))
            ? self::$colorsClasses[$color]
            : self::$colorsClasses['blue'];
    }
}