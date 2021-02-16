<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


use Freezemage\Bem\Builder\ClassNameBuilder;
use Freezemage\Bem\Builder\CssBuilder;
use Freezemage\Bem\Builder\DefaultBuilderFactory;
use Freezemage\Bem\Builder\FilePathBuilder;
use Freezemage\Bem\Builder\HtmlBuilder;
use Freezemage\Bem\Cache\CacheGenerator;
use Freezemage\Bem\Cache\CacheValidator;
use Freezemage\Bem\Compiler;
use Freezemage\Bem\Compiler\CodeGenerator;
use Freezemage\Bem\Config;
use Freezemage\Bem\Entity\Comment;
use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Element;
use Freezemage\Bem\Node\Modifier;
use Freezemage\Bem\Node\NodeCollection;
use Freezemage\Bem\Page\Loader;
use Freezemage\Bem\Snippet\CommentSnippet;


spl_autoload_register(function (string $fqn): void {
    $fqn = str_replace('\\', '/', ltrim($fqn, '/'));
    $absolute = realpath(__DIR__ . '/src') . '/' . $fqn . '.php';
    if (is_file($absolute)) {
        /** @noinspection PhpIncludeInspection */
        include $absolute;
    }
});

$config = new Config(
        __DIR__ . '/asset/',
        __DIR__ . '/out/',
        "\t",
        'js',
        'css'
);

$compiler = new Compiler(
        new DefaultBuilderFactory($config),
        new CacheValidator($config),
        new CacheGenerator($config),
        new CodeGenerator($config),
        $config
);

$loader = new Loader($config, $compiler);
print_r($loader->load('comment'));