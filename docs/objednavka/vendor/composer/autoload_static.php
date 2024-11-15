<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd8d0a5a713a512fd49a3b18ed3ad77c9
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd8d0a5a713a512fd49a3b18ed3ad77c9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd8d0a5a713a512fd49a3b18ed3ad77c9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd8d0a5a713a512fd49a3b18ed3ad77c9::$classMap;

        }, null, ClassLoader::class);
    }
}
