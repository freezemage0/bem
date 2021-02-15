<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Page;

use Freezemage\Bem\Compiler;
use Freezemage\Bem\Snippet\CommentSnippet;


class BlogPost {
    protected Compiler $compiler;

    public function __construct(Compiler $compiler) {
        $this->compiler = $compiler;
    }

    public function render(Data $data): void {
        $commentList = new CommentSnippet();
        $this->compiler->attach($commentList->create($data->get('COMMENTS')));
    }
}