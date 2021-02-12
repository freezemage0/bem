<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Builder;


use Freezemage\Bem\Node\Node;


interface NodeBuilder {
    public function build(Node $node): string;
}