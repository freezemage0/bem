<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

require __DIR__ . '/src/Freezemage/Bem/ClassLoader.php';


use Freezemage\Bem\ClassLoader;
use Freezemage\Bem\Compiler;
use Freezemage\Bem\Config;
use Freezemage\Bem\Page\Loader;


ClassLoader::register();

$config = new Config(
        'asset/',
        'out/',
        'cache/',
        "    ",
        'js',
        'css'
);

$compiler = Compiler::fromConfig($config);

$loader = new Loader($config, $compiler);
print_r($loader->load('tenor'));