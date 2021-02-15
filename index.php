<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


use Freezemage\Bem\Builder\ClassNameBuilder;
use Freezemage\Bem\Builder\CssBuilder;
use Freezemage\Bem\Builder\HtmlBuilder;
use Freezemage\Bem\Compiler;
use Freezemage\Bem\Config;
use Freezemage\Bem\Entity\Comment;
use Freezemage\Bem\Node\Element;
use Freezemage\Bem\Node\Modifier;
use Freezemage\Bem\Node\NodeCollection;
use Freezemage\Bem\Snippet\CommentSnippet;


spl_autoload_register(function (string $fqn): void {
    $fqn = str_replace('\\', '/', ltrim($fqn, '/'));
    $absolute = realpath(__DIR__ . '/src') . '/' . $fqn . '.php';
    if (is_file($absolute)) {
        /** @noinspection PhpIncludeInspection */
        include $absolute;
    }
});

/*$config = new Config(__DIR__ . '/asset/', __DIR__ . '/out/', "\t");


$classNameBuilder = new ClassNameBuilder();
$htmlBuilder = new HtmlBuilder($classNameBuilder, $config);
$cssBuilder = new CssBuilder($classNameBuilder);

$snippet = new CommentSnippet(new Comment('Administrator', 'My first comment!'));
echo $cssBuilder->build($snippet->create()) . PHP_EOL;*/


$elements = new NodeCollection();
$modifiers = new NodeCollection();

$elements->add(new Element('span'));
$modifiers->add(new Modifier('ul'));


var_dump(NodeCollection::merge($elements, $modifiers));