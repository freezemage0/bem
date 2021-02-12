<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Node;

class Modifier implements Node {
    protected string $tag;
    protected string $name;
    protected string $content;
    protected Node $parent;

    public function __construct(string $tag, string $name) {
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
}