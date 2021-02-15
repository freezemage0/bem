<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Node;


use SplObjectStorage;


class AttributeCollection {
    protected SplObjectStorage $collection;

    public function __construct() {
        $this->collection = new SplObjectStorage();
    }

    public function add(Attribute $attribute): void {
        $this->collection->attach($attribute);
    }

    public function remove(Attribute $attribute): void {
        $this->collection->detach($attribute);
    }

    public function has(Attribute $attribute): bool {
        return $this->collection->contains($attribute);
    }

    public function toArray(): array {
        $attributes = array();
        foreach ($this->collection as $attribute) {
            $attributes[] = $attribute;
        }

        return $attributes;
    }
}