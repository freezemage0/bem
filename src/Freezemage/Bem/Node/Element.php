<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Node;

class Element implements ModifiableNode, AttributableNode {
    protected string $tag;
    protected ?string $name;
    protected string $content;
    protected bool $enclosed;
    protected Node $parent;
    protected NodeCollection $elements;
    protected NodeCollection $modifiers;
    protected AttributeCollection $attributes;

    public function __construct(string $tag, ?string $name = null) {
        $this->tag = $tag;
        $this->name = $name;
        $this->enclosed = false;
        $this->elements = new NodeCollection();
        $this->modifiers = new NodeCollection();
        $this->attributes = new AttributeCollection();
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

    public function getName(): ?string {
        return $this->name;
    }

    public function attachElement(Element $element): self {
        $this->elements->add($element);
        $element->setParent($this->getParent());

        return $this;
    }

    public function getElements(): NodeCollection {
        return $this->elements;
    }

    public function attachModifier(Modifier $modifier): self {
        $this->modifiers->add($modifier);
        $modifier->setParent($this);

        return $this;
    }

    public function getModifiers(): NodeCollection {
        return $this->modifiers;
    }

    public function attachAttribute(Attribute $attribute): void {
        $this->attributes->add($attribute);
    }

    public function getAttributes(): AttributeCollection {
        return $this->attributes;
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
        return !$this->getChildren()->isEmpty();
    }

    public function getChildren(): NodeCollection {
        return $this->elements;
    }

    public function enclose(): void {
        $this->enclosed = true;
    }

    public function isEnclosed(): bool {
        return $this->enclosed;
    }
}