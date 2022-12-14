<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit01f17bfd7a8d1391e910131a0384c1c7
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LPMatrix\\FluidCoins\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LPMatrix\\FluidCoins\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit01f17bfd7a8d1391e910131a0384c1c7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit01f17bfd7a8d1391e910131a0384c1c7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit01f17bfd7a8d1391e910131a0384c1c7::$classMap;

        }, null, ClassLoader::class);
    }
}
