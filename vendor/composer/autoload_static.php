<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit04532f7978fd43a780409696d66879ae
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Webly\\Core\\' => 11,
        ),
        'C' => 
        array (
            'CodeIgniter\\Shield\\' => 19,
            'CodeIgniter\\Settings\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Webly\\Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'CodeIgniter\\Shield\\' => 
        array (
            0 => __DIR__ . '/..' . '/codeigniter4/shield/src',
        ),
        'CodeIgniter\\Settings\\' => 
        array (
            0 => __DIR__ . '/..' . '/codeigniter4/settings/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit04532f7978fd43a780409696d66879ae::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit04532f7978fd43a780409696d66879ae::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit04532f7978fd43a780409696d66879ae::$classMap;

        }, null, ClassLoader::class);
    }
}
