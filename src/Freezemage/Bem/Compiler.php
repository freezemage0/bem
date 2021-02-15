<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem;


use Freezemage\Bem\Builder\ClassNameBuilder;
use Freezemage\Bem\Builder\CssBuilder;
use Freezemage\Bem\Builder\FilePathBuilder;
use Freezemage\Bem\Builder\HtmlBuilder;
use Freezemage\Bem\Compiler\StreamWriter;
use Freezemage\Bem\Node\Attribute;
use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Element;
use Freezemage\Bem\Node\Node;


class Compiler {
    protected Block $document;
    protected Block $body;
    protected Config $config;
    protected HtmlBuilder $htmlBuilder;
    protected CssBuilder $cssBuilder;
    protected FilePathBuilder $fileNameBuilder;
    protected ClassNameBuilder $classNameBuilder;

    public function __construct(HtmlBuilder $htmlBuilder, Block $head) {
        $this->document = new Block('html');
        $this->document->attachAttribute(new Attribute('lang', 'en'));
        $this->document->attachBlock($head);
        $this->htmlBuilder = $htmlBuilder;
    }

    public function body(Block $block): void {
        if (!isset($this->body)) {
            $this->body = new Block('body');
            $this->document->attachBlock($this->body);
        }

        $this->body->attachBlock($block);
    }

    public function compile() {
        $this->compileNode($this->body);
    }

    protected function compileNode(Node $node) {

        $filePath = $this->config->getOutputPath() . '/' . ltrim($this->fileNameBuilder->build($node), '/');

    }

    protected function compileHtml(Node $node) {

    }

    protected function compileCss(Node $node): string {
        $filePath = $this->config->getOutputPath() . '/' . ltrim($this->fileNameBuilder->build($node), '/');
        if (!is_dir($filePath)) {
            mkdir($filePath, 0777, true);
        }

        $fileName = $filePath . $this->classNameBuilder->build($node) . '.css';

        $stream = new StreamWriter($fileName);
        $stream->write($this->cssBuilder->build($node));
    }
}
