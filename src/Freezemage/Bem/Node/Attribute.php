<?php
/** @author V. M. <freezemage0@gmail.com> */


namespace Freezemage\Bem\Node;


class Attribute {
    protected string $name;
    protected string $value;

    public function __construct(string $name, string $value) {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getValue(): string {
        return $this->value;
    }
}