<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1c6b3f24c3584b356ef3ae244b7b1411
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/Twilio',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1c6b3f24c3584b356ef3ae244b7b1411::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1c6b3f24c3584b356ef3ae244b7b1411::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
