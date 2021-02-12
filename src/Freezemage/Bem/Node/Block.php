<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\Bem\Node;

class Block implements ModifiableNode {
    protected string $tag;
    protected string $name;
    protected string $content;
    protected Node $parent;
    protected NodeCollection $blocks;
    protected NodeCollection $elements;
    protected NodeCollection $modifiers;

    /**
     * Block constructor.
     * @param string $tag
     * @param string $name
     */
    public function __construct(string $tag, string $name) {
        $this->tag = $tag;
        $this->name = $name;
        $this->blocks = new NodeCollection();
        $this->elements = new NodeCollection();
        $this->modifiers = new NodeCollection();
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

    public function attachBlock(Block $block): void {
        $this->blocks->add($block);
        $block->setParent($this);
    }

    public function getBlocks(): NodeCollection {
        return $this->blocks;
    }

    public function attachElement(Element $element): void {
        $this->elements->add($element);
        $element->setParent($this);
    }

    public function getElements(): NodeCollection {
        return $this->elements;
    }

    public function attachModifier(Modifier $modifier): void {
        $this->modifiers->add($modifier);
        $modifier->setParent($this);
    }

    public function getModifiers(): NodeCollection {
        return $this->modifiers;
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