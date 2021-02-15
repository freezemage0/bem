<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Node;

use LogicException;


class Modifier implements Node {
    protected string $tag;
    protected ?string $name;
    protected string $content;
    protected Node $parent;

    public function __construct(string $tag, ?string $name = null) {
        $this->tag = $tag;
        $this->name = $name;
    }

    public function hasParent(): bool {
        return isset($this->parent);
    }

    public function getParent(): ?Node {
        return $this->parent;
    }

    public function setParent(Node $node): void {
        $this->parent = $node;
    }

    public function getTag(): string {
        return $this->tag;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function hasContent(): bool {
        return isset($this->content);
    }

    public function hasName(): bool {
        return isset($this->name);
    }

    public function hasChildren(): bool {
        return false;
    }

    public function getChildren(): NodeCollection {
        throw new LogicException('Modifiers cannot have child nodes.');
    }
}