<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita8fc8a6c137073e22c360fb021ee9d09
{
    public static $files = array (
        '89ff252b349d4d088742a09c25f5dd74' => __DIR__ . '/..' . '/yahnis-elsts/plugin-update-checker/plugin-update-checker.php',
        'cbd6bada88b6bca5d1b8b1b5733f514e' => __DIR__ . '/..' . '/wp-content-framework/core/autoload.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MatthiasMullie\\PathConverter\\' => 29,
            'MatthiasMullie\\Minify\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MatthiasMullie\\PathConverter\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/path-converter/src',
        ),
        'MatthiasMullie\\Minify\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/minify/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita8fc8a6c137073e22c360fb021ee9d09::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita8fc8a6c137073e22c360fb021ee9d09::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}