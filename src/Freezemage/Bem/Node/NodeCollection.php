<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Node;

use SplObjectStorage;


class NodeCollection {
    protected SplObjectStorage $collection;

    public static function merge(NodeCollection ...$nodeCollections): NodeCollection {
        $instance = new NodeCollection();

        foreach ($nodeCollections as $collection) {
            foreach ($collection->toArray() as $node) {
                $instance->add($node);
            }
        }

        return $instance;
    }

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

    public function isEmpty(): bool {
        return $this->collection->count() == 0;
    }
}