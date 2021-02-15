<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Snippet;


use Freezemage\Bem\Entity\Comment;
use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Element;


class CommentSnippet implements Snippet {
    protected Comment $comment;

    public function __construct(Comment $comment) {
        $this->comment = $comment;
    }

    public function create(): Block {
        $comment = new Block('div', 'comment');

        $author = new Element('div', 'comment-author');
        $text = new Element('div', 'comment-text');

        $author->setContent($this->comment->getAuthorName());
        $text->setContent($this->comment->getMessage());

        $comment->attachElement($author);
        $comment->attachElement($text);

        return $comment;
    }
}