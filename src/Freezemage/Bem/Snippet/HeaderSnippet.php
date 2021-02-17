<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Snippet;

use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Element;


class HeaderSnippet implements Snippet {
    protected string $title;

    public function __construct(string $title) {
        $this->title = $title;
    }

    public function create(): Block {
        $block = new Block('div', 'header');
        $element = new Element('span', 'header-title');
        $element->setContent($this->title);
        $block->attachElement($element);

        return $block;
    }
}