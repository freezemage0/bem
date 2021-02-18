<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


use Freezemage\Bem\Compiler;
use Freezemage\Bem\Config;
use Freezemage\Bem\Page\Loader;


spl_autoload_register(function (string $fqn): void {
    $fqn = str_replace('\\', '/', ltrim($fqn, '/'));
    $absolute = realpath(__DIR__ . '/src') . '/' . $fqn . '.php';
    if (is_file($absolute)) {
        /** @noinspection PhpIncludeInspection */
        include $absolute;
    }
});

$config = new Config(
        'asset/',
        'out/',
        'cache/',
        "\t",
        'js',
        'css'
);

$compiler = Compiler::fromConfig($config);

$loader = new Loader($config, $compiler);
print_r($loader->load('page'));