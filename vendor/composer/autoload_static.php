<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite21a880fff706cb7a0b3ec0d3bd04907
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '72579e7bd17821bb1321b87411366eae' => __DIR__ . '/..' . '/illuminate/support/helpers.php',
        '1f6c41c9bc1d1978fff60dc563d85da9' => __DIR__ . '/..' . '/themsaid/laravel-model-transformers/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Themsaid\\Transformers\\' => 22,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\Translation\\' => 30,
        ),
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Container\\' => 14,
        ),
        'I' => 
        array (
            'Illuminate\\Support\\' => 19,
            'Illuminate\\Contracts\\' => 21,
        ),
        'D' => 
        array (
            'Doctrine\\Common\\Inflector\\' => 26,
        ),
        'C' => 
        array (
            'Carbon\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Themsaid\\Transformers\\' => 
        array (
            0 => __DIR__ . '/..' . '/themsaid/laravel-model-transformers/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Illuminate\\Support\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/support',
        ),
        'Illuminate\\Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/contracts',
        ),
        'Doctrine\\Common\\Inflector\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/inflector/lib/Doctrine/Common/Inflector',
        ),
        'Carbon\\' => 
        array (
            0 => __DIR__ . '/..' . '/nesbot/carbon/src/Carbon',
        ),
    );

    public static $classMap = array (
        'TestCase' => __DIR__ . '/..' . '/themsaid/laravel-model-transformers/tests/TestCase.php',
        'Themsaid\\Transformers\\Tests\\Models\\THEMSAID_CATEGORY_MODEL' => __DIR__ . '/..' . '/themsaid/laravel-model-transformers/tests/models/THEMSAID_CATEGORY_MODEL.php',
        'Themsaid\\Transformers\\Tests\\Models\\THEMSAID_PRODUCT_MODEL' => __DIR__ . '/..' . '/themsaid/laravel-model-transformers/tests/models/THEMSAID_PRODUCT_MODEL.php',
        'Themsaid\\Transformers\\Tests\\Models\\THEMSAID_TAG_MODEL' => __DIR__ . '/..' . '/themsaid/laravel-model-transformers/tests/models/THEMSAID_TAG_MODEL.php',
        'Themsaid\\Transformers\\Tests\\Transformers\\THEMSAID_CATEGORY_MODELTransformer' => __DIR__ . '/..' . '/themsaid/laravel-model-transformers/tests/transformers/THEMSAID_CATEGORY_MODELTransformer.php',
        'Themsaid\\Transformers\\Tests\\Transformers\\THEMSAID_PRODUCT_MODELTransformer' => __DIR__ . '/..' . '/themsaid/laravel-model-transformers/tests/transformers/THEMSAID_PRODUCT_MODELTransformer.php',
        'Themsaid\\Transformers\\Tests\\Transformers\\THEMSAID_TAG_MODELTransformer' => __DIR__ . '/..' . '/themsaid/laravel-model-transformers/tests/transformers/THEMSAID_TAG_MODELTransformer.php',
        'TransformersTest' => __DIR__ . '/..' . '/themsaid/laravel-model-transformers/tests/TransformersTest.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite21a880fff706cb7a0b3ec0d3bd04907::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite21a880fff706cb7a0b3ec0d3bd04907::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite21a880fff706cb7a0b3ec0d3bd04907::$classMap;

        }, null, ClassLoader::class);
    }
}
