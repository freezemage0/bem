<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


use Freezemage\Bem\Builder\ClassNameBuilder;
use Freezemage\Bem\Builder\HtmlBuilder;
use Freezemage\Bem\Compiler;
use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Snippet\CommentList;


spl_autoload_register(function (string $fqn): void {
    $fqn = str_replace('\\', '/', ltrim($fqn, '/'));
    $absolute = realpath(__DIR__ . '/src') . '/' . $fqn . '.php';
    if (is_file($absolute)) {
        /** @noinspection PhpIncludeInspection */
        include $absolute;
    }
});

$classNameBuilder = new ClassNameBuilder();
$htmlBuilder = new HtmlBuilder($classNameBuilder);

$head = new Block('head', '');
$compiler = new Compiler($htmlBuilder, $head);

$snippet = new CommentList();

$comments = array(
        array('AUTHOR_NAME' => 'Administrator', 'MESSAGE' => 'My First Comment!'),
        array('AUTHOR_NAME' => 'Moderator', 'MESSAGE' => 'Gratz!'),
);

$compiler->attach($snippet->create($comments));

file_put_contents(__DIR__ . '/out/comments.html', $compiler->compile());