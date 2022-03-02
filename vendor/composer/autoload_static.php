<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbadda823b0fd02b913eb484928bbddc8
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
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbadda823b0fd02b913eb484928bbddc8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbadda823b0fd02b913eb484928bbddc8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbadda823b0fd02b913eb484928bbddc8::$classMap;

        }, null, ClassLoader::class);
    }
}