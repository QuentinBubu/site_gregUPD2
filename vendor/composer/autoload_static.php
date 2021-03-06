<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3b0bdfcf574ea69460bf5e07843a53c2
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App/php/class',
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3b0bdfcf574ea69460bf5e07843a53c2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3b0bdfcf574ea69460bf5e07843a53c2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3b0bdfcf574ea69460bf5e07843a53c2::$classMap;

        }, null, ClassLoader::class);
    }
}
