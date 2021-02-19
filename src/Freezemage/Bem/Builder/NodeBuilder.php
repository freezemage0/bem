<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Builder;


use Freezemage\Bem\Node\Node;


interface NodeBuilder {
    public function build(Node $node): string;
}