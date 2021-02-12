<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Builder;


use Freezemage\Bem\Node\Block;
use Freezemage\Bem\Node\Element;
use Freezemage\Bem\Node\Modifier;
use Freezemage\Bem\Node\Node;
use InvalidArgumentException;


class ClassNameBuilder implements NodeBuilder {
    public function build(Node $node): string {
        if ($node instanceof Block) {
            return $node->getName();
        }

        if ($node instanceof Element) {
            return $this->build($node->getParent()) . '__' . $node->getName();
        }

        if ($node instanceof Modifier) {
            return $this->build($node->getParent()) . '_' . $node->getName();
        }

        throw new InvalidArgumentException('Invalid node type.');
    }
}