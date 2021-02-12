<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Node;

use SplObjectStorage;


class NodeCollection {
    protected SplObjectStorage $collection;

    public function __construct() {
        $this->collection = new SplObjectStorage();
    }

    public function has(Node $node): bool {
        return $this->collection->contains($node);
    }

    public function add(Node $node): void {
        $this->collection->attach($node);
    }

    public function remove(Node $node): void {
        $this->collection->detach($node);
    }

    public function toArray(): array {
        $nodes = array();

        foreach ($this->collection as $node) {
            $nodes[] = $node;
        }

        return $nodes;
    }
}