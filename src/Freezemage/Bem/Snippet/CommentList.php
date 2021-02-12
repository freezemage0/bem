<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Snippet;

use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Element;


class CommentList {
    public function create(array $comments): Block {
        $commentList = new Block('div', 'comments');

        foreach ($comments as $comment) {
            $commentBlock = new Block('div', 'comment');

            $author = new Element('div', 'comment-author');
            $text = new Element('div', 'comment-text');

            $author->setContent($comment['AUTHOR_NAME']);
            $text->setContent($comment['MESSAGE']);

            $commentBlock->attachElement($author);
            $commentBlock->attachElement($text);

            $commentList->attachBlock($commentBlock);
        }

        return $commentList;
    }
}