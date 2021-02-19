<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Builder;


use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Element;
use Freezemage\Bem\Node\Modifier;
use Freezemage\Bem\Node\Node;


class CssBuilder implements NodeBuilder {
    protected ClassNameBuilder $classNameBuilder;

    public function __construct(ClassNameBuilder $classNameBuilder) {
        $this->classNameBuilder = $classNameBuilder;
    }

    public function build(Node $node): string {
        return sprintf('%s {%s}', $this->buildSelectorChain($node), PHP_EOL);
    }

    protected function buildSelectorChain(Node $node) {
        return '.' . $this->classNameBuilder->build($node);
    }
}