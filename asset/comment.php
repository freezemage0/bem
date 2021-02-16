<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */
/** @var Loader $this */


use Freezemage\Bem\Entity\Comment;
use Freezemage\Bem\Page\Loader;
use Freezemage\Bem\Snippet\CommentSnippet;


if (!($this instanceof Loader)) {
    return;
}

$comment = new Comment('Administrator', 'My first comment!');
$snippet = new CommentSnippet($comment);

$this->compiler->body()->attachBlock($snippet->create());