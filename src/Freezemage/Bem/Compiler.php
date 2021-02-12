<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem;


use Freezemage\Bem\Builder\HtmlBuilder;
use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Node;
use Freezemage\Bem\Node\NodeCollection;


class Compiler {
    protected Block $document;
    protected Block $body;
    protected HtmlBuilder $htmlBuilder;

    public function __construct(HtmlBuilder $htmlBuilder, Block $head) {
        $this->document = new Block('html', '');
        $this->document->attachBlock($head);
        $this->htmlBuilder = $htmlBuilder;
    }

    public function attach(Block $node): void {
        if (!isset($this->body)) {
            $this->body = new Block('body', '');
            $this->document->attachBlock($this->body);
        }

        $this->body->attachBlock($node);
    }

    public function compile() {
        return $this->htmlBuilder->build($this->document);
    }
}